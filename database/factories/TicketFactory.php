<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Ticket;
use Faker\Generator as Faker;

$factory->define(Ticket::class, function (Faker $faker) {
    return [
        'user_id'     => App\User::all()->random()->id,
        'category_id' => App\Category::all()->random()->id,
        'ticket_id'   => $faker->ean8,
        'title'       => $faker->sentence,
        'priority'    => 'low',
        'status'      => 'Open',
        'message'     => $faker->paragraph
    ];
});