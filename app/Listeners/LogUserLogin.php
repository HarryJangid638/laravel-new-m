<?php
namespace App\Listeners;
use App\Jobs\StoreLoginHistory;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogUserLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        StoreLoginHistory::dispatch(
            $event->user,
            $event->guard,
            'login',
            request()->ip(),
            request()->userAgent(),
        );

        $user = $event->user;
        $user->last_login_at = now();
        $user->save();
    }
}
