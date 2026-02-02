<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        //seeder admin, tecnico e staff
        
        $admin = User::create([
            'username' => 'adminadmin',
            'password' => bcrypt('bvFKbvFK'),
            'role' => 'admin',
        ]);

        $tecn = User::create([
            'username' => 'tecntecn',
            'password' => bcrypt('bvFKbvFK'),
            'role'=> 'tech',
        ]);

        $staff = User::create([
            'username' => 'staffstaff',
            'password' => bcrypt('bvFKbvFK'),
            'role'=> 'staff',
        ]);
    }
}
