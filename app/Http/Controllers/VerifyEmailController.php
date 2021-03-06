<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserInfo;

class VerifyEmailController extends Controller
{
    public function verify($id, $token)
    {
    	$user = User::find($id);
    	if($user->token === $token){
    		$user->verified = true;
    		$user->save();

            $userInfo = new UserInfo();
            $userInfo->user_id = $id;
            $userInfo->first_login = 1;
            $userInfo->save();

    		return redirect('http://localhost:4200/login/emailValid/1');
    	} else {
    		return "Something went wrong. You are still not verified.";
    	}
    }
}
