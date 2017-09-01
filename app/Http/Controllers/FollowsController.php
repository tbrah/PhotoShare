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

            $userFollows = $user->follows()->where('id', $userId)->get();

            if(empty($userFollows[0])){
                $follows = new Follows();
                $follows->id = $userId;
                $follows->user_id = $loggedUserId;
                $follows->save();

                return response()->json(['follows'=> $follows], 201);
            } else {
                $userFollows[0]->delete();
            }
	    	
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
    public function getFollows($loggedUserId)
    {
    	$follows = Follows::where('user_id', $loggedUserId)->get();

    	return response()->json(['follows' => $follows], 200);
    }

    /**
     * Lists all the users that are following the logged user.
     */
    public function getFollowers($loggedUserId)
    {
    	$followers = Follows::where('id', $loggedUserId)->get();

    	return response()->json(['followers' => $followers], 200);
    }
}
