<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corona extends Model
{
    public $fillable = [
        'country', 'county', 'pop_density', 'growth_rate', 'period', 'cases_day1', 'cases_day10',
    ];
}
