<?php

/*
	Handles the logic and data for the KveldsVakt page.
*/

class KveldsVaktController extends BaseController
{
	/*
		Grabs the view file for KveldsVakt and returns
		it's rendering with the defined variables.
		Also fetchtes the tasks which are already complete
		for the day.
	*/

	public function getKveldsvakt()
	{
		$aktiv = 'kveldsvakt';

		$timezone = 'Europe/Oslo';
		date_default_timezone_set($timezone);
		$time = strftime('%H:%M:%S');
		$date = strftime('%d/%m/%Y');

		$day = strftime("%Y/%m/%d");
		$day = date('l', strtotime($day));
	
		$done = Routine::whereHas('tasks', function($q)
		{
			$date = date('Y-m-d');
			$q->where('title', 'LIKE', 'K_%');
			$q->where('date', '=', $date);
		})->get();
		
		$finito = array();
		
		foreach($done as $completed)
		{
			$finito[] = $completed->tasks[0]->title;
		}
		
		return View::make('kveldsvakt')
		->with('title', 'Kveldsvakt')
		->with('date', $date)
		->with('day', $day)
		->with('done', $finito)
		->with('time', $time)
		->with('aktiv', $aktiv);
	}

	/*
		Grabs the form data from the KveldsVakt view page, runs validation
		on it. Upon failure, the user gets rediriected back with errors. Upon
		success the data is taken and is manipulated before being stored in the
		database and redirects the user back with a success message.
	*/

	public function postInsert()
	{
		$input = Input::except('_token', 'Time', 'Date');


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

		return Redirect::route('kveldsvakt')
		->with('message', 'Lagret i databasen!');
	}
}