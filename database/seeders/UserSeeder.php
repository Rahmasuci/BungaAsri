<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'address' => 'jln admin',
            'no_tlp' => '081234567890',
            'role' => 0,
            'password' => bcrypt('123456'),
        ]);

        DB::table('users')->insert([
            'name' => 'Customer',
            'email' => 'customer@customer.com',
            'address' => 'jln customer',
            'no_tlp' => '081234567890',
            'role' => 1,
            'password' => bcrypt('123456'),
        ]);
    }
}
