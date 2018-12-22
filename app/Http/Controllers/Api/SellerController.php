<?php

namespace App\Http\Controllers\Api;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = Seller::select(['id', DB::raw('name as text')])->get();
        return response()->json($sellers);
    }
}
