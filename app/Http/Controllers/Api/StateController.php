<?php

namespace App\Http\Controllers\Api;

use App\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $country
     * @return \Illuminate\Http\Response
     */
    public function show($country)
    {
        $states = State::select(['id', DB::raw('name as text')])->whereCountryId($country)->get();
        return response()->json($states);
    }


}
