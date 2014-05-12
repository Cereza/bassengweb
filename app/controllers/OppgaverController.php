<?php

/*
	Handles the logic and data for the Oppgaver page.
*/

class OppgaverController extends BaseController
{
	/*
		Grabs the view file for Oppgaver and returns
		it's rendering with the defined variables.
	*/

	public function getOppgaver()
	{
		$aktiv = 'oppgaver';

		$timezone = 'Europe/Oslo';
		date_default_timezone_set($timezone);
		$time = strftime('%H:%M:%S');
		$date = strftime('%d/%m/%Y');
		
		
		

		return View::make('oppgaver')
		->with('title', 'Oppgaver')
		->with('aktiv', $aktiv)
		->with('time', $time)
		->with('date', $date)
		->with('pools', Pool::lists('name', 'id'));
	}

	/*
		Grabs the form data from the Oppgaver view page, runs validation
		on it. Upon failure, the user gets rediriected back with errors. Upon
		success the data is taken and is manipulated before being stored in the
		database and redirects the user back with a success message.
	*/

	public function postInsert()
	{
		$input = Input::except('_token', 'Time', 'Date', 'pool_id');
	
		$message = array(
		
		'integer' => '<b>:attribute </b> må være <b>heltall </b> | Eksempel (5)',
		'regex' => '<b>:attribute </b> må være <b> desimaltall </b> | Eksempel: (23,34)'
		
		);
	
		$v = Measurement::validate($input, $message);
		if($v->fails())
		{
			return Redirect::route('oppgaver')
			->withErrors($v)->withInput();
		}


		$date = str_replace("/","-", Input::get('Date'));
		$date = date('Y-m-d', strtotime($date));
		
		if (isset ($input['O_Kals_Klor'][0]))
		{
			$input['O_Kals_Klor']='Utført'; 
		}
		elseif(isset ($input['O_Kals_Klor'][1]))
		{
			$input['O_Kals_Klor'] = $input['O_Kals_Klor'][1];
		}
		else
		{
			unset ($input['O_Kals_Klor']);
		}
		
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

		return Redirect::route('oppgaver')
		->with('message', 'Lagret i databasen!');
	}

}