<?php
namespace App\Enums;
enum Menu: string
{
    case USERS = 'users';
    case ROLES = 'roles';
    case SETTINGS = 'settings';
    case DASHBOARD = 'dashboard';
    case PERMISSIONS = 'permissions';
    case CLEAR_CACHE = 'clear_cache';

    public function label(): string
    {
        return match($this)
        {
            self::USERS => 'Users',
            self::ROLES => 'Roles',
            self::SETTINGS => 'Settings',
            self::DASHBOARD => 'Dashboard',
            self::PERMISSIONS => 'Permissions',
            self::CLEAR_CACHE => 'Clear Cache',
        };
    }

    public function icon(): string
    {
        return match($this)
        {
            self::ROLES => 'ri-shield-user-line',
            self::USERS => 'ri-user-line',
            self::SETTINGS => 'ri-settings-3-line',
            self::DASHBOARD => 'ri-dashboard-line',
            self::PERMISSIONS => 'ri-lock-line',
            self::CLEAR_CACHE => 'ri-refresh-line',
        };
    }

    public function route(): string
    {
        return match($this)
        {
            self::ROLES => route('admin.roles.index'),
            self::USERS => route('admin.users.index'),
            self::SETTINGS => route('admin.settings.index'),
            self::DASHBOARD => route('admin.dashboard'),
            self::PERMISSIONS => route('admin.permissions.index'),
            self::CLEAR_CACHE => route('admin.cache.clear'),
        };
    }

    public static function grouped(): array
    {
        return [
            'USERS AND ROLES' => [self::USERS, self::ROLES],
            'PERMISSIONS' => [self::PERMISSIONS],
            'SETTINGS' => [self::SETTINGS, self::CLEAR_CACHE],
        ];
    }
}
