<?php

use App\User;
use Faker\Factory;
use App\Models\Dog;
use App\Models\Walk;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);


        // Make Dogs

        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('password'),
                'role' => $i % 2 == 0 ? 'admin' : 'walker'
            ]);
        }
        for ($i = 0; $i < 10; $i++) {
            Dog::create([
                'name' => $faker->firstName,
                'age' => $faker->randomDigitNotNull . ($i % 3 == 0 ? ' years' : ' months'),
                'breed' => $faker->word,
                'weight' => $faker->randomDigitNotNull,
                'status' => $i % 2 == 0 ? 'Receiving' : 'Adoption',
                'gender' => $i % 2 == 0 ? 'Male' : 'Female'
            ]);
        }

        // Make User Accounts
        DB::table('users')->insert([
            'name' => env('NAME1'),
            'email' => env('EMAIL1'),
            'password' => bcrypt(env('PASSWORD1')),
            'role' => 'admin'
        ]);
        DB::table('users')->insert([
            'name' => env('NAME2'),
            'email' => env('EMAIL2'),
            'password' => bcrypt(env('PASSWORD2')),
            'role' => 'walker'
        ]);


        $dogs = Dog::all();
        foreach ($dogs as $key => $dog) {
            for ($i = 0; $i < 10; $i++) {
                $user = User::all()->random();
                $time = $faker->dateTimeThisMonth($max = 'now', $timezone = null);
                $dogsSeen = $faker->randomDigitNotNull + 2;
                $dogsSeenReacted = abs($dogsSeen - 2);
                $walk = new Walk([
                    'pooped' => $i % 2 == 0 ? 1 : 0,
                    'peed' => $i % 3 == 0 ? 1 : 0,
                    'medical_concern' => $faker->sentence(),
                    'jumps' => $faker->randomDigitNotNull,
                    'jump_handlage' => $faker->sentence(),
                    'mouthings' => $faker->randomDigitNotNull,
                    'mouthings_handlage' => $faker->sentence(),
                    'dogs_seen' => $dogsSeen,
                    'dogs_seen_reacted' => $dogsSeenReacted,
                    'seen_dog_reaction' => $faker->sentence(),
                    'other_concerns' => $faker->sentence(),
                    'created_at' => $time,
                ]);
                $user->walks()->save($walk);

                $dog->walks()->save($walk);
            }
        }
    }
}
