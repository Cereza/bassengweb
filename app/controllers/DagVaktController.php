<?php

/*
	Handles the logic and data for the DagVakt page.
*/

class DagVaktController extends BaseController
{
	/*
		Grabs the view file for DagVakt and returns
		it's rendering with the defined variables.
		Also fetchtes the tasks which are already complete
		for the day.
	*/

	public function getDagvakt()
	{
		$aktiv = 'dagvakt';

		$timezone = 'Europe/Oslo';
		date_default_timezone_set($timezone);
		$time = strftime('%H:%M:%S');
		$date = strftime('%d/%m/%Y');

		
		$day = strftime("%Y/%m/%d");
		$day = date('l', strtotime($day));
		
		$done = Routine::whereHas('tasks', function($q)
		{
			$date = date('Y-m-d');
			$q->where('title', 'LIKE', 'D_%');
			$q->where('date', '=', $date);
		})->get();
		$finito = array();

		foreach($done as $completed)
		{
			$finito[] = $completed->tasks[0]->title;
		}
		
		return View::make('dagvakt')
		->with('title', 'Dagvakt')
		->with('date', $date)
		->with('day', $day)
		->with('time', $time)
		->with('done', $finito)
		->with('aktiv', $aktiv);
	}

	/*
		Grabs the form data from the DagVakt view page, runs validation
		on it. Upon failure, the user gets rediriected back with errors. Upon
		success the data is taken and is manipulated before being stored in the
		database and redirects the user back with a success message.
	*/

	public function postInsert()
	{
		$input = Input::except('_token', 'Date', 'Time');


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

		return Redirect::route('dagvakt')
		->with('message', 'Lagret i databasen!');
	}
}