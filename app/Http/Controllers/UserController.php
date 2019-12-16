<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Redirect;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{

    public function displayServices()
    {
        $services = \App\Service::all();
        return view('akc', ['services' => $services]);
    }

    public function displaySearch(Request $request)
    {
        $services = \App\Service::all();
        return view('searchresult', ['services' => $services, 'distance' => $request->input('distance'), 'search' => $request->input('search'), 'lat' => $request->input('lat'), 'long' => $request->input('long')]);
    }

    public function displaySearchPost(Request $request)
    {
        $distance = $request->input('distance');
        $search = $request->input('search');
        $lat = $request->input('lat');
        $long = $request->input('long');
        $services = \App\Service::all();
        $filtered_services = [];

        for($i = 0; $i < sizeof($services); $i++) 
        {
            if(!empty($search) && strpos($services[$i]->title, $search) !== false) 
            {
                array_push($filtered_services, $services[$i]);
            }
        }

        if(empty($search))
        {
            $filtered_services = $services;
        }

        return response()->json(['search' => $search, 'services' => $filtered_services, 'distance' => $distance, 'lat' => $lat, 'long' => $long]);
    }

    function getDistanceBetweenPoints($lat1, $lon1, $lat2, $lon2) {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $kilometers = $miles * 1.609344;
        return $kilometers; 
    }
}