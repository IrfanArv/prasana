<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'type',
        'image',
        'slug',
        'description',
        'meta_title',
        'meta_desc',
        'meta_keyword',
        'send_to'
    ];

    public function photos()
    {
        return $this->morphMany(Media::class, 'model');
    }
}
