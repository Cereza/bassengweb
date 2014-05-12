<?php

/*
	The controller which handles the logic for the administrative tasks within the application,
	manages input and the modifies and sends output to the view files for users to view.
*/

class AdminController extends BaseController
{
	/*
		Grabs the update page for a measurement or a task,
		$id gets injected via the route that triggers this
		function.
	*/

	public function getUpdatePage($id)
	{
		$aktiv = 'sok';
		
		return View::make('data_edit')
		->with('title', 'Rediger måling/oppgave')
		->with('data', Routine::find($id))
		->with('aktiv', $aktiv)
		->with('emp', Emp::lists('user_name', 'id'));
	}

	/*
		Grabs the delete confirmation page for a measurement or a task,
		$id gets injected via the route that triggers this function.
	*/

	public function getDeletePage($id)
	{
		$aktiv = 'sok';
		
		return View::make('confirm_delete')
		->with('title', 'Slett måling/oppgave')
		->with('aktiv', $aktiv)
		->with('data', Routine::find($id))
		->with('pools', Pool::lists('name', 'id'));
	}

	/*
		Takes the inputs from the update page, loads the correct measurement
		or task based on id taken from a form and runs a query to update the data in the DB, and
		creates an instance of the changelog model and saves the changes made to
		the updated data aswell.
	*/

	public function putUpdateData()
	{
		$sDate = str_replace("/","-", Input::get('saved_date'));
		$sDate = date('Y-m-d', strtotime($sDate));

		$date = date('Y-m-d');

		$timezone = 'Europe/Oslo';
		date_default_timezone_set($timezone);
		$time = strftime('%H:%M:%S');

		$chlog = new ChangeLog;
		$chlog->routine_id = Input::get('id');
		$chlog->title = Input::get('title');
		$chlog->value_old = Input::get('value_old');
		$chlog->value_new = Input::get('value');
		$chlog->action = 'Redigert';
		$chlog->changed_at = $date;
		$chlog->date = $sDate;
		$chlog->time = $time;
		$chlog->changed_by = Input::get('changed_by');
		$chlog->save();

		Routine::find(Input::get('id'))->update(array(
			'value' => Input::get('value'),
			'date' => date('Y-m-d', strtotime(str_replace('/','-', Input::get('date')))),
			'time' => Input::get('time'),
			'emp_id' => Input::get('emp')
		));

		return Redirect::route('sok')
		->with('message', 'Endringer er lagret!');
	}

	/*
		Finds the correct routine stored in the database based on ID taken from a form
		and then deletes that row, also creates an instance of the changelog
		model which saves the deletion, then redirects the user with a success message.
	*/

	public function deleteDestroyData()
	{
		$sDate = str_replace("/","-", Input::get('saved_date'));
		$sDate = date('Y-m-d', strtotime($sDate));

		$date = date('Y-m-d');

		$timezone = 'Europe/Oslo';
		date_default_timezone_set($timezone);
		$time = strftime('%H:%M:%S');

		$chlog = new ChangeLog;
		$chlog->routine_id = Input::get('id');
		$chlog->title = Input::get('title');
		$chlog->value_old = Input::get('value_old');
		$chlog->value_new = 'Ingen';
		$chlog->action = 'Slettet';
		$chlog->changed_at = $date;
		$chlog->date = $sDate;
		$chlog->time = $time;
		$chlog->changed_by = Input::get('changed_by');
		$chlog->save();
	
		Routine::find(Input::get('id'))->delete();

		return Redirect::route('sok')
		->with('message', 'Sletting utført!');
	}

	/*
		Grabs the view for creating users and renders it.
	*/

	public function getUserCreatePage()
	{
		$aktiv = 'minside';

		return View::make('user_create')
		->with('aktiv', $aktiv)
		->with('title', 'Opprettelse av bruker');
	}

	/*
		Grabs the view for updating users and renders it.
	*/

	public function getUserUpdatePage()
	{
		$emp = Emp::find(Input::get('empId'));

		$aktiv = 'minside';

		return View::make('user_edit')
		->with('title','Rediger Bruker')
		->with('aktiv', $aktiv)
		->with('user', $emp);
	}

