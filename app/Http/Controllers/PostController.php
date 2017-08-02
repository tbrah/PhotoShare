<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
   	public function postPost()
   	{
		//Validate the form data incomming.
    	$this->validate(request(), [
        'user_id' => 'required',
        'picture_url' => 'required'
		]);

        $post = new Post();
        $post->user_id = request('user_id');
        $post->picture_url = request('picture_url');
        $post->description = request('description');
        $post->likes = 0;
        $post->save();
        return response()->json(['post' => $post], 201);
   	}

   	public function getPosts()
   	{
        $posts = Post::all();
        $response = [
            'posts' => $posts
        ];
        return response()->json($response, 200);
   	}
}
