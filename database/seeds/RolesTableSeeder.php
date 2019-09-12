<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $roles = [
             ['role' => 'admin'],
             ['role' => 'user']
         ];

         foreach ($roles as $role) {

             \App\Models\Role::forceCreate($role);
         }
    }
}
