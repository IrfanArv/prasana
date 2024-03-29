<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Experience extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'location',
        'image',
        'slug',
        'description',
        'meta_title',
        'meta_desc',
        'meta_keyword'
    ];

    public function photos()
    {
        return $this->morphMany(Media::class, 'model');
    }
}
