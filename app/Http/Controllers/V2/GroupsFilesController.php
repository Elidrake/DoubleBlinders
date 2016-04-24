<?php namespace App\Http\Controllers\API\V2;

use App\Http\Controllers\Controller;
use Response, Input, Auth, DB;
use App\GroupFile;

class GroupsFilesController extends Controller {

	public function __construct() {
		;
	}

	/**
	 * Return all files attached to a particular group
	 *
	 * @return Response 200
	 * @return jsonObject 'comments'
	 */

	public function index($groupId){
		$files = DB::table('groups_files')
            ->leftJoin('files', 'groups_files.file_id', '=', 'files.id')
						->where('groups_files.group_id', $groupId)
						->select('files.*')
            ->get();

		return Response::json(array(
			'files'=>$files),
			200
		);
	}

	/**
	 * create a link in the groups files table
	 *
	 * @return Response 200
	 * @return string message
	 */

	public function store($group_id)
	{
		$file_id = input['field'];

		//Create Link
		$groups_files = new GroupFile;
		$groups_files->file_id = $file_id;
		$groups_files->group_id = $group_id;
		$groups_files->save();

		return Response::json(array(
			'message'=>'Successfully Attached File to Group'),
			200
		);
	}
}
