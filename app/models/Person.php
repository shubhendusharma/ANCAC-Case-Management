<?php

class Person extends \Eloquent {
	protected $fillable = [];
	protected $table = 'persons';
        
        public  function getNameAttribute ()
        {
            return "$this->first $this->middle $this->last";
        }

        public function country() {
            return $this->belongsTo('CountryOrigin','originCountry');
        }
        
        public function relation() {
            return $this->hasMany('Relationship');
        }
        
        public function ethnicity() {
            return $this->belongsTo('Ethnicity');
        }
        
        public function address() {
            return $this->belongsTo('Address', 'address_id');
        }
        
        public function household() {
            return $this->belongsTo('Household');
        }
        
                 
}