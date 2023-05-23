<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB,Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
