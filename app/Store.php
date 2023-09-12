<?php

namespace App;

use App\Notifications\StoreReceiveNewOrder;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Slug;


class Store extends Model
{
    use Slug;

    protected $fillable = ['name', 'description', 'fone', 'mobile_fone', 'slug', 'logo'];

   

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
        return $this->belongsToMany(UserOrder::class, 'order_store', 'store_id', 'order_id');
    }

    public function notifyStoreOwners(array $storeId = null)
    {
        $stores = $this->whereIn('id', $storeId)->get();

        $stores->map(function ($stores) {
            return $stores->user;
        })->each->notify(new StoreReceiveNewOrder());
    }
}
