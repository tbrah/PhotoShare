<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Likes;
use App\User;

class LikesController extends Controller
{
    public function likePost($postId)
    {
    	$this->validate(request(), [
    		'user_id' => 'required'
    	]);

    	$user = User::where('id', request('user_id'))->get();
    	$userLikes = $user[0]->likes()->where('post_id', $postId)->get();

    	if(empty($userLikes[0])){
	    	$like = new Likes();
	    	$like->post_id = $postId;
	    	$like->user_id = request('user_id');
	    	$like->save();

	    	return response()->json([$like]);
    	} else {
            $unlike = $userLikes[0]->where('post_id', $postId)
                                    ->where('user_id', request('user_id'))
                                    ->get();
            $unlike[0]->delete();

            return response()->json(['message' => 'Unliked']);
        }
    }
}
