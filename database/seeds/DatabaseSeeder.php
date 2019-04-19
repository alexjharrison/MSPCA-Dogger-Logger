<?php

use App\User;
use Faker\Factory;
use App\Models\Dog;
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

        $faker = Factory::create();

        for($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => 'password',
                'role' => $i%2==0 ?'admin':'walker'
            ]);
        }
        for($i = 0; $i < 10; $i++) {
            Dog::create([
                'name' => $faker->name,
                'age' => $faker->randomDigitNotNull,
                'breed' => $faker->word,
                'weight' => $faker->randomDigitNotNull,
                'status' => $i%2==0 ? 'Receiving' : 'Adoption',
                'gender' => $i%2==0 ? 'Male' : 'Female'
            ]);
        }
    }
}
