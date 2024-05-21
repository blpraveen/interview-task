<?php

namespace App\Http\Services;

use App\Models\WeatherForecast;
use Carbon\Carbon;

Class WeatherService {

    public function check_city_today_exists($city){
        $weather = WeatherForecast::whereRaw('LOWER(city) LIKE ? ','%'.strtolower($city).'%')->whereDate('updated_at', Carbon::today())->first();
        return $weather;
    }
    public function get_data_from_api($city)
    {
        $url = $_ENV['OPEN_WEATHER_MAP_URL']."?q=".$city."&units=metric&appid=".$_ENV['OPEN_WEATHER_MAP_KEY'];
        $ch = curl_init();
       
        try{
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
            $response = curl_exec($ch);
            curl_close($ch);
            $data = json_decode($response);
        } catch (\Exception $e) {
            \Log::error('Caught exception: '.  $e->getMessage());
            return false;
        }
        return $data;


        
    }

    public function insert_weather($insert_weather){
        return WeatherForecast::create($insert_weather);
    }
}