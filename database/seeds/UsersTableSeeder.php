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

        \App\Models\User::forceCreate([
            'username' => 'fayez',
            'firstname' => 'mohamed',
            'lastname' => 'fayez',
            'full_address' => 'tanta',
            'email' => 'mohamed@gmail.com',
            'role_id' => 1,
            'password' => bcrypt('123456')
        ]);
    }
}
