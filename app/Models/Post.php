<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'short_content', 'slug', 'link_to_details', 'user_id', 'image', 'no_of_clicks', 'trending'];

    protected $casts = [
        'title' => 'string',
        'content' => 'string',
        'short_content' => 'string',
        'user_id' => 'integer',
        'image' => 'string',
        'slug' => 'string',
        'link_to_details' => 'string',
        'no_of_clicks' => 'integer',
        'trending' => 'integer',
        'created_at'  => 'date:d-m-Y H:00',
        'updated_at' => 'date:d-m-Y H:00',
    ];

    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        if ($this->attributes['image'] != null) {

            return asset('posts/' . $this->attributes['image']);
        }
    }

    public function postCategory()
    {

        return $this->belongsTo(PostCategory::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
