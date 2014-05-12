<?php

/*
	Creates a model that represents the measurements table.
	This model can be manipulated and the changes are reflected
	in the database.
*/

class Measurement extends Eloquent
{
	protected $table = 'measurements';
	protected $fillable = array('title');

	//The rules for validating the data that goes into this table.

	public static $rules = array(
	//Times målinger
	'T_Badende_per_Time' => 'integer',
	'T_Temperatur' => 'regex:/^\d{1,3},\d{2}$/',
	'T_Luft_Temperatur' => 'regex:/^\d{1,3},\d{2}$/',
	// Trejde times målinger
	'M_Fritt_Klor' => 'regex:/^\d{1,3},\d{2}$/',
	'M_Bundet_Klor' => 'regex:/^\d{1,3},\d{2}$/',
	'M_Total_Klor' => 'regex:/^\d{1,3},\d{2}$/',
	'M_PH' => 'regex:/^\d{1,3},\d{2}$/',
	'M_Auto_Klor' => 'regex:/^\d{1,3},\d{2}$/',
	'M_Auto_PH' => 'regex:/^\d{1,3},\d{2}$/',
	'M_Redox' => 'integer',
	//Oppgaver
	'O_Vannbalanse' => 'regex:/^\d{1,3},\d{2}$/',
	'O_Alakalitet' => 'regex:/^\d{1,3},\d{2}$/',
	'O_Hardhet' => 'regex:/^\d{1,3},\d{2}$/',
	'O_Natrium_Bk' => 'integer',
	'O_Sjokklor' => 'integer',	
	'O_Sirkulasjonsmengde' => 'regex:/^\d{1,3},\d{2}$/',
	'O_Filtertrykk' => 'regex:/^\d{1,3},\d{2}$/',
	'O_Vannforbruk' => 'regex:/^\d{1,3},\d{2}$/',
	'O_Kals_Klor[1]'  => 'regex:/^\d{1,3},\d{2}$/'
	);

	public function routines() //Defines the relationship to the routines table/model.
	{
		return $this->belongsToMany('Routine', 'measure_routine')->withPivot('pool_id')->withPivot('name');
	}

	public function measure_routine() //Defines the relationship to the measure_routine table/model.
	{
		return $this->belongsTo('Measure_routine');
	}

	public static function validate($input, $message) //Validates based on rules.
	{
		return Validator::make($input, static::$rules, $message);
	}
	
}