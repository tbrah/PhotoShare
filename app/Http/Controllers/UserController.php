<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserInfo;

class UserController extends Controller
{
	public function getAllUsers()
	{
        $users = User::all();
        $users[0]->info;
		return response()->json($users);
	}

    public function getUser($email)
    {
    	$user = User::where('email', $email)->get();
    	// Adds userInfo to the object.
    	$user[0]->info;
        $user[0]->follows;

    	return response()->json($user, 201);
    }

    public function getUserByUsername($username)
    {
        $user = User::where('username', $username)->get();
        // Adds userInfo to the object.
        $user[0]->info;
        $user[0]->posts;

        return response()->json($user, 201);
    }
}
