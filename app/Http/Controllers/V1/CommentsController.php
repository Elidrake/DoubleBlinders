<?php namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Response, Input;
use App\Comment;

class CommentController extends Controller {

	public function __construct() {
		$this->middleware('beforeCommentStoreV1', ['only' => ['store']]);
	}

	/**
	 * Display a listing of all Comments.
	 *
	 * @return Response 200
	 * @return jsonObject 'comments'
	 */

	public function index(){
		$input = Input::all();
		$comment = new Comment;

		$comments = $comment->returnV1();

		return Response::json(array(
			'comments'=>$comments),
			200
		);
	}

	/**
	 * Store a newly created Comment in the DB
	 *
	 * @return Response 200
	 * @return jsonObject 'comment'
	 * @return string message
	 */

	public function store()
	{
		$input = Input::all();
		$comment = new Comment;

		//Create Comment
		$comment->lineNumber = $input['lineNumber'];
		$comment->charNumber = $input['charNumber'];
		$comment->userName = $input['userName'];
		$comment->content = $input['content'];
		$comment->save();

		return Response::json(array(
			'error' => False,
			'message' => 'Comment Successfully Created'),
			201
		);
	}
}
