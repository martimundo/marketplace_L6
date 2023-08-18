<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    
    protected $fillable = ['name','description','fone','mobile_fone','slug','logo' ];


    //muitos usuários
    public function user(){

        return $this->belongsTo(User::class);
    }

    //muitos produtos
    public function products(){

        return $this->hasMany(product::class);
    }
}
