<?php

namespace App\Http\Controllers;

use App\User;

class RegistrationController extends Controller
{
    public function store()
    {
    	//Validate the form data incomming.
    	$this->validate(request(), [
    		'username' => 'required|unique:users',
    		'email' => 'required|unique:users|email',
    		'password' => 'required|confirmed'
    	]);
    	//Create the user
    	$user = User::create([
    		'username' => request('username'),
    		'email' => request('email'),
    		'password' => bcrypt(request('password'))
    	]);
    }
}
