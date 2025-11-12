<?php
namespace App\Models;
use Illuminate\Support\Facades\Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Notifications\ResetPassword;
use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $table = 'admins';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'profile_image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function uploads()
    {
        return $this->morphMany(Upload::class, 'uploadsable');
    }

    public function roles()
    {
        return $this->morphToMany(Role::class, 'model', 'model_has_roles');
    }

    public function permissions()
    {
        return $this->morphToMany(Permission::class, 'model', 'model_has_permissions');
    }

    public function hasPermission($permissionName)
    {
        if ($this->roles()->where('slug', 'super-admin')->exists())
        {
            return true;
        }

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
