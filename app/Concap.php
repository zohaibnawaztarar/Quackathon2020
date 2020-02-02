<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concap extends Model
{
    public $fillable = [
        'CountryName', 'CountyCode', 'CapitalLatitude', 'CapitalLongitude',
    ];
}
