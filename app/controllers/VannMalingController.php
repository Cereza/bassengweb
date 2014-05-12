<?php

/*
	Handles the logic and data for the VannMaling page.
*/

class VannMalingController extends BaseController
{
	/*
		Grabs the view file for VannMaling and returns
		it's rendering with the defined variables.
	*/

	public function getVannMaling()
	{
		$aktiv = 'vannmaling';

		$timezone = 'Europe/Oslo';
		date_default_timezone_set($timezone);
		$time = strftime('%H:%M:%S');

		return View::make('vannmaling')
		->with('title', 'Vannmåling')
		->with('aktiv', $aktiv)
		->with('time', $time)
		->with('pools', Pool::lists('name', 'id'));
	}

	/*
		Grabs the form data from the VannMaling view page, runs validation
		on it. Upon failure, the user gets rediriected back with errors. Upon
		success the data is taken and is manipulated before being stored in the
		database and redirects the user back with a success message.
	*/

	public function postInsert()
	{
		$input = Input::except('_token', 'Time', 'pool_id');

		$message = array(
		
		'integer' => '<b>:attribute </b> må være <b>heltall </b> | Eksempel (5)',
		'regex' => '<b>:attribute </b> må være <b> desimaltall </b> | Eksempel: (23,34)'
		
		);
		
		
		
		$v = Measurement::validate($input, $message);
		if($v->fails())
		{
			return Redirect::route('vannmaling')
			->withErrors($v)->withInput();
		}

		$timezone = 'Europe/Oslo';
		date_default_timezone_set($timezone);
		$date = strftime('%Y/%m/%d');

		$result=array_keys($input, '', true);
		foreach($result as $key)
		{
  			unset($input[$key]);
		}

		foreach ($input as $input => $value) 
		{
			$data = array(
				'date' => $date,
			 	'time' => Input::get('Time'),
			 	'value' => $value,
			 	'emp_id' => Auth::user()->id);

			$routine = Routine::create($data);
			$connect = Measurement::where('title', '=', $input)->get();

			foreach ($connect as $connect)
			{
				$link = $connect->id;
			}

			$routine->measurements()->attach($link, array('pool_id' => Input::get('pool_id')));
		}

		return Redirect::route('vannmaling')
		->with('message', 'Lagret i databasen!');
	}
}