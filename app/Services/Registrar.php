<?php namespace App\Services;

use App\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'phone' => 'required|min:6',
			'password' => 'required|confirmed|min:6',
			'occupation' => 'required|min:3',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
	
        \Mail::send('emails.send', ['name' => $data['name'], 'email' => $data['email'],'phone' => $data['phone'], 'occupation' => $data['occupation']], function ($message)
        {

            $message->from('system@gojek1mail.com', 'system');
			$message->subject('New Email Registered');
            $message->to('mohfahrurrizqon@gmail.com');

        });
		
		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'phone' => $data['phone'],
			'password' => bcrypt($data['password']),
			'occupation'=> $data['occupation'],
		]);
	}

}
