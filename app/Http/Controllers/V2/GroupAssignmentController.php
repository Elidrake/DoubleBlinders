<?php namespace App\Http\Controllers\API\V2;

use App\Http\Controllers\Controller;
use Response, Input, Auth, DB;
use App\GroupFile;

class GroupAssignmentController extends Controller {

	public function __construct() {
		;
	}

	/**
	 * Return all assignments attached to a particular group
	 *
	 * @return Response 200
	 * @return jsonObject 'comments'
	 */

	public function index($groupId){
		$assignments = DB::table('groups_assignments')
            ->leftJoin('assignments', 'groups_assignments.assignment_id', '=', 'assignments.id')
			->where('groups_assignments.group_id', $groupId)
			->select('files.*')
            ->get();

		return Response::json(array(
			'assignments'=>$assignments),
			200
		);
	}

	/**
	 * create a link in the groups assignments table
	 *
	 * @return Response 200
	 * @return string message
	 */

	public function store($group_id)
	{
		$file_id = input['assignmentId'];

		//Create Link
		$groups_assignments = new GroupAssignment;
		$groups_assignments->assignment_id = $file_id;
		$groups_assignments->group_id = $group_id;
		$groups_assignments->save();

		return Response::json(array(
			'message'=>'Successfully Attached Assignment to Group'),
			200
		);
	}
}
