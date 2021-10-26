<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'full_name' => 'admin',
            'email' => 'admin@admin',
            'password' => bcrypt('admin@1234'),
            'status' => 0,
            'active' => true,
        ]);
    }
}