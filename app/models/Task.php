<?php

/*
	Creates a model that represents the tasks table.
	This model can be manipulated and the changes are reflected
	in the database.
*/

class Task extends Eloquent
{
	protected $table = 'tasks';
	protected $fillable = array('title');
	public static $rules = array(
		'C_Timeteller' => 'regex:/^\d{1,3},\d{2}$/'
	);

	public function routines() //Defines the relationship to the routines table/model.
	{
		return $this->belongsToMany('Routine', 'task_routine');
	}

	public static function validate($input, $message) //Validates based on rules.
	{
		return Validator::make($input, static::$rules, $message);
	}
}
