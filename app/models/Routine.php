<?php

/*
	Creates a model that represents the routines table.
	This model can be manipulated and the changes are reflected
	in the database.
*/

class Routine extends Eloquent
{
	protected $table = 'routines';
	protected $fillable = array('date', 'time', 'value', 'emp_id');
	public $timestamps = false;

	public function emps() //Defines the relationship to the emps table/model.
	{
		return $this->belongsTo('Emp', 'emp_id', 'id');
	}

	public function tasks() //Defines the relationship to the tasks table/model.
	{
		return $this->belongsToMany('Task', 'task_routine', 'routine_id', 'task_id');
	}

	public function measurements() //Defines the relationship to the measurements table/model.
	{
		return $this->belongsToMany('Measurement', 'measure_routine', 'routine_id', 'measure_id')->withPivot('pool_id');
	}

	public function measure_routine() //Defines the relationship to the measure_routine table/model.
	{
		return $this->belongsTo('Measure_routine');
	}
}