<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country'
    ];

    /**
     * Property for retrieving countries
     * 
     * @return Object containing data of all countries 
     */
    public function getCountries()
    {
        $getCountries = Country::all()->sortByDesc('id');
        return $getCountries;
    }
}
