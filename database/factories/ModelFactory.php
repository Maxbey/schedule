<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Entities\Specialty::class, function(Faker\Generator $faker){
    return [
        'code' => $faker->postcode
    ];

});

$factory->define(App\Entities\Troop::class, function(Faker\Generator $faker){
    return [
        'code' => '231',
        'day' => $faker->numberBetween(1, 5),
        'specialty_id' => factory(App\Entities\Specialty::class)->create()->id
    ];
});

$factory->define(App\Entities\Discipline::class, function(Faker\Generator $faker){
    return [
        'full_name' => $faker->title,
        'short_name' => $faker->word
    ];
});

$factory->define(App\Entities\Theme::class, function(Faker\Generator $faker){
    return [
        'name' => $faker->title,
        'number' => '1/1',
        'audiences_count' => 2,
        'teachers_count' => 2,
        'duration' => 2,
        'term' => 1,
        'discipline_id' => factory(App\Entities\Discipline::class)->create()->id
    ];
});

$factory->define(App\Entities\Teacher::class, function(Faker\Generator $faker){
    return [
        'name' => $faker->lastName,
        'work_hours_limit' => 300,
        'military_rank' => $faker->word
    ];
});

$factory->define(App\Entities\Audience::class, function(Faker\Generator $faker){
    return [
        'purpose' => $faker->word,
        'location' => $faker->numberBetween(1, 6) . $faker->numberBetween(1, 6) 
    ];
});

$factory->define(App\Entities\Occupation::class, function(Faker\Generator $faker){
    return [
        'date_of' => $faker->dateTimeThisYear,
        'troop_id' => factory(App\Entities\Troop::class)->create()->id,
        'theme_id' => factory(App\Entities\Theme::class)->create()->id
    ];
});
