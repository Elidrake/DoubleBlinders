<?php

namespace App\Http\Middleware\API\V1;

use Input, Validator, Redirect, Closure;
use App\User;

class BeforeAccountCreate {
	public function handle($request, Closure $next)
	{
		$input = Input::all();

		//Validate
		$validator = Validator::make(Input::all(), User::$creation_rules);
		if(!$validator->passes()){
			$errors = $validator->errors();
			return Redirect::to('account/register')
				->with('message', $errors->first())
				->with('error', True);
		}

		//Check for Existance of Email
		$email = strtolower($input['email']);
		$account_check = User::where('email', $email)->first();
		if(!empty($account_check)){
			$errors = $validator->errors();
			return Redirect::to('account/register')
				->with('message', 'Email Already Exists')
				->with('error', True);
		}

		return $next($request);
	}
}
