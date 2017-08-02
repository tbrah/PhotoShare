<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follows;
use App\User;

class FollowsController extends Controller
{
	/**
	 * Adds the user to the logged users following list.
	 */
    public function add($loggedUserId, $userId)
    {
    	//Validate the form data incomming.
    	$this->validate(request(), [
    		'token' => 'required'
		]);

    	/**
    	 * Find the user trying to add someone
    	 * and check if their token is correct.
    	 * (Just an extra saftey check so other 
    	 * users can manipulate this)
    	 */
    	$user = User::find($loggedUserId);
    	if(request('token') == $user->token){
	    	$follows = new Follows();
	    	$follows->id = $userId;
	    	$follows->user_id = $loggedUserId;
	    	$follows->save();

	    	return response()->json(['follows'=> $follows], 201);
    	} else {
    		return response()->json(['message' => 'Something went wrong']);
    	}

    }

    /**
     * Deletes the user from the logged users following list.
     */
    public function delete($loggedUserId, $userId)
    {
    	//Validate the form data incomming.
    	$this->validate(request(), [
    		'token' => 'required'
		]);

		// Again this is just an extra saftey check.
    	$user = User::find($loggedUserId);
    	if(request('token') == $user->token){
	    	$follows = Follows::where('user_id', $loggedUserId);
        
	        $follows->where('id', $userId)
	        		->delete();

	        return response()->json(['message' => 'Follower removed'], 200);
    	} else {
    		return response()->json(['message' => 'Removal failed']);
    	}

    }

    /**
     * Lists all the users the logged user is following.
     */
    public function get($loggedUserId)
    {
    	$follows = Follows::where('user_id', $loggedUserId)->get();

    	return response()->json(['follows' => $follows], 200);
    }
}
