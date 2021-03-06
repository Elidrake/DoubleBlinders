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
	 * Formatted under V2 specifications.
	 *
	 * @return DB Object
	 */

	public function returner(){
		$files = DB::table('files')
			->leftJoin('groups_files', 'files.id', '=', 'groups_files.file_id')
			->leftJoin('groups_assignments', 'groups_files.assignment_id', '=', 'groups_assignments.id')
			->leftJoin('groups', 'groups_files.group_id', '=', 'groups.id')
			->select('files.id', 'files.createdBy', 'files.fileContent',
					 'files.fileType', 'files.created_at as createdAt', 'groups_files.group_id as groupId', 'groups_files.assignment_id as assignmentId', 'groups_assignments.assignment_name as assignmentName', 'groups.groupName')
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
