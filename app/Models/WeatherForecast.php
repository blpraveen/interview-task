<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherForecast extends Model
{
    use HasFactory;
    public $table = "weather";
    protected $fillable = [
        'city', 'desc', 'temp', 'feels_like','temp_min','temp_max','pressure','humidity','wind_speed'
    ];
}
