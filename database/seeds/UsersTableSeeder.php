<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = [];
        $faker = Faker\Factory::create();
        for ($i=0;$i<5;$i++) {
            $avatar_path = '/var/www/larashop-api/public/images/users';
            $avatar_fullpath = $faker->image($avatar_path, 200, 250, 'people', true, true, 'people');
        }
    }
}
