<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
        'title_fa',
        'slug',
        'category',
        'author_name',
        'excerpt_fa',
        'full_wysiwyg_html',
        'featured_image_url',
        'meta_title',
        'meta_description',
        'estimated_reading_time',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];
}
