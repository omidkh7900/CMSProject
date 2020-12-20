<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function setTitleAttribute($value)
    {
        $this->attributes['Title'] = $value;
        $this->Alt = $value;
    }

    public function imageable()
    {
        return $this->morphTo();
    }
}
