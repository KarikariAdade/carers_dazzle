<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::query()->create([
            'name' => 'Karikari Adade',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password')
        ]);
    }
}
