<?php namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use DB, Auth, Response, Input, Validator, Mail, Hash, Carbon\Carbon, Redirect, Session;
use App\User;

class AccountLoginController extends Controller {

	public function __construct(){
		$this->middleware('beforeAccountLoginV1', ['only' => ['store']]);
	}

	/**
	 * Log a user into the Site.
	 *
	 * @return Response 200
	 * @return string message
	 */

	public function store()
	{
    $input = Input::all();

    if (Auth::attempt(array('email'=>strtolower($input['email']), 'password'=>$input['password']), true)) {
			return Redirect::to('/')->with('message', 'You\'ve Been Logged In')->with('error', False);
		}
    else {
			return Redirect::to('account/login')->with('message', 'Your Username/Password Combination was Incorrect')->with('error', True);
		}
	}

  /**
   * Log user out of the Site.
   *
   * @return Response 200
   * @return string message
   */

   public function destroy()
   {
     Auth::logout();

     return Response::json(array(
       'error' => False,
       'message' => 'You have been Successfully Logged Out'),
       200
     );
   }
}
