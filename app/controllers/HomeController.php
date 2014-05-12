<?php

/*
	The controller which handles the logic behind the login and the user data pages.
*/

class HomeController extends BaseController 
{
	/*
		Grabs the index page and renders it
		for the users so they can log in.
	*/

	public function getIndex()
	{
		return View::make('index')
		->with('title', 'Bassengweb');
	}

	/*
		Takes the login information from the login page
		and attempts to log the user in, if it failes the
		user is redirected back to the login page with errors.
	*/

	public function postLogin()
	{
		$credentials = Input::all();

		$rules = array(
			'username' => 'required',
			'password' => 'required'
		);

		$message = array(
		'password.required' => '<b>Passord </b> er <b> nødvendig </b>',
		'username.required' => '<b>Brukernavn </b> er <b> nødvendig </b>'
		);

		$v = Validator::make($credentials, $rules, $message);
		if($v->fails())
		{
			return Redirect::route('bassengweb')
			->withErrors($v)
			->withInput();
		}
		else
		{
			if(Auth::attempt(array('user_name' => $credentials['username'], 'password' => $credentials['password'])))
			{
				if(Auth::user()->active == 1)
				{
					return Redirect::route('timemaling');
				}
				else
				{
					$user = Auth::user()->user_name;
					Auth::logout();					;
					return Redirect::route('bassengweb')
					->with('error', 'Brukeren '.$user.' er deaktivert/slettet. Vennligst kontakt administrator.');
				}
			}
			else
			{
				return Redirect::route('bassengweb')
				->with('error', '<b>Brukernavn/passord</b> er <b>feil</b>, vennligst prøv igjen.')
				->withInput();
			}
		}
	}

	/*
		Logs the user out of the application and redirects
		them to the login page.
	*/

	public function getLogout()
	{
		$user = Auth::user()->user_name;
		Auth::logout();

		return Redirect::route('bassengweb')
		->with('message', 'Du er nå logget ut fra bruker ['.$user.'].');
	}

	/*
		Grabs the information on the logged in user and redirects them
		view page which displays it. If the user is an admin, the redirect will be
		to an admin version of the page.
	*/

	public function getUserData()
	{
		$aktiv = 'minside';
		
		if(Auth::user()->user_type == 'admin')
		{
			$inactive = Emp::where('active', '=', '0')->lists('email', 'id');
			$active = Emp::where('active', '=', '1')->lists('email', 'id');

			return View::make('admin_data')
			->with('title', '[Admin] Bruker Data')
			->with('user', Emp::find(Auth::user()->id))
			->with('emps', $active)
			->with('aktiv', $aktiv)
			->with('deactEmps', $inactive);
		}
		else
		{
			return View::make('user_data')
			->with('title', Auth::user()->user_name.' informasjon')
			->with('aktiv', $aktiv)
			->with('user', Emp::find(Auth::user()->id));
		}
	}
	
}