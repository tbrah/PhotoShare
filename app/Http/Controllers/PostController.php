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
      $userPosts = $user[0]->posts;

      foreach ($userPosts as $post) {
        $postComments = $post->comments;
        $postLikes = $post->likes;
        // Grab the user information for each comment.
        foreach ($postComments as $comment) {
          $userOfComment = $comment->user;
          $userInfoOfComment = $userOfComment->info;
        }
        // Grab the user information for each like.
        foreach ($postLikes as $like){
          $userOfLike = $like->user;
          $userInfoOfLike = $userOfLike->info;
        }
      }

      return response()->json([$user]);
    }
}
