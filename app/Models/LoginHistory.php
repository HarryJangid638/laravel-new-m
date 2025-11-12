<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    protected $fillable = [
        'device',
        'browser',
        'location',
        'platform',
        'ip_address',
        'logged_in_at',
        'logged_out_at',
        'authenticatable_id',
        'authenticatable_type',
    ];

    public function authenticatable()
    {
        return $this->morphTo();
    }
}
