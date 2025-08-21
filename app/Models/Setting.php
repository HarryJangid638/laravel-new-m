<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'key',
        'type',
        'value',
        'group',
        'status',
        'details',
        'display_name',
    ];

    public function uploads()
    {
        return $this->morphMany(Upload::class, 'uploadsable');
    }

}
