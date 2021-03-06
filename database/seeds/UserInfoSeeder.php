<?php

use Illuminate\Database\Seeder;
use App\UserInfo;

class UserInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userInfo = [
        	'user_id' =>  '1',
        	'first_name' => 'Bob',
        	'last_name' => 'Dylan',
            'avatar' => 'https://jessienoochies.files.wordpress.com/2012/10/martin-schoeller-celebrity-portraits-4-600x7381.jpg',
        	'first_login' => true,
        	'about' => 'this is some random text for the about',
        	'country' => 'Denmark',
        ];

        UserInfo::create($userInfo);
    }
}
