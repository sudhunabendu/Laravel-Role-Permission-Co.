<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Nabendu',
            'last_name' => 'Bose',
            'email' => 'super@gmail.com',
            'phone' => '9875614547',
            'password' => Hash::make('123456'),
        ]);
    }
}
