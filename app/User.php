<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * function creates a one to many relationship between the User and the Comment
     * @return type
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    
    /**
     * function creates a one to many relationship between the User and the Post 
     * @return type
     */
    public function posts() 
    {
        return $this->hasMany('App\Post');
    }
    
    
    /**
     * function that creates a one to many relationship with post made today
     * @return type
     */
    public function postsToday()
    {
        //use the where function to check if the 'created_at' column has a value
        //that is greater or equal to the today date. If so return it
        return $this->hasMany('App\Post')->where('created_at', '>=', Carbon::today());
    }
    
    /**
     * function creates a one to many relationship between the User and the Gallery Images
     * @return type
     */
    public function gallery()
    {
        return $this->hasMany('App\Gallery');
    }
}
