<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB, Auth, Response, Input, Validator, Redirect, Hash, Carbon\Carbon;
use App\User;

class UsersUtilityController extends Controller {
	protected $layout = 'layouts.main';

	public function getLogin()
	{
		if (Auth::check())
		{
			return Redirect::to('/')->with('message', 'You\'re Already Logged In');
		}
		return view('login');
	}

	public function getLogout()
	{
		Auth::logout();
		return Redirect::to('account/login')->with('message', 'You\'ve Been Logged Out');
	}

	public function getRegister()
	{
		return view('register');
	}
}
