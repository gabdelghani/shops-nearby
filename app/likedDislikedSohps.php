<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class likedDislikedSohps extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'datetime',
    ];

}
