<?php

namespace App\Http\Middleware\API\V1;

use Input, Validator, Redirect, Closure;
use App\User;

class BeforeAccountLogin {
	public function handle($request, Closure $next)
	{
		$input = Input::all();

		//Validate
		$validator = Validator::make(Input::all(), User::$login_rules);
		if(!$validator->passes()){
			$errors = $validator->errors();
			return Redirect::to('account/login')
			->with('message', $errors->first())
			->with('error', True);
		}

		return $next($request);
	}
}
