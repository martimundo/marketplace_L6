<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable=['name', 'description', 'body','price','slug'];


    //uma loja
    public function store(){

        return $this->belongsTo(Store::class);
    }

    //muitos para muitos categorias
    public function categories(){

        return $this->belongsToMany(Category::class);
    }

    //muitas imagens
    public function photos(){

        return $this->hasMany(ProductPhoto::class);
    }


}
