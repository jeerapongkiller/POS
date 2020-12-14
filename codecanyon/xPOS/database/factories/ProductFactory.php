<?php

use Faker\Generator as Faker;

$factory->define(\App\Model\Product::class, function (Faker $faker) {
    return [
        'outlet_id'     =>  1,
        'image'         =>  $faker->image('uploads/product_image',100,100,'food',true),
        'product_name'  =>  $faker->name(),
        'product_sku'   =>  $faker->numberBetween(10000,70000),
        'price'         =>  $faker->numberBetween(5,100),
        'category_id'   =>  $faker->numberBetween(1,4),
        'user_id'       =>  2
    ];
});
