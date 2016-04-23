<?php namespace App\Http\Controllers\API\V2;

use App\Http\Controllers\Controller;
use Response, Input, Auth;
use App\UserFile, App\Comment, App\GroupFile;

class GroupsFilesController extends Controller {

	public function __construct() {
		$this->middleware('beforeGroupStoreV2', ['only' => ['store']]);
	}

	/**
	 * Return all files attached to a particular group
	 *
	 * @return Response 200
	 * @return jsonObject 'comments'
	 */

	public function index($groupId){
		$files = DB::table('groups_files')
            ->leftJoin('files', $groupId, '=', 'files.file_id')
            ->leftJoin('groups', $groupId, '=', 'groups.group_id')
            ->get();
        return $files;
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
		$groups_files->file_id = $file_id;
		$groups_files->group_id = $group_id;
		$groups_files->save();
	}
}