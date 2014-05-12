<?php

/*
	Handles the logic and data behind the Timemaling page.
*/

class TimeMalingController extends BaseController
{
	/*
		Grabs the view file for Timemaling and returns
		it's rendering with the defined variables.
	*/

	public function getTimeMaling()
	{
		$timezone = 'Europe/Oslo';
		date_default_timezone_set($timezone);
		$time = strftime('%H:%M:%S');

		$aktiv = 'timemaling';
		
		// Finds the last 10 hourly measurements which are completed for the day
		$tenLast = Routine::whereHas('measurements', function($q){
			$q->where('title', 'LIKE', 'T_%');
			$q->where('pool_id', '!=', '99');
			$q->where('date', '=', date('Y-m-d'));
		})->with('emps')->take(10)->orderBy('time', 'DESC')->get();

		return View::make('timemaling')
		->with('title', 'Timemåling')
		->with('time', $time)
		->with('aktiv', $aktiv)
		->with('pools', Pool::lists('name', 'id'))
		->with('tenLast', $tenLast);
	}

	/*
		Grabs the form data from the TimeMaling view page, runs validation
		on it. Upon failure, the user gets rediriected back with errors. Upon
		success the data is taken and is manipulated before being stored in the
		database and redirects the user back with a success message.
	*/

	public function postInsert()
	{
		$input = Input::except('_token', 'pool_id', 'Time'); // Grab input from the view page.
		
		$message = array(
		'integer' => '<b>:attribute </b> må være <b>heltall </b> | Eksempel (5)',
		'regex' => '<b>:attribute </b> må være <b> desimaltall </b> | Eksempel: (23,34)'
		); // Messages to be returned on validation errors.
		
		$v = Measurement::validate($input, $message); // Create the validator instance.
		if($v->fails())
		{
			return Redirect::route('timemaling')
			->withErrors($v)->withInput();
		}

		$timezone = 'Europe/Oslo'; // Set timezone and date to be inserted with insert queries.
		date_default_timezone_set($timezone);
		$date = strftime('%Y/%m/%d');

		$result=array_keys($input, '', true); // Checks if there is any unchecked checkboxes in the input.
		foreach($result as $key)
		{
  			unset($input[$key]); // If there are unchecked boxes, we unset them since we're interessted in what is done.
		}

		foreach ($input as $input => $value) // The loop that insert each of the inputs as a seperate entity in the database.
		{
			$data = array(
				'date' => $date,
			 	'time' => Input::get('Time'),
			 	'value' => $value,
			 	'emp_id' => Auth::user()->id);

			$routine = Routine::create($data); // Create the db entity.
			$connect = Measurement::where('title', '=', $input)->get(); // Gotta grab the ID for which measurement/task is in our input.

			foreach ($connect as $connect)
			{
				$link = $connect->id; // Since we insert them seperatly we have to grab the ID's seperatly aswell.
			}

			$routine->measurements()->attach($link, array('pool_id' => Input::get('pool_id'))); // Links the DB entity with the correct ID's in other tables, and inserts.

		}

		return Redirect::route('timemaling') // Redirects user to view page and throws a success flash message.
		->with('message', 'Lagret i databasen!');
	}
}