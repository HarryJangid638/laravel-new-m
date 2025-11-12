<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use Sluggable;

    protected $table = 'roles';

    protected $fillable = [
        'name', 'slug', 'description', 'status',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_has_permissions');
    }

    public function users()
    {
        return $this->morphedByMany(User::class, 'model', 'model_has_roles');
    }

    public function admins()
    {
        return $this->morphedByMany(Admin::class, 'model', 'model_has_roles');
    }

    protected static function booted()
    {
        static::deleting(function ($role)
        {
            // Detach all permissions
            $role->permissions()->detach();

            // Optionally also detach users/admins if you want
            $role->users()->detach();
            $role->admins()->detach();
        });
    }
}
