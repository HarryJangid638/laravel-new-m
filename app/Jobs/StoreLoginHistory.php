<?php
namespace App\Jobs;
use App\Models\LoginHistory;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;

class StoreLoginHistory implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ip;
    protected $user;
    protected $guard;
    protected $event;
    protected $agent;

    public function __construct($user, $guard, $event, $ip, $agent)
    {
        $this->ip    = $ip;
        $this->user  = $user;
        $this->guard = $guard;
        $this->event = $event;
        $this->agent = $agent;
    }

    public function handle(): void
    {
        // Prevent duplicates per user+guard+event+session
        $exists = LoginHistory::where('authenticatable_id', $this->user->id)
            ->where('authenticatable_type', get_class($this->user))
            ->whereDate('created_at', now()->toDateString())
            ->exists();

        if (! $exists) {
            LoginHistory::create([
                'ip' => $this->ip,
                'event' => $this->event,
                'agent' => $this->agent,
                'authenticatable_id' => $this->user->id,
                'authenticatable_type' => get_class($this->user),
            ]);
        }
    }
}
