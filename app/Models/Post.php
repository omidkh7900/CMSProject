<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_DELETED = 'delete';
    const STATUS_PUBLISHED = 'published';
    const STATUS_UNPUBLISHED = 'unpublished';
    const STATUS = 'published';
    protected $guarded = [];

    public function setTitleAttribute($value)
    {
        $this->attributes['Title'] = $value;
        $this->Slug = $value;
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['Slug'] = Str::slug(rand(0, 999999) . ' ' . $value);
    }

    public function tags()
    {
        return $this->belongsToMany(tag::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
