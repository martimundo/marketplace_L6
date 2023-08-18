<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Store::class, function (Faker $faker) {
    return [
        
        'name'=>$faker->name,
        'description'=>$faker->sentence,           
        'fone'=>$faker->phoneNumber,
        'mobile_fone'=>$faker->phoneNumber,
        'slug'=>$faker->slug,
    ];
});