	/*
		Grabs the view for deleting users and renders it.
	*/

	public function getUserDeletePage()
	{
		$emp = Emp::find(Input::get('delEmpId'));

		$aktiv = 'minside';
		
		return View::make('user_delete')
		->with('title', 'Bekreft deaktivering')
		->with('aktiv', $aktiv)
		->with('user', $emp);
	}

	/*
		Takes input from a form and validates the data before creating a user, upon validation failure
		redirects the user to the creation page with error messages. Upon successful validation creates
		a new instance of Emp and saves it in the database, then redirects the user with a success message.
	*/

	public function postCreateUser()
	{
		$input = Input::except('_token');
		
		$message = array(
		'first_name.required' => 'Fornavn er nødvendig.',
		'first_name.min' => 'Fornavn må være minst to karakterer lang.',
		'first_name.max' => 'Fornavn må være maks 15 karakterer lang.',
		'last_name.required' => 'Etternavn er nødvendig.',
		'last_name.min' => 'Etternavn må være minst to karakterer lang.',
		'last_name.max' => 'Etternavn må være maks 15 karakterer lang.',
		'email.required' => 'E-post er nødvendig.',
		'email.email' => 'E-post er ikke gyldig.',
		'email.unique' => 'E-post finnes allerede, den må være unik.',
		'user_type.required' => 'Brukertype er nødvendig.',
		'password.required' => 'Passord er nødvendig.',
		'password.min' => 'Passord må være minst 5 karakterer.',
		'password.alphanum' => 'Passord kan kun inneholde tall og bokstaver',
		'password_confirmation.required' => 'Passord bekreftelse er nødvendig.',
		'password_confirmation.alphanum' => 'Passord kan kun inneholde tall og bokstaver',
		'password_confirmation.max' => 'Passord bekreftelse må være minst 5 karakterer.',
		'password.confirmed' => 'Passordfeltene må stemme overens.',
		'user_type.regex' => 'Brukertype må være enten user eller admin.'
		);
		
		$v = Emp::validate($input, $message);
		if($v->passes())
		{
			$user = new Emp;
			$user->user_name = $input['first_name'].''.substr($input['last_name'], 0, 1);
			$user->first_name = $input['first_name'];
			$user->last_name = $input['last_name'];
			$user->email = $input['email'];
			$user->password = Hash::make($input['password']);
			$user->user_type = $input['user_type'];
			$user->active = 1;
			$user->save();

			return Redirect::route('user_data')
			->with('message', 'Bruker '.$user->user_name.' Opprettet!');
		}
		else
		{
			return Redirect::route('create_user')
			->withInput()
			->withErrors($v);
		}
	}

	/*
		Pretty much the same as create user, the only exception being that instead of
		inserting a new row, we update an existing one in the emp table.
	*/

