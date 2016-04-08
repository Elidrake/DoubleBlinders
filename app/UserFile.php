<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class UserFile extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'files';

	/**
	 * Defines the required variables on
	 * comment store.
	 *
	 * @var array
	 */
	public static $storageRulesV1 = array(
		'file'=>'required',
	);

	/**
	 * Gets the all Files from storage.
	 * Formatted under V1 specifications.
	 *
	 * @return DB Object
	 */

	public function returnV1(){
		$files = DB::table('files')
			->leftJoin('users', 'files.createdBy', '=', 'users.id')
			->select('files.id', 'users.name as createdBy', 'files.fileContent',
					 'files.fileType', 'files.created_at as createdAt')
			->get();

		return $files;
	}

	/**
	 * Gets the all Files from storage.
	 * Formatted under V1 specifications.
	 * Requires UserFile to be built with ID.
	 *
	 * @return DB Object
	 */

	public function returnCommentsV1(){
		$comments = DB::table('files')
			->leftJoin('files_comments', 'files.id', '=', 'files_comments.file_id')
			->leftJoin('comments', 'files_comments.comment_id', '=', 'comments.id')
			->leftJoin('users', 'comments.createdBy', '=', 'users.id')
			->where('files.id', $this->id)
			->select('comments.id', 'comments.lineNumber', 'comments.charNumber',
			'comments.content', 'comments.created_at as createdAt',
			'users.name as createdBy')
			->get();

		return $comments;
	}

}
