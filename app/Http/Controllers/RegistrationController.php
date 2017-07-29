<?php

namespace App\Http\Controllers;

use App\User;
use Mail;
use App\Mail\Validation;
use Illuminate\Support\Str;

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
    		'password' => bcrypt(request('password')),
            'token' => Str::random(40),
    	]);

        Mail::to($user->email)->send(new Validation($user));

        return response()->json([
            'message' => 'Successfully created user! We have sent you a verification email.'
        ], 201);

    }
}
