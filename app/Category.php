<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{  
    protected $fillable=['name', 'description', 'slug'];

    //muito para muitos produtos
    public function products(){

        return $this->belongsToMany(Products::class);
    }
}
