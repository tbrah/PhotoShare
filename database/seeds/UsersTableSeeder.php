<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'username' => 'testing',
            'email' => 'testing@testing.com',
            'password' => bcrypt('password'),
            'verified' => 1,
        ];

        User::create($user);
    }
}
