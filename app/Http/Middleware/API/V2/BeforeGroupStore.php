<?php

namespace App\Http\Middleware\API\V2;

use Input, Validator, Response, Closure, Route;
use App\Group;

class BeforeGroupStore {
	public function handle($request, Closure $next)
	{
		$input = Input::all();
		$route = Route::getRoutes()->match($request);

		//Validate
		$validator = Validator::make(Input::all(), Group::$storageRulesV1);
		if(!$validator->passes()){
			return Response::json(array(
				'error' => True,
				'messages' => $validator->messages()),
				400
			);
		}
		foreach($input['users'] as $user){
			$validator = Validator::make($user, array('email'=>'required|email','role'=>'required|integer'));
			if(!$validator->passes()){
				return Response::json(array(
					'error' => True,
					'messages' => $validator->messages()),
					400
				);
			}
		}

		return $next($request);
	}
}
