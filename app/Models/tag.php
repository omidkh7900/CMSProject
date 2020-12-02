<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class tag extends Model
{
    use HasFactory;

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

    public function posts()
    {
        return $this->belongsToMany(post::class);
    }
}
