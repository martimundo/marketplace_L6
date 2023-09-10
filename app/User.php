<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Entendendo os relacionamentos entre as tabelas...

    //1:1 Um para Um = (usuário tem 1 loja) = hasOne e belongsTo;
    //1:N Um para Muitos(Loja tem muitos produtos) = hasMany e belongsTo
    //N:N Muitos para Muitos(Produtos e Categorias) = belongsTo

    //uma loja
    public function store(){

        return $this->hasOne(Store::class);
    }

    public function orders(){
        return $this->hasMany(UserOrder::class);
    }
}
