<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Comment extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comments';

	/**
	 * Defines the required variables on
	 * comment store.
	 *
	 * @var array
	 */
	public static $storageRulesV1 = array(
		'lineNumber'=>'required|integer',
		'charNumber'=>'required|integer',
		'content'=>'required|string'
	);

	/**
	 * Gets the all Comments from storage.
	 * Formatted under V1 specifications.
	 *
	 * @return DB Object
	 */

	public function returnV1(){
		$comments = DB::table('comments')
			->select('id', 'lineNumber', 'charNumber', 'userName',
					 'content', 'created_at as createdAt')
			->get();

		return $comments;
	}

}
