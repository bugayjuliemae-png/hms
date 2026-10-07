<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {
        $city = 'Manila';

        try {

            $response = Http::timeout(10)
                ->get('https://api.openweathermap.org/data/2.5/weather', [
                    'q' => $city,
                    'appid' => config('services.openweather.key'),
                    'units' => 'metric',
                ]);

            if ($response->failed()) {

                return view('weather.index', [
                    'weather' => null,
                    'error' => 'Weather service is currently unavailable.'
                ]);
            }

            $data = $response->json();

            if (
                !isset($data['name']) ||
                !isset($data['main']) ||
                !isset($data['weather'][0]) ||
                !isset($data['wind'])
            ) {

                return view('weather.index', [
                    'weather' => null,
                    'error' => 'Weather data is unavailable.'
                ]);
            }

            $weather = [

                'city' => $data['name'],

                'temperature' => $data['main']['temp'],

                'condition' => $data['weather'][0]['description'],

                'humidity' => $data['main']['humidity'],

                'wind_speed' => $data['wind']['speed'],

            ];

            return view('weather.index', [
                'weather' => $weather,
                'error' => null
            ]);

        } catch (\Throwable $e) {

            return view('weather.index', [
                'weather' => null,
                'error' => 'Unable to connect to the weather service.'
            ]);
        }
    }
}