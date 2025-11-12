<?php
namespace App\Providers;
use Throwable;
use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        try
        {
            $this->registerPolicies();
            // Fetch all permission slugs from DB
            Gate::before(function ($user)
            {
                if ($user->isSuperAdmin())
                {
                    return true;
                }
            });

            $permissions = Cache::remember('all_permissions', 3600, function ()
            {
                return Permission::pluck('slug')->toArray();
            });

            foreach ($permissions as $permission)
            {
                Gate::define($permission, function ($user) use ($permission)
                {
                    return $user && $user->hasPermission($permission);
                });
            }
        }
        catch (Throwable $e)
        {
            // During migration/first run DB may not exist
            logger()->warning('Skipping Gate registration: '.$e->getMessage());
        }
    }
}
