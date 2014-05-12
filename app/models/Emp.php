<?php

/*
	Creates a model that represents the emps table.
	This model can be manipulated and the changes are reflected
	in the database.
*/

class Emp extends Eloquent
{
	protected $table = 'emps';
	protected $fillable = array(
		'user_name', 'first_name', 
		'last_name', 'email',
		'password', 'user_type');
	public $timestamps = true;

	//Validation rules for creating a user

	public static $rules = array(
	'first_name' => 'required|min:2|max:15',
	'last_name' => 'required|min:2|max:15',
	'email' => 'required|email|unique:emps',
	'password' => 'required|min:5|alphanum|confirmed',
	'password_confirmation' => 'required|alphanum',
	'user_type' => array('regex:/^user$|^admin$/', 'required')
	);
	
	//Valdiation rules for updating a user.

	public static $updateRules = array(
	'first_name' => 'required|min:2|max:15',
	'last_name' => 'required|min:2|max:15',
	'email' => 'required|email',
	'password' => 'min:5|alphanum',
	'user_type' => array('regex:/^user$|^admin$/', 'required')
	);

	public function routines() //Defines the DB relationship to the routines table/model
	{
		return $this->hasMany('Routine', 'emp_id', 'id');
	}

	public static function validate($input, $message) //Validates based on rules.
	{
		return Validator::make($input, static::$rules, $message);
	}
	
	public static function validateUpdate($input, $message) //Validates based on rules.
	{
		return Validator::make($input, static::$updateRules, $message);
	}

	protected function getDateFormat() //Defines the datetime format as saved in the DB.
    {
        return 'Y-m-d H:i:s';
    }
}