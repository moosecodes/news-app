<?php

namespace App\Http\Controllers;

use App\Models\WeatherReading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($zip)
    {
        $response = Http::get(env('WEATHER_API_URL'), [
            'key' => env('WEATHER_API_KEY'),
            'q' => $zip
        ]);
        $reading = $response->json();

        $weatherReading = new WeatherReading;

        $weatherReading->temp_f = $reading['current']['temp_f'];
        $weatherReading->temp_c = $reading['current']['temp_c'];
        $weatherReading->city = $reading['location']['name'];
        $weatherReading->region = $reading['location']['region'];
        $weatherReading->save();

        return $weatherReading->orderBy('id', 'DESC')->first();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(WeatherReading $weatherReading)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WeatherReading $weatherReading)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WeatherReading $weatherReading)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WeatherReading $weatherReading)
    {
        //
    }
}
