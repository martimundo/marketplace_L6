<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Store extends Model
{
    use HasSlug;

    protected $fillable = ['name', 'description', 'fone', 'mobile_fone', 'slug', 'logo'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    //muitos usuários
    public function user()
    {

        return $this->belongsTo(User::class);
    }

    //muitos produtos
    public function products()
    {

        return $this->hasMany(product::class);
    }

    public function orders()
    {
        return $this->belongsToMany(UserOrder::class, 'order_store','store_id','order_id');
    }

    
}