	public function putUpdateUser()
	{	
		$message = array(
			'first_name.required' => 'Fornavn er nødvendig.',
			'first_name.min' => 'Fornavn må være minst to karakterer lang.',
			'first_name.max' => 'Fornavn må være maks 15 karakterer lang.',
			'last_name.required' => 'Etternavn er nødvendig.',
			'last_name.min' => 'Etternavn må være minst to karakterer lang.',
			'last_name.max' => 'Etternavn må være maks 15 karakterer lang.',
			'email.required' => 'E-post er nødvendig.',
			'email.email' => 'E-post er ikke gyldig.',
			'email.unique' => 'E-post finnes allerede, den må være unik.',
			'user_type.required' => 'Brukertype er nødvendig.',
			'password.required' => 'Passord er nødvendig.',
			'password.min' => 'Passord må være minst 5 karakterer.',
			'password.alphanum' => 'Passord kan kun inneholde tall og bokstaver',
			'password_confirmation.required' => 'Passord bekreftelse er nødvendig.',
			'password_confirmation.alphanum' => 'Passord kan kun inneholde tall og bokstaver',
			'password_confirmation.max' => 'Passord bekreftelse må være minst 5 karakterer.',
			'password.confirmed' => 'Passordfeltene må stemme overens.',
			'user_type.regex' => 'Brukertype må være enten user eller admin.'
			);
	
	
		if(Input::get('password'))
		{
			if(Input::get('password') == Input::get('conf_password'))
			{
				$v = Emp::validateUpdate(Input::except('_token'), $message);
				if($v->passes())
				{
					Emp::find(Input::get('id'))->update(array(
					'first_name' => Input::get('first_name'),
					'last_name' => Input::get('last_name'),
					'user_name' => Input::get('first_name').''.substr(Input::get('last_name'), 0, 1),
					'email' => Input::get('email'),
					'password' => Hash::make(Input::get('password')),
					'user_type' => Input::get('user_type')
					));

					return Redirect::route('user_data')
					->with('message', 'Bruker '.Input::get('user_name').' oppdatert!');
				}
				else
				{
					return Redirect::back()
					->withInput()
					->withErrors($v);
				}
			}
			else
			{
				return Redirect::back()
				->with('message', 'Passord feltene stemmer ikke overens, vennligst prøv igjen.')
				->withInput();
			}
		}
		else
		{
			$v = Emp::validateUpdate(Input::except('_token'), $message);
			if($v->passes())
			{
				Emp::find(Input::get('id'))->update(array(
					'user_name' => Input::get('first_name').''.substr(Input::get('last_name'), 0, 1),
					'first_name' => Input::get('first_name'),
					'last_name' => Input::get('last_name'),
					'email' => Input::get('email'),
					'user_type' => Input::get('user_type')
					));

				return Redirect::route('user_data')
				->with('message', 'Bruker '.Input::get('user_name').' oppdatert!');
			}
			else
			{
				return Redirect::back()
				->withInput()
				->withErrors($v);
			}
		}	
	}

	/*
		Finds the correct entry in the emp table based on ID given via form
		and soft deletes it by setting it's active variable to 0. (Soft deletion
		was chosen due to all entries connected to a person disappearing if the
		person is deleted).
	*/

	public function deleteDestroyUser()
	{
		$user = Emp::find(Input::get('id'));
		if($user->id == Auth::user()->id)
		{
			return Redirect::route('user_data')
			->with('message', 'Du kan ikke deaktivere deg selv mens du er logget inn.');
		}
		else
		{
			$user->active = 0;
			$user->save();
		}

		return Redirect::route('user_data')
		->with('message', 'Bruker '.$user->user_name.' deaktivert.');
	}

	/*
		Finds a user in the emp table based on an ID recieved from a form
		which shows emps with the active variable set to 0. Upon getting called
		this function activates the user by setting active to 1.
	*/

	public function putActivateUser()
	{
		$user = Emp::find(Input::get('actEmpId'));
		$user->active = 1;
		$user->save();

		return Redirect::route('user_data')
		->with('message', 'Bruker '.$user->user_name.' aktivert.');
	}

	/*
		Grabs the view for the changelog page along with the entries in the change_log
		table, which gets manipulated and sent to the rendered view.
	*/

	public function getChangeLogPage()
	{
		$chlog = ChangeLog::orderBy('changed_at', 'DESC')->orderBy('time', 'DESC')->paginate(25);

		$aktiv = 'minside';

		return View::make('change_log')
		->with('title', 'Endringslogg')
		->with('aktiv',$aktiv)
		->with('changes', $chlog);
	}

	/*
		This function modifies the query a bit from the change_log page so that
		the user can specify a time intervall for the data displayed.
	*/

	public function getChlogSpecific()
	{
		$fraDato = str_replace("/","-", Input::get('fraDato'));
		$fraDato = date('Y-m-d', strtotime($fraDato));
		$tilDato = str_replace("/","-", Input::get('tilDato'));
		$tilDato = date('Y-m-d', strtotime($tilDato));

		$aktiv = 'minside';

		$chlog = ChangeLog::whereBetween('changed_at', array($fraDato, $tilDato))
		->orderBy('changed_at', 'DESC')->orderBy('time', 'DESC')->paginate(25);

		return View::make('change_log')
		->with('title', 'Endringslogg')
		->with('aktiv', $aktiv)
		->with('changes', $chlog);
	}
}