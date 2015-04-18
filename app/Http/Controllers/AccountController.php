<?php namespace App\Http\Controllers;

use Input;
use Validator;
use Redirect;
use Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class AccountController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}


	public function showLogin() {
		return view('auth/login');
	}

	public function doLogin() {
		// get all post data
		$data = Input::all();

		// Applying validation rules
		$rules = array(
			'email' => 'required|email',
			'password' => 'required|min:6',
		);

		$validator = Validator::make($data, $rules);

		if ($validator->fails()) {
			return Redirect::to('/login')->withInput(Input::except('password'))->withErrors($validator);
		} else {
			$userdata = array(
				'email' => Input::get('email'),
				'password' => Input::get('password')
			);

			if (Auth::validate($userdata)) {
				if (Auth::attempt($userdata)) {
					return Redirect::intended('/');
				}
			} else {
				Session::flash('error', 'Something went wrong');
				return Redirect::to('login');
			}
		}
	}

	public function logout() {
	  Auth::logout(); // logout user
	  return Redirect::to('login'); //redirect back to login
	}
}

?>