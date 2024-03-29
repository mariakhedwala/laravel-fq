<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'city'
    ];

    /**
     * Property for retrieving  cities
     *
     * @return Object containing data of all cities 
     */
    public function getCities()
    {
        $getCities = City::all()->sortByDesc('id');
        return $getCities;
    }
}
