<?php

namespace App;

trait GetCountries {

	public function Countries () {

		$countries = Country::orderBy('name')
			->lists('name','id')->toArray();
        
        return $countries;
	}
}