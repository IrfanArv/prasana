<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'meta_title',
        'meta_description',
        'meta_keyword',
        'address',
        'phone',
        'email',
        'facebook',
        'instagram',
        'gplus',
        'maps',
        'wa_number',
        'wa_message',
        'widget_book'
    ];
}
