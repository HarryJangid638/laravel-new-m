<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
// use Cviebrock\EloquentSluggable\Sluggable;
class Permission extends Model
{
    // use Sluggable;
    protected $fillable = ['module','slug'];

    // public function sluggable(): array
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'module'
    //         ]
    //     ];
    // }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_has_permissions');
    }

    public function users()
    {
        return $this->morphedByMany(User::class, 'model', 'model_has_permissions');
    }

    public function admins()
    {
        return $this->morphedByMany(Admin::class, 'model', 'model_has_permissions');
    }
}
