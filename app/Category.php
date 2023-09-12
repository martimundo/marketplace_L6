<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Traits\Slug;

class Category extends Model
{  
    use Slug;
    
    protected $fillable=['name', 'description', 'slug'];

    //muito para muitos produtos
    public function products(){

        return $this->belongsToMany(Product::class);
    }

    
}
