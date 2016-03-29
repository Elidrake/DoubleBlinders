<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Validation rules for account creation.
     *
     * @var array
     */
    public static $creation_rules = array(
  		'password'=>'required|between:6,128',
  		'passwordRt'=>'required|between:6,128|same:password',
  		'email'=>'required|email',
  		'name'=>'required|string',
  	);

    /**
     * Validation rules for account login.
     *
     * @var array
     */
    public static $login_rules = array(
  		'password'=>'required|between:6,128',
  		'email'=>'required|email',
  	);
}
