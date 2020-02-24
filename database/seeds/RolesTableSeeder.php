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
        DB::table('users')->insert([
         'name' => 'Primary User',
         'email' => 'user@gmail.com',
         'password' => Hash::make('secret'),
         'role_id' => 1,
         'created_at' => now(),
         'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('secret'),
            'role_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
