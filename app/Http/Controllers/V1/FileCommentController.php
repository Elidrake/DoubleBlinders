<?php namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Response, Input, Auth;
use App\UserFile, App\Comment, App\FileComment;

class FileCommentController extends Controller {

	public function __construct() {
		$this->middleware('beforeCommentStoreV1', ['only' => ['store']]);
	}

	/**
	 * Display a listing of all Comments for particular File.
	 *
	 * @return Response 200
	 * @return jsonObject 'comments'
	 */

	public function index($file_id){
		$input = Input::all();
		$user_file = UserFile::find($file_id);

		$comments = $user_file->returnCommentsV1();

		return Response::json(array(
			'comments'=>$comments),
			200
		);
	}

	/**
	 * Store a newly created Comment in the DB
	 *
	 * @return Response 200
	 * @return string message
	 */

	public function store($file_id)
	{
		$input = Input::all();
		$comment = new Comment;
		$file_comment = new FileComment;

		//Create Comment
		$comment->lineNumber = $input['lineNumber'];
		$comment->charNumber = $input['charNumber'];
		$comment->createdBy = Auth::id();
		$comment->content = $input['content'];
		$comment->save();

		//Create Link
		$file_comment->file_id = $file_id;
		$file_comment->comment_id = $comment->id;
		$file_comment->save();

		return Response::json(array(
			'error' => False,
			'message' => 'Comment Successfully Created'),
			201
		);
	}
}
