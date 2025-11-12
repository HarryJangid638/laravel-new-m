<?php

namespace App\Providers;

// use App\Events\UserLoggedIn;
// use App\Events\UserLoggedOut;
use App\Listeners\LogUserLogin;
use App\Listeners\LogUserLogout;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;


use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            LogUserLogin::class,
        ],
        // UserLoggedOut::class => [
        //     LogUserLogout::class,
        // ],
    ];

    // public function boot(): void
    // {
    //     //
    // }
}
