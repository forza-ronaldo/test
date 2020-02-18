<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class place extends Model
{
    protected $fillable = ['name', 'location', 'lat_lag', 'center_type'];
    public $timestamps = false;
}
