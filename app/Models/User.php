<?php
namespace App\Models;
use Illuminate\Support\Facades\Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'avatar',
        'password',
        'last_name',
        'first_name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles()
    {
        return $this->morphToMany(Role::class, 'model', 'model_has_roles')->withTimestamps();
    }

    public function permissions()
    {
        return $this->morphToMany(Permission::class, 'model', 'model_has_permissions')->withTimestamps();
    }

    public function hasPermission($permissionName)
    {
        if ($this->roles()->where('slug', 'super-admin')->exists())
        {
            return true;
        }
        // echo '<Pre>';print_r($this->permissions->toArray());echo '</Pre>';die;
        // Check direct permissions
        if ($this->permissions->contains('slug', $permissionName))
        {
            return true;
        }
        // Cache permissions for this user
        $permissions = Cache::remember(
            "user_permissions_{$this->id}",   // cache key
            now()->addMinutes(30),           // cache duration
            function () {
                // Load both direct + role permissions
                $rolePermissions = $this->roles()->with('permissions')->get()
                    ->flatMap(fn($role) => $role->permissions);

                return $this->permissions->merge($rolePermissions)->pluck('slug')->unique();
            }
        );
        return $permissions->contains($permissionName);
    }

    public function isSuperAdmin(): bool
    {
        return $this->roles()->where('slug', 'super-admin')->exists();
    }

    public function loginHistories()
    {
        return $this->morphMany(LoginHistory::class, 'authenticatable');
    }

    public function sendPasswordResetNotification($token, $url = null)
    {
        $url = $url ?? url(route('admin.password.reset', [
            'token' => $token,
            'email' => $this->email,
        ], false));

        $this->notify(new AdminResetPasswordNotification($token));
    }

}
