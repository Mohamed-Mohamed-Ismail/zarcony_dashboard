<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Payment;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    return [
        'payment_number' => $faker->unique()->randomNumber($nbDigits = NULL),
        'user_id' => factory(User::class)->create()->id,
        'recipient_id' => factory(User::class)->create()->id,
        'amount' =>$faker->numberBetween($min = 1, $max = 200) ,
    ];
});


