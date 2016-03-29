<?php

namespace App\Http\Middleware\API\V1;

use Input, Validator, Response, Closure, Route;
use App\Comment, App\UserFile;

class BeforeCommentStore {
	public function handle($request, Closure $next)
	{
		$input = Input::all();
		$route = Route::getRoutes()->match($request);

		//Validate
		$validator = Validator::make(Input::all(), Comment::$storageRulesV1);
		if(!$validator->passes()){
			return Response::json(array(
				'error' => True,
				'messages' => $validator->messages()),
				400
			);
		}

		//Make Sure File Exists
		$file_id = $route->parameter('files');
		$file = UserFile::find($file_id);
		if(empty($file)){
			return Response::json(array(
				'error' => True,
				'message' => 'File Does Not Exist'),
				400
			);
		}

		return $next($request);
	}
}
