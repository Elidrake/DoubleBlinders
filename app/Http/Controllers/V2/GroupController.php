<?php namespace App\Http\Controllers\API\V2;

use App\Http\Controllers\Controller;
use DB, Auth, Response, Input;
use App\User, App\Group, App\UserGroup;

class GroupController extends Controller {

	public function __construct(){
		$this->middleware('beforeGroupStoreV2', ['only' => ['store']]);
	}

	/**
	 * Return groups associated with User.
	 *
	 * @return Response 200
	 * @return object groups
	 */

	public function index()
	{
		$group = new Group;
		$groups = $group->returner();

		return Response::json(array(
			'groups'=>$group),
			200
		);
	}

	/**
	 * Store a newly created User in storage.
	 *
	 * @return Response 200
	 * @return string message
	 */

	public function store()
	{
		$input = Input::all();
		$group = new Group;

		$group->groupName = $input['groupName'];
		$group->createdBy = Auth::id();
		$group->save();

		$user_group = new UserGroup;
		$user_group->user_id = Auth::id();
		$user_group->group_id = $group->id;
		$user_group->role = 1;
		$user_group->save();

		foreach($input['users'] as $userwork){
			$user = User::where('email', $userwork['email'])->get();
			if(!empty($user)){
				$user_group = new UserGroup;
				$user_group->user_id = $user->id;
				$user_group->group_id = $group->id;
				$user_group->role = $userwork['role'];
				$user_group->save();
			}
		}

		return Response::json(array(
			'error' => False,
			'message' => 'Group Successfully Created'),
			201
		);
	}
}
