<?php

use App\Models\Admin;
use App\Models\User;
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
        Admin::create([
            'name' => 'Mohamed',
            'email' => 'mohamedismail@gmail.com',
            'password' => bcrypt('12345678')
        ]);
    }
}
