<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
use App\UserInfo;
use App\User;

class UserInfoController extends Controller
{
	/**
	 * Post user information.
	 */
    public function postInfo(Request $request)
    {
        $info = json_decode(request('info'));
        $user = User::find($info->user_id);

            //Validate the info incomming.
            $validator = Validator::make($request->all(),[
                'uploadFile' => 'max:2000|mimes:jpeg,bmp,png',
            ]);

            if($validator->fails()){
                return response()->json(['message' => 'Failed to validate']);
            }

            // Store the image in the permanent avatar folder.
            if(request()->file()){
                request()->file('uploadFile')->store('avatar', 's3');

                $file = request()->file('uploadFile')->store('avatar', 's3');
                $imageLink = Storage::disk('s3')->url($file);
            }

    	//Create the userInfo.

	    	$user->info->user_id = $info->user_id;
	    	$user->info->first_login = false;
	    	$user->info->first_name = $info->first_name;
	    	$user->info->last_name = $info->last_name;
            $user->info->avatar = $imageLink;
	    	//$userInfo->about = request('about');
	    	$user->info->country = $info->country;

	    	$user->info->save();
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
