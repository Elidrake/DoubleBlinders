<?php

namespace App\Http\Middleware\API\V1;

use Input, Validator, Response, Closure;
use App\Comment;

class BeforeCommentStore {
	public function handle($request, Closure $next)
	{
		$input = Input::all();

		//Validate
		$validator = Validator::make(Input::all(), Comment::$storageRulesV1);
		if(!$validator->passes()){
			return Response::json(array(
				'error' => True,
				'messages' => $validator->messages()),
				400
			);
		}

		return $next($request);
	}
}
