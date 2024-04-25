<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(Admin::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id')->withPivot('post_id', 'tag_id');
    }

    public function getPostStatAttribute($value)
    {
        $statuses = [
            0 => 'Publish',
        ];

        return isset($statuses[$value]) ? $statuses[$value] : null;
    }

    public function getRawPostStatAttribute()
    {
        return $this->attributes['post_stat'];
    }
}
