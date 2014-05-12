<?php

/*
	Creates a model that represents the pools table.
	This model can be manipulated and the changes are reflected
	in the database.
*/

class Pool extends Eloquent
{
	protected $table = 'pools';
	protected $fillable = array('name');

	public function measure_routine() //Defines the relationship to the measure_routine table/model.
	{
		return $this->hasMany('Measure_routine', 'pool_id');
	}
}