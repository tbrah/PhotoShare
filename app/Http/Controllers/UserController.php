<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserInfo;

class UserController extends Controller
{
	public function getAllUsers()
	{
		return response()->json(\App\User::all());
	}

    public function getUser($email)
    {
    	$user = User::where('email', $email)->get();
    	// Adds userInfo to the object.
    	$user[0]->info;

    	return response()->json($user, 201);
    }
}
