<?php

/*
	Handles the logic and data for the KontrollCM page.
*/

class KontrollCmController extends BaseController
{
	/*
		Grabs the view file for KontrollCM and returns
		it's rendering with the defined variables.
		Also fetchtes the tasks which are already complete
		for the day.
	*/

	public function getKontrollCM()
	{
		$aktiv = 'kontrollcm';

		$timezone = 'Europe/Oslo';
		date_default_timezone_set($timezone);
		$time = strftime('%H:%M:%S');
		$date = strftime('%d/%m/%Y');
		$day = strftime("%Y/%m/%d");
		$day = date('l', strtotime($day));
		
		$done = Routine::whereHas('tasks', function($q)
		{
			$date = date('Y-m-d');
			$q->where('title', 'LIKE', 'C_%');
			$q->where('date', '=', $date);
		})->get();
		$finito = array();

		foreach($done as $completed)
		{
			$finito[] = $completed->tasks[0]->title;
		}
		
		return View::make('kontrollcm')
		->with('title', 'Kontroll CM')
		->with('date', $date)
		->with('time', $time)
		->with('done', $finito)
		->with('day', $day)
		->with('aktiv', $aktiv);
	}

	/*
		Grabs the form data from the KonrtollCM view page, runs validation
		on it. Upon failure, the user gets rediriected back with errors. Upon
		success the data is taken and is manipulated before being stored in the
		database and redirects the user back with a success message.
	*/

	public function postInsert()
	{
		$input = Input::except('_token', 'Time', 'Date');

		$message = array(
		
		'integer' => '<b>:attribute </b> må være <b>heltall </b> | Eksempel (5)',
		'regex' => '<b>:attribute </b> må være <b> desimaltall </b> | Eksempel: (23,34)'
		
		);
		
		
		$v = Task::validate($input, $message);
		if($v->fails())
		{
			return Redirect::route('kontrollcm')
			->withErrors($v)->withInput();
		}

		$date = str_replace("/","-", Input::get('Date'));
		$date = date('Y-m-d', strtotime($date));

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
			$connect = Task::where('title', '=', $input)->get();

			foreach ($connect as $connect)
			{
				$link = $connect->id;
			}

			$routine->tasks()->attach($link);
		}



		return Redirect::route('kontrollcm')
		->with('message', 'Lagret i databasen!');
	}
}