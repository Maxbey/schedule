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
        'name' => $faker->word,
        'code' => $faker->postcode
    ];

});

$factory->define(App\Entities\Troop::class, function(Faker\Generator $faker){
    return [
        'code' => '231',
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
        'term' => 1,
        'discipline_id' => factory(App\Entities\Discipline::class)->create()->id
    ];
});

$factory->define(App\Entities\Teacher::class, function(Faker\Generator $faker){
    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'middlename' => $faker->lastName,
        'work_hours_limit' => 300,
        'military_rank' => $faker->word
    ];
});

$factory->define(App\Entities\Audience::class, function(Faker\Generator $faker){
    return [
        'name' => $faker->title,
        'building' => $faker->numberBetween(0, 100),
        'number' => $faker->numberBetween(0, 700)
    ];
});

$factory->define(App\Entities\Occupation::class, function(Faker\Generator $faker){
    return [
        'date_of' => $faker->dateTimeThisYear,
        'teacher_id' => factory(App\Entities\Teacher::class)->create()->id,
        'troop_id' => factory(App\Entities\Troop::class)->create()->id,
        'theme_id' => factory(App\Entities\Theme::class)->create()->id,
        'discipline_id' => factory(App\Entities\Discipline::class)->create()->id,
        'audience_id' => factory(App\Entities\Audience::class)->create()->id,
    ];
});