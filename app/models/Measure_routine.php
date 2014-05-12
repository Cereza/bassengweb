<?php

/*
	Creates a model that represents the measure_routine pivot table.
	This model can be manipulated and the changes are reflected
	in the database.
*/

class Measure_routine extends Eloquent
{
	protected $table = 'measure_routine';
	protected $fillable = 'routine_id', 'measure_id', 'pool_id';

	public function pools() //Defines the relationship to the pools table/model.
	{
		return $this->hasMany('Pool');
	}

	public function routines() //Defines the relationship to the routines table/model.
	{
		return $this->hasMany('Routine');
	}

	public function measurements() //Defines the relationship to the measurements table/model.
	{
		return $this->hasMany('Measurement');
	}
}