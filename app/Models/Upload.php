<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $table = 'uploads';

    protected $fillable = [
        'type',
        'file_type',
        'file_path',
        'extension',
        'orientation',
        'uploadsable_id',
        'uploadsable_type',
        'original_file_name',
    ];

    public function uploadsable()
    {
        return $this->morphTo();
    }

}
