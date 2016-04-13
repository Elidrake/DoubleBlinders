<?php namespace App\Http\Controllers\API\V2;

use App\Http\Controllers\Controller;
use DB, Auth, Redirect, Input, Validator, Mail, Hash, Carbon\Carbon;
use App\User, Response, App\Comment, App\FileComment;

class GroupFileCommentController extends Controller {

	public function __construct(){
		$this->middleware('beforeCommentStoreV1', ['only' => ['store']]);
	}

	/**
	 * Return comments under specified File/Group.
	 *
	 * @var int groupId
	 * @var int fileId
	 * @return Response 200
	 * @return object comments
	 */

	public function index($groupId, $fileId)
	{
		$comment = new Comment;
		$comments = $comment->returnV2($groupId, $fileId);

		return Response::json(array(
			'comments'=>$comments),
			200
		);
	}

	/**
	 * Store a newly created User in storage.
	 *
	 * @var int groupId
	 * @var int fileId
	 * @return Response 200
	 * @return string message
	 */

	public function store($groupId, $fileId)
	{
		$input = Input::all();
		$comment = new Comment;
		$file_comment = new FileComment;

		//Create Comment
		$comment->lineNumber = $input['lineNumber'];
		$comment->charNumber = $input['charNumber'];
		$comment->groupId = $groupId;
		$comment->createdBy = Auth::id();
		$comment->content = $input['content'];
		$comment->save();

		//Create Link
		$file_comment->file_id = $fileId;
		$file_comment->comment_id = $comment->id;
		$file_comment->save();

		return Response::json(array(
			'error' => False,
			'message' => 'Comment Successfully Created'),
			201
		);
	}
}
