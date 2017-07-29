<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class VerifyEmailController extends Controller
{
    public function verify($id, $token)
    {
    	$user = User::find($id);
    	if($user->token === $token){
    		$user->verified = true;
    		$user->save();
    		return redirect('http://localhost:4200/login/emailValid/1');
    	} else {
    		return "Something went wrong. You are still not verified.";
    	}
    }
}
