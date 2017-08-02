<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    //Check if the user is verified or not before giving token.
    public function findForPassport($email)
    {
        $user = $this->where('email', $email)->first();
        if($user->verified == true){
            return $user;
        }
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'token', 'resetToken',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * UserInfo is owned by a user.
     */
    public function info()
    {
        return $this->hasOne('App\UserInfo');
    }

    /**
     *  Posts user has created.
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     *  Grab all the comments a user has made.
     */
    public function comments()
    {
        return $this->hasMany('App\Comments');
    }

    /**
     * The users the logged user follows.
     */
    public function follows()
    {
        return $this->hasMany('App\Follows');
    }

    /**
     *  The users that are following the logged user.
     */
    public function followers()
    {
        return $this->hasMany('App\Followers');
    }
}
