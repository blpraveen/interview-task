<?php

namespace App\Http\Controllers;

use App\Http\Services\WeatherService;
use App\Models\WeatherForecast;
use Carbon\Carbon;
use Illuminate\Http\Request;

Class WeatherController extends Controller {
    public $weather_service;
    public function __construct(WeatherService $service)
    {
        $this->weather_service = $service;
    }
    public function index(){
        return view('weather.page');
    }
    public function get_weather(Request $request){
        
        $weather = $this->weather_service->check_city_today_exists($request->city);
        if($weather){
            return response()->json([
                'status' => 'success',
                'weather' => $weather
            ]);
        } else {
            $weather_data = $this->weather_service->get_data_from_api($request->city);
            if( empty($weather_data->main) ){
                \Log::error('City '.$request->city.' Temparature Not Found');
            } else {
                $insert_weather = [];
                $insert_weather['city'] = $request->city;
                $insert_weather['temp'] = $weather_data->main->temp;
                $insert_weather['desc'] = $weather_data->weather[0]->description;
                $insert_weather['feels_like'] = $weather_data->main->feels_like;
                $insert_weather['temp_min'] = $weather_data->main->temp_min;
                $insert_weather['temp_max'] = $weather_data->main->temp_max;
                $insert_weather['pressure'] = $weather_data->main->pressure;
                $insert_weather['humidity'] = $weather_data->main->humidity;
                $insert_weather['wind_speed'] = $weather_data->wind->speed;
                $insert_weather['updated_at'] = Carbon::now();
                $insert_weather['created_at'] = Carbon::now();
                $weather = $this->weather_service->insert_weather($insert_weather);
                return response()->json([
                    'status' => 'success',
                    'weather' => $weather
                ]);
            }
        }

        return response()->json([
            'status' => 'error'
        ]);
    }

    
}