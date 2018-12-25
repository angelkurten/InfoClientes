<?php

namespace App\Http\Controllers\Api;

use App\Client;
use App\Http\Requests\Clients\StoreRequest;
use App\Http\Requests\Clients\UpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientsController extends Controller
{

    public function __construct()
    {
        $this->model = Client::class;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::with('city')->get();
        return response()->json($clients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {

        $client =  $this->createAndGet($request->all());
        return response()->json($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $client = Client::find($id);
        $client->update($request->all());

        return response()->json($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();

        return response()->json(true);
    }
}
