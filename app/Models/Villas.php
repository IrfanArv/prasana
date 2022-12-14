<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Villas extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name', 'image', 'description', 'capacity', 'building_area', 'slug', 'meta_title', 'meta_desc', 'meta_keyword', 'featured', 'services'
    ];

    public function photos()
    {
        return $this->morphMany(Media::class, 'model');
    }
}
