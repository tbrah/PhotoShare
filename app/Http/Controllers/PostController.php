<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Validator;
use App\Post;
use App\User;

class PostController extends Controller
{
   	public function postPost()
   	{
		/*Validate the form data incomming.
    	$this->validate(request(), [
        'user_id' => 'required',
        'picture_url' => 'required'
		]);*/
    $info = json_decode(request('info'));

      if(request()->file()){
        request()->file('uploadFile')->store('post', 's3');
          $file = request()->file('uploadFile')->store('avatar', 's3');
          $imageLink = Storage::disk('s3')->url($file);
      }

        $post = new Post();
        $post->user_id = $info->user_id;
        $post->picture_url = $imageLink;
        $post->description = $info->description;
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

    public function getPostUser($username)
    {
      $user = User::where('username', $username)->get();
      
      $user[0]->info;
      $user[0]->posts;

      return response()->json(['posts' => $user]);
    }
}
