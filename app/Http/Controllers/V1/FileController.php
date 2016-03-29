<?php namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response, Input, File, Auth;
use App\UserFile;

class FileController extends Controller {

	public function __construct() {
    $this->middleware('beforeFileStoreV1', ['only' => ['store']]);
	}

	/**
	 * Display a listing of all Files.
	 *
	 * @return Response 200
	 * @return jsonObject 'files'
	 */

	public function index(){
		$input = Input::all();
		$file = new UserFile;

		$files = $file->returnV1();

		return Response::json(array(
			'files'=>$files),
			200
		);
	}

	/**
	 * Store a newly created File in the DB
	 *
	 * @return Response 200
	 * @return string message
	 */

	public function store(Request $request)
	{
		$file = new UserFile;
    $uploaded_file = $request->file('file');

    $file_content = File::get($uploaded_file->path());

		//Create File
		$file->fileType = $uploaded_file->getClientOriginalExtension();
		$file->createdBy = Auth::id();
		$file->fileContent = $file_content;
		$file->save();

		return Response::json(array(
			'error' => False,
			'message' => 'File Successfully Stored'),
			201
		);
	}
}
