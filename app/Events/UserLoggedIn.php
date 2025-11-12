<?php
namespace App\Events;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Contracts\Auth\Authenticatable;

class UserLoggedIn
{
    use Dispatchable, SerializesModels;

    public $ip;
    public $user;
    public $guard;
    public $agent;

    public function __construct(Authenticatable $user, string $guard)
    {
        $this->ip    = Request::ip();
        $this->user  = $user;
        $this->guard = $guard;
        $this->agent = Request::header('User-Agent');
    }
}
