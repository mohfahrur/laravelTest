<?php namespace App\Http\Controllers;

class RegistrationController extends Controller {


	public function __construct()
	{
		$this->middleware('guest');
	}

	public function login()
	{
		return view('auth/login');
	}


}
