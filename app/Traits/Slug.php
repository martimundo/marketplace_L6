<?php

namespace App\Traits;
use Illuminate\Support\Str;


trait Slug
{
    public function setNameAttribute($value)
    {
        $slug = Str::slug($value);
        $match = $this->uniqueSlug($slug);
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = $match ? $slug . '-' . $match : $slug;
    }

    public function uniqueSlug($slug)
    {
        $match = $this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*?S)'")->count();

        return $match;
    }
}
