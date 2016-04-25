<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB, Auth;

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
		'users'=>'required|string'
	);

	/**
	 * Gets the all Groups from storage.
	 * Formatted under V2 specifications.
	 *
	 * @return DB Object
	 */

	public function returner(){
		$your_groups = DB::table('groups')
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

		return $groups;
	}

}
