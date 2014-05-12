<?php

/*
	Creates a model that represents the change_log table.
	This model can be manipulated and the changes are reflected
	in the database.
*/

class ChangeLog extends Eloquent
{
	protected $table = 'change_log';
	protected $fillable = array(
		'routine_id', 'title', 
		'value_old', 'value_new',
		'action', 'changed_at',
		'date', 'time',
		'changed_by');
	public $timestamps = false;
}