<?php

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for($i=0; $i<1; $i++) {
            $user = User::create([
                'name' => $faker->name ,
                'email' => $faker->email ,
                'password' => bcrypt('123123123') ,
            ]);
        }
    }
}
