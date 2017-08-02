<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserInfo;
use App\User;

class UserInfoController extends Controller
{
	/**
	 * Post user information.
	 */
    public function postInfo()
    {
	    	//Validate the form data incomming.
	    	$this->validate(request(), [
	    		'user_id' => 'required',
    			'first_name' => 'required',
    			'last_name' => 'required',
    			'about' => 'required',
    			'country' => 'required'
    		]);

	    	//Create the userInfo
	    	$userInfo = new UserInfo();

	    	$userInfo->user_id = request('user_id');
	    	$userInfo->first_login = false;
	    	$userInfo->first_name = request('first_name');
	    	$userInfo->last_name = request('last_name');
	    	$userInfo->about = request('about');
	    	$userInfo->country = request('country');

	    	$userInfo->save();
	    	return response()->json(['message'=>'Success'], 201);
    }

    /**
     * Edit user information.
     */
    public function editInfo()
    {
    	//Validate the form data incomming.
    	$this->validate(request(), [
    		'user_id' => 'required',
			'first_name' => 'required',
			'last_name' => 'required',
			'about' => 'required',
			'country' => 'required'
		]);

    	$user = User::find(request('user_id'));
    	$user->info->first_name = request('first_name');
    	$user->info->last_name = request('last_name');
    	$user->info->about = request('about');
    	$user->info->country = request('country');

    	$user->info->save();
    	return response()->json($user->info);
    }
}
