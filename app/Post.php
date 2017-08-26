<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	/**
	 * Find all the comments to specific post.
	 */
	public function comments()
    {
        return $this->hasMany('App\Comments');
    }

    public function likes()
    {
    	return $this->hasMany('App\Likes');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
