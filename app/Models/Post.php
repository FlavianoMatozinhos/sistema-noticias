<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'slug',
        'body',
        'status',
        'temporary_video',
        'title_video',
        'video_locale'
    ];

    public function user() {

        return $this->belongsTo(User::class);

    }
}
