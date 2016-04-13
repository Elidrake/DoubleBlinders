<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Group extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'groups';

	/**
	 * Defines the required variables on
	 * group store.
	 *
	 * @var array
	 */
	public static $storageRulesV1 = array(
		'groupName'=>'required|string',
		'users'=>'required|array'
	);

	/**
	 * Gets the all Groups from storage.
	 * Formatted under V2 specifications.
	 *
	 * @return DB Object
	 */

	public function return(){
		$my_groups = DB::table('groups')
			->leftJoin('users_groups', 'groups.id', '=', 'users_groups.group_id')
			->where('users_groups.user_id', Auth::id())
			->where('users_groups.role', 1)
			->select('groups.*')
			->get();
		if(!empty($my_groups)){
			foreach($my_groups as $my_group){
				$my_group->users = DB::table('users_groups')
					->leftJoin('users', 'users_groups.user_id', '=', 'users.id')
					->where('users_groups.group_id', $my_group->id)
					->select('users_groups.user_id as id', 'users.name', 'users_groups.role')
					->get();
			}
		}

		$your_groups = DB::table('groups')
			->leftJoin('users_groups', 'groups.id', '=', 'users_groups.group_id')
			->where('users_groups.user_id', Auth::id())
			->where('users_groups.role', 2)
			->select('groups.*')
			->get();
		if(!empty($your_groups)){
			foreach($your_groups as $your_group){
				$your_group->users = DB::table('users_groups')
					->where('users_groups.group_id', $your_group->id)
					->select('users_groups.user_id as id', 'users_groups.role')
					->get();
			}
		}

		return array_merge($my_groups, $your_groups);
	}

}
