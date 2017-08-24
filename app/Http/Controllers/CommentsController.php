<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;
use App\Post;

class CommentsController extends Controller
{
    public function postComment($postId)
    {
    	$this->validate(request(), [
    		'user_id' => 'required',
			'comment' => 'required',
            'post_id' => 'required'
		]);

    	$comment = new Comments();
        $comment->post_id = $postId;
    	$comment->user_id = request('user_id');
    	$comment->content = request('comment');
    	$comment->save();

    	return response()->json(['comment' => $comment], 201);
    }

    public function getComments($postId)
    {
        $post = Post::find($postId);
        $postComments = $post->comments;

        foreach ($postComments as $comment) {
            $user = $comment->user;
            $userInfo = $user->info;
        }

        return response()->json($post);
    }

    public function deleteComment($postId, $commentId)
    {
        $userId = request('user_id');
        $post = Post::find($postId);
        $comment = Comments::find($commentId);
        if($userId == $comment->user_id || $userId == $post->user_id){
            $comment->delete();
            return response()->json(['message' => 'Comment deleted'], 200);
        } else {
            return response()->json(['message' => 'There occured an error']);
        }
        
    }
}
