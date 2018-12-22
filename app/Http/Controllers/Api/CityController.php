<?php

namespace App\Http\Controllers\Api;

use App\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $city
     * @return \Illuminate\Http\Response
     */
    public function show($city)
    {
        $cities = City::select(['id', DB::raw('name as text')])->whereStateId($city)->get();
        return response()->json($cities);
    }
}
