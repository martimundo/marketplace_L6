<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Spatie\Sluggable\HasSlug;
//use Spatie\Sluggable\SlugOptions;
use App\Traits\Slug;


class Product extends Model
{
    use Slug;
    
    protected $fillable = ['name', 'description', 'body', 'price', 'slug'];

    /**
     * Get the options for generating the slug.
     */
    // public function getSlugOptions(): SlugOptions
    // {
    //     return SlugOptions::create()
    //         ->generateSlugsFrom('name')
    //         ->saveSlugsTo('slug');
    // }

    public function getThumbAttribute()
    {

        return $this->photos->first()->image;
    }

    

    //uma loja
    public function store()
    {

        return $this->belongsTo(Store::class);
    }

    //muitos para muitos categorias
    public function categories()
    {

        return $this->belongsToMany(Category::class);
    }

    //muitas imagens
    public function photos()
    {

        return $this->hasMany(ProductPhoto::class);
    }
}
