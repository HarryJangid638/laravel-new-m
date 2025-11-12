<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class EmailTemplate extends Model
{
    use Sluggable;
    protected $table = 'email_templates';

    protected $fillable = [
        'title',
        'slug',
        'subject',
        'is_active',
        'email_keys',
        'description',
        'footer_text',
        'email_preference_id',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
