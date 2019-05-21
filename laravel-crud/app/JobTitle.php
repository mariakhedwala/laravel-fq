<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_title'
    ];

    /**
     * Property for retrieving  Job titles
     *
     * @return Object containing data of all users 
     */
    public function getJobs()
    {
        $getJobs = JobTitle::all()->sortByDesc('id');
        return $getJobs;
    }
}
