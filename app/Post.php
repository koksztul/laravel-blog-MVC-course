<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    protected $fillable = ['user_id', 'title', 'type', 'date', 'content', 'premium', 'published', 'image'];
    protected $dates = ['date'];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = is_null($value) ? now() : $value;
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function getExcerptAttribute()
    {
        return Str::limit(strip_tags($this->content), 300);
    }
    public function getPhotoAttribute()
    {
        return Str::startsWith($this->image, 'http') ? $this->image : Storage::url($this->image);
    }
    public function scopePublished($query)
    {
        $user = auth()->user();

        if ($user && $user->can('manage-posts')) {
            return $query;
        }

        if (!$user) {
            $query->where('premium', '<>', 1);
        }

        return $query->where('published', 1);
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
