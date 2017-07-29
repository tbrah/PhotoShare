<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Mail;
use App\Mail\ResetPassword;

class ForgotPasswordController extends Controller
{
    public function forgotPassword()
    {
    	$user = User::whereEmail(request('email'))->first();
    	if(count($user) == 0){
    		return redirect()->back()->with([
    			'success' => 'Reset code was sent to your email.'
    			]);	
    	}
    	$user->resetToken = Str::random(40);
    	$user->save();
		Mail::to($user->email)->send(new ResetPassword($user));
    	return $user;
    	
    }

    public function checkUser()
    {
    	$user = User::whereId(request('id'))->first();
    	if($user->resetToken == request('resetToken')){
    		$user->password = bcrypt(request('password'));
    		$user->resetToken = null;
    		$user->save();
    		return response()->json(['message' => 'Success they matched!'], 201);
    	} else {
    		return response()->json(['message' => 'something went wrong'], 403);
    	}
    }
}
