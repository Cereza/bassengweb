<?php

/*
	Handles the logic and data for the Søk page.
*/

class SokController extends BaseController 
{
	/*
		Grabs the view file for Søk and returns
		it's rendering with the defined variables.
		Returns a different view based on if the user
		is an admin or not.
	*/

	public function getSok()
	{
		$aktiv = 'sok';
		$pools = Pool::lists('name', 'id');

		if(Auth::user()->user_type == 'admin')
		{
			$date = strftime('%d/%m/%Y');

			return View::make('admin_sok')
			->with('date', $date)
			->with('aktiv', $aktiv)
			->with('pools', $pools)
			->with('title', 'Søk');
		}
		else
		{
			$date = strftime('%d/%m/%Y');

			return View::make('sok')
			->with('date', $date)
			->with('aktiv', $aktiv)
			->with('pools', $pools)
			->with('title', 'Søk');
		}
	}

	/*		
		A search function that based on critera from a form, fetches data stored 
		in the DB and returns it to the user in the Søk view (as mentioned above
		an admin will also get the option to edit and delete this data). If no data
		is found, the user is redirected with a message promting this, otherwise the
		user is redirected with the data.
	*/

	public function getData()
	{
		$aktiv = 'sok';

		$timezone = 'Europe/Oslo';
		date_default_timezone_set($timezone);
		$date = strftime('%d/%m/%Y');

		if(Input::get('kriteria') == 'time_maling') // Outer if statement checks what type of data should be fetched.
		{ 
			if(!Input::get('fraDato') && !Input::get('tilDato')) // Middle if statement checks if date is inputted and fetches data accordingly.
			{
				if(!Input::get('fraTid') && !Input::get('tilTid')) // Inner if statement checks if time is inputted and fetches data accordingly.
				{
					$data = Routine::whereHas('measurements', function($q) // Eloquent ORM call with an anonymous function handling the where criterias.
					{
						$q->where('pool_id', '=', Input::get('pool_id'));
						$q->where('title', 'LIKE', 'T_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25); // Pagination splits the result into chunks of 25.
					$type = 'measurement'; // Sends back a type of data fetched, because tasks are not linked to pools.
				}
				else
				{
					$data = Routine::whereHas('measurements', function($q)
					{
						$q->whereBetween('time', array(Input::get('fraTid'), Input::get('tilTid')));
						$q->where('pool_id', '=', Input::get('pool_id'));
						$q->where('title', 'LIKE', 'T_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'measurement';
				}
			}
			else
			{
				if(!Input::get('fraTid') && !Input::get('tilTid'))
				{
					$data = Routine::whereHas('measurements', function($q)
					{
						$fra = str_replace("/","-", Input::get('fraDato'));
						$fra = date('Y-m-d', strtotime($fra));
						$til = str_replace("/","-", Input::get('tilDato'));
						$til = date('Y-m-d', strtotime($til));

						$q->whereBetween('date', array($fra, $til));
						$q->where('pool_id', '=', Input::get('pool_id'));
						$q->where('title', 'LIKE', 'T_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'measurement';
				}
				else
				{
					$data = Routine::whereHas('measurements', function($q)
					{
						$fra = str_replace("/","-", Input::get('fraDato'));
						$fra = date('Y-m-d', strtotime($fra));
						$til = str_replace("/","-", Input::get('tilDato'));
						$til = date('Y-m-d', strtotime($til));

						$q->whereBetween('date', array($fra, $til));
						$q->whereBetween('time', array(Input::get('fraTid'), Input::get('tilTid')));
						$q->where('pool_id', '=', Input::get('pool_id'));
						$q->where('title', 'LIKE', 'T_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'measurement';
				}
			}

			if($data->isEmpty()) // Checks if the return object from Eloquent is contains data, if not redirect with error message.
			{
				return Redirect::route('sok')
				->with('noData', 'Ingen elementer funnet.');
			}
		}
		elseif(Input::get('kriteria') == 'vann_maling')
		{
			if(!Input::get('fraDato') && !Input::get('tilDato'))
			{
				if(!Input::get('fraTid') && !Input::get('tilTid'))
				{
					$data = Routine::whereHas('measurements', function($q)
					{
						$q->where('pool_id', '=', Input::get('pool_id'));
						$q->where('title', 'LIKE', 'M_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'measurement';
				}
				else
				{
					$data = Routine::whereHas('measurements', function($q)
					{
						$q->whereBetween('time', array(Input::get('fraTid'), Input::get('tilTid')));
						$q->where('pool_id', '=', Input::get('pool_id'));
						$q->where('title', 'LIKE', 'M_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'measurement';
				}
			}
			else
			{
				if(!Input::get('fraTid') && !Input::get('tilTid'))
				{
					$data = Routine::whereHas('measurements', function($q)
					{
						$fra = str_replace("/","-", Input::get('fraDato'));
						$fra = date('Y-m-d', strtotime($fra));
						$til = str_replace("/","-", Input::get('tilDato'));
						$til = date('Y-m-d', strtotime($til));

						$q->whereBetween('date', array($fra, $til));
						$q->where('pool_id', '=', Input::get('pool_id'));
						$q->where('title', 'LIKE', 'M_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'measurement';
				}
				else
				{
					$data = Routine::whereHas('measurements', function($q)
					{
						$fra = str_replace("/","-", Input::get('fraDato'));
						$fra = date('Y-m-d', strtotime($fra));
						$til = str_replace("/","-", Input::get('tilDato'));
						$til = date('Y-m-d', strtotime($til));

						$q->whereBetween('date', array($fra, $til));
						$q->whereBetween('time', array(Input::get('fraTid'), Input::get('tilTid')));
						$q->where('pool_id', '=', Input::get('pool_id'));
						$q->where('title', 'LIKE', 'M_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'measurement';
				}
			}

			if($data->isEmpty())
			{
				return Redirect::route('sok')
				->with('noData', 'Ingen elementer funnet.');
			}
		}
		elseif(Input::get('kriteria') == 'oppgaver')
		{
			if(!Input::get('fraDato') && !Input::get('tilDato'))
			{
				if(!Input::get('fraTid') && !Input::get('tilTid'))
				{
					$data = Routine::whereHas('measurements', function($q)
					{
						$q->where('pool_id', '=', Input::get('pool_id'));
						$q->where('title', 'LIKE', 'O_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'measurement';
				}
				else
				{
					$data = Routine::whereHas('measurements', function($q)
					{
						$q->whereBetween('time', array(Input::get('fraTid'), Input::get('tilTid')));
						$q->where('pool_id', '=', Input::get('pool_id'));
						$q->where('title', 'LIKE', 'O_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'measurement';
				}
			}
			else
			{
				if(!Input::get('fraTid') && !Input::get('tilTid'))
				{
					$data = Routine::whereHas('measurements', function($q)
					{
						$fra = str_replace("/","-", Input::get('fraDato'));
						$fra = date('Y-m-d', strtotime($fra));
						$til = str_replace("/","-", Input::get('tilDato'));
						$til = date('Y-m-d', strtotime($til));

						$q->whereBetween('date', array($fra, $til));
						$q->where('pool_id', '=', Input::get('pool_id'));
						$q->where('title', 'LIKE', 'O_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'measurement';
				}
				else
				{
					$data = Routine::whereHas('measurements', function($q)
					{
						$fra = str_replace("/","-", Input::get('fraDato'));
						$fra = date('Y-m-d', strtotime($fra));
						$til = str_replace("/","-", Input::get('tilDato'));
						$til = date('Y-m-d', strtotime($til));

						$q->whereBetween('date', array($fra, $til));
						$q->whereBetween('time', array(Input::get('fraTid'), Input::get('tilTid')));
						$q->where('pool_id', '=', Input::get('pool_id'));
						$q->where('title', 'LIKE', 'O_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'measurement';
				}
			}

			if($data->isEmpty())
			{
				return Redirect::route('sok')
				->with('noData', 'Ingen elementer funnet.');
			}
		}
		elseif(Input::get('kriteria') == 'dagsoppg')
		{
			if(!Input::get('fraDato') && !Input::get('tilDato'))
			{
				if(!Input::get('fraTid') && !Input::get('tilTid'))
				{
					$data = Routine::whereHas('tasks', function($q)
					{
						$q->where('title', 'LIKE', 'D_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'task';
				}
				else
				{
					$data = Routine::whereHas('tasks', function($q)
					{
						$q->whereBetween('time', array(Input::get('fraTid'), Input::get('tilTid')));
						$q->where('title', 'LIKE', 'D_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'task';
				}
			}
			else
			{
				if(!Input::get('fraTid') && !Input::get('tilTid'))
				{
					$data = Routine::whereHas('tasks', function($q)
					{
						$fra = str_replace("/","-", Input::get('fraDato'));
						$fra = date('Y-m-d', strtotime($fra));
						$til = str_replace("/","-", Input::get('tilDato'));
						$til = date('Y-m-d', strtotime($til));

						$q->whereBetween('date', array($fra, $til));
						$q->where('title', 'LIKE', 'D_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'task';
				}
				else
				{
					$data = Routine::whereHas('tasks', function($q)
					{
						$fra = str_replace("/","-", Input::get('fraDato'));
						$fra = date('Y-m-d', strtotime($fra));
						$til = str_replace("/","-", Input::get('tilDato'));
						$til = date('Y-m-d', strtotime($til));

						$q->whereBetween('date', array($fra, $til));
						$q->whereBetween('time', array(Input::get('fraTid'), Input::get('tilTid')));
						$q->where('title', 'LIKE', 'D_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'task';
				}
			}

			if($data->isEmpty())
			{
				return Redirect::route('sok')
				->with('noData', 'Ingen elementer funnet.');
			}
		}
		elseif(Input::get('kriteria') == 'kveldsoppg')
		{
			if(!Input::get('fraDato') && !Input::get('tilDato'))
			{
				if(!Input::get('fraTid') && !Input::get('tilTid'))
				{
					$data = Routine::whereHas('tasks', function($q)
					{
						$q->where('title', 'LIKE', 'K_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'task';
				}
				else
				{
					$data = Routine::whereHas('tasks', function($q)
					{
						$q->whereBetween('time', array(Input::get('fraTid'), Input::get('tilTid')));
						$q->where('title', 'LIKE', 'K_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'task';
				}
			}
			else
			{
				if(!Input::get('fraTid') && !Input::get('tilTid'))
				{
					$data = Routine::whereHas('tasks', function($q)
					{
						$fra = str_replace("/","-", Input::get('fraDato'));
						$fra = date('Y-m-d', strtotime($fra));
						$til = str_replace("/","-", Input::get('tilDato'));
						$til = date('Y-m-d', strtotime($til));

						$q->whereBetween('date', array($fra, $til));
						$q->where('title', 'LIKE', 'K_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'task';
				}
				else
				{
					$data = Routine::whereHas('tasks', function($q)
					{
						$fra = str_replace("/","-", Input::get('fraDato'));
						$fra = date('Y-m-d', strtotime($fra));
						$til = str_replace("/","-", Input::get('tilDato'));
						$til = date('Y-m-d', strtotime($til));

						$q->whereBetween('date', array($fra, $til));
						$q->whereBetween('time', array(Input::get('fraTid'), Input::get('tilTid')));
						$q->where('title', 'LIKE', 'K_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'task';
				}
			}

			if($data->isEmpty())
			{
				return Redirect::route('sok')
				->with('noData', 'Ingen elementer funnet.');
			}
		}
		elseif(Input::get('kriteria') == 'helgoppg')
		{
			if(!Input::get('fraDato') && !Input::get('tilDato'))
			{
				if(!Input::get('fraTid') && !Input::get('tilTid'))
				{
					$data = Routine::whereHas('tasks', function($q)
					{
						$q->where('title', 'LIKE', 'H_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'task';
				}
				else
				{
					$data = Routine::whereHas('tasks', function($q)
					{
						$q->whereBetween('time', array(Input::get('fraTid'), Input::get('tilTid')));
						$q->where('title', 'LIKE', 'H_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'task';
				}
			}
			else
			{
				if(!Input::get('fraTid') && !Input::get('tilTid'))
				{
					$data = Routine::whereHas('tasks', function($q)
					{
						$fra = str_replace("/","-", Input::get('fraDato'));
						$fra = date('Y-m-d', strtotime($fra));
						$til = str_replace("/","-", Input::get('tilDato'));
						$til = date('Y-m-d', strtotime($til));

						$q->whereBetween('date', array($fra, $til));
						$q->where('title', 'LIKE', 'H_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'task';
				}
				else
				{
					$data = Routine::whereHas('tasks', function($q)
					{
						$fra = str_replace("/","-", Input::get('fraDato'));
						$fra = date('Y-m-d', strtotime($fra));
						$til = str_replace("/","-", Input::get('tilDato'));
						$til = date('Y-m-d', strtotime($til));

						$q->whereBetween('date', array($fra, $til));
						$q->whereBetween('time', array(Input::get('fraTid'), Input::get('tilTid')));
						$q->where('title', 'LIKE', 'H_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'task';
				}
			}

			if($data->isEmpty())
			{
				return Redirect::route('sok')
				->with('noData', 'Ingen elementer funnet.');
			}
		}
		elseif(Input::get('kriteria') == 'kontcm')
		{
			if(!Input::get('fraDato') && !Input::get('tilDato'))
			{
				if(!Input::get('fraTid') && !Input::get('tilTid'))
				{
					$data = Routine::whereHas('tasks', function($q)
					{
						$q->where('title', 'LIKE', 'C_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'task';
				}
				else
				{
					$data = Routine::whereHas('tasks', function($q)
					{
						$q->whereBetween('time', array(Input::get('fraTid'), Input::get('tilTid')));
						$q->where('title', 'LIKE', 'C_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'task';
				}
			}
			else
			{
				if(!Input::get('fraTid') && !Input::get('tilTid'))
				{
					$data = Routine::whereHas('tasks', function($q)
					{
						$fra = str_replace("/","-", Input::get('fraDato'));
						$fra = date('Y-m-d', strtotime($fra));
						$til = str_replace("/","-", Input::get('tilDato'));
						$til = date('Y-m-d', strtotime($til));

						$q->whereBetween('date', array($fra, $til));
						$q->where('title', 'LIKE', 'C_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'task';
				}
				else
				{
					$data = Routine::whereHas('tasks', function($q)
					{
						$fra = str_replace("/","-", Input::get('fraDato'));
						$fra = date('Y-m-d', strtotime($fra));
						$til = str_replace("/","-", Input::get('tilDato'));
						$til = date('Y-m-d', strtotime($til));

						$q->whereBetween('date', array($fra, $til));
						$q->whereBetween('time', array(Input::get('fraTid'), Input::get('tilTid')));
						$q->where('title', 'LIKE', 'C_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'task';
				}
			}

			if($data->isEmpty())
			{
				return Redirect::route('sok')
				->with('noData', 'Ingen elementer funnet.');
			}
		}
		elseif(Input::get('kriteria') == 'arduino')
		{
			if(!Input::get('fraDato') && !Input::get('tilDato'))
			{
				if(!Input::get('fraTid') && !Input::get('tilTid'))
				{
					$data = Routine::whereHas('measurements', function($q)
					{
						$q->where('pool_id', '=', 1);
						$q->where('title', 'LIKE', 'A_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'measurement';
				}
				else
				{
					$data = Routine::whereHas('measurements', function($q)
					{
						$q->whereBetween('time', array(Input::get('fraTid'), Input::get('tilTid')));
						$q->where('pool_id', '=', 1);
						$q->where('title', 'LIKE', 'A_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'measurement';
				}
			}
			else
			{
				if(!Input::get('fraTid') && !Input::get('tilTid'))
				{
					$data = Routine::whereHas('measurements', function($q)
					{
						$fra = str_replace("/","-", Input::get('fraDato'));
						$fra = date('Y-m-d', strtotime($fra));
						$til = str_replace("/","-", Input::get('tilDato'));
						$til = date('Y-m-d', strtotime($til));

						$q->whereBetween('date', array($fra, $til));
						$q->where('pool_id', '=', 1);
						$q->where('title', 'LIKE', 'A_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'measurement';
				}
				else
				{
					$data = Routine::whereHas('measurements', function($q)
					{
						$fra = str_replace("/","-", Input::get('fraDato'));
						$fra = date('Y-m-d', strtotime($fra));
						$til = str_replace("/","-", Input::get('tilDato'));
						$til = date('Y-m-d', strtotime($til));

						$q->whereBetween('date', array($fra, $til));
						$q->whereBetween('time', array(Input::get('fraTid'), Input::get('tilTid')));
						$q->where('pool_id', '=', 1);
						$q->where('title', 'LIKE', 'A_%');
					})->with('emps')->orderBy('date', 'DESC')->orderBy('time', 'DESC')->paginate(25);
					$type = 'measurement';
				}
			}

			if($data->isEmpty())
			{
				return Redirect::route('sok')
				->with('noData', 'Ingen elementer funnet.');
			}
		}
		else
		{
			return Redirect::route('sok')
			->with('noData', 'Ingen kriteria valgt, vennligst velg minst ett...');
		}
		
		if(Auth::user()->user_type == 'admin') // Redirects the user back to Søk or Admin Søk with the fetched data based on user type.
		{
			return View::make('admin_sok')
			->with('title', 'Søk')
			->with('pools', Pool::lists('name', 'id'))
			->with('date', $date)
			->with('aktiv', $aktiv)
			->with('type', $type)
			->with('data', $data);
		}
		else
		{
			return View::make('sok')
			->with('title', 'Søk')
			->with('pools', Pool::lists('name', 'id'))
			->with('date', $date)
			->with('aktiv', $aktiv)
			->with('type', $type)
			->with('data', $data);
		}
	}
}