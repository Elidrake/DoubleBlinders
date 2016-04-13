<?php namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use DB, Auth, Redirect, Input, Validator, Mail, Hash, Carbon\Carbon;
use App\User, Response;

class AccountCreateController extends Controller {

	public function __construct(){
		$this->middleware('beforeAccountCreateV1', ['only' => ['store']]);
	}

	public function index()
	{
		$account = Auth::user();

		return Response::json(array(
			'account'=>$account),
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
		//Setup
		$input = Input::all();
		$user = new User;

    	//Storage
		$user->name = $input['name'];
		$user->email = strtolower($input['email']);
		$user->password = Hash::make($input['password']);
		$user->save();

		return Redirect::to('account/login')
			->with('message', 'Account Successfully Created, Login')
			->with('error', True);
	}
}
