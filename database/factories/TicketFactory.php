<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Ticket;
use Faker\Generator as Faker;

$factory->define(Ticket::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'category_id' => factory(App\Category::class)->create()->id,
        'ticket_id'   => $faker->ean8,
        'title' => $faker->sentence,
        'priority' => 'low',
        'status' => 'Open',
        'message' => $faker->paragraph
    ];
});