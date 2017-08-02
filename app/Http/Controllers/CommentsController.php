<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;

class CommentsController extends Controller
{
    public function postComment($postId)
    {
    	$this->validate(request(), [
    		'user_id' => 'required',
			'content' => 'required',
		]);

    	$comment = new Comments();
        $comment->post_id = $postId;
    	$comment->user_id = request('user_id');
    	$comment->content = request('content');
    	$comment->save();

    	return response()->json(['comment' => $comment], 201);
    }
}
