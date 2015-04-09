<?php

class AuthController extends BaseController {

	public function postSignup() {
		$rules = array(
			'username' => 'required|alpha_num|between:3,20',
			'password' => 'required|min:6',
			'email' => 'required|email|unique:users,email'
			);

		$validator = Validator::make(Input::all(),$rules);

		if($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		} 
		else {
			$user = new User;
			$user->password = Hash::make(Input::get('password'));
			$user->email = Input::get('email');
			$user->username = Input::get('username');
			$user->save();
			Auth::loginUsingId($user->id);
			return Redirect::back();
		}
	}

	public function postLogin() {

		$rules = array(
			'email' => 'required|email',
			'password' => 'required'
			);

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()) {
			return Redirect::to('/')->withErrors($validator)->withInput();
		}
		else {
			if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))) {
				return Redirect::to('/');
			} else {
				Session::flash('authError', 'Wrong email and/or password');
				return Redirect::to('/');
			}
		}
	}

	public function getLogout() {
		Auth::logout();
		return Redirect::to('/');
	}


}
