<?php

namespace App\Http\Controllers\Api;

use App\Client;

use App\Http\Requests\Visit\StoreRequest;
use App\Http\Requests\Visit\UpdateRequest;
use App\Visit;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VisitController extends Controller
{

    public function __construct()
    {
        $this->model = Visit::class;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        DB::beginTransaction();

        try{
            $visit = $this->createAndGet($request->all());
            if($visit->client->balance_quota < $visit->value_visit){
                throw new \Exception('No tiene cupo disponible para esta visita');
            } else {
                $visit->client->balance_quota -= $visit->value_visit;
                $visit->client->save();
            }
            DB::commit();
            return response()->json($visit);
        } catch (\Exception $e) {
            DB::rollback();
            DB::commit();
            return response()->json(['errors'=>[$e->getMessage()]]);
        }

    }

    /**
     * Display the specified resource one client.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $visits =  Client::whereClientId($id)->get();
        return response()->json($visits);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Visit $visit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Visit $visit)
    {
        $difference = $visit->value_visit - $request->get('value_visit');
        $visit->update($request->all());

        DB::beginTransaction();

        try{
            if($visit->client->balance_quota < $difference){
                throw new \Exception('No tiene cupo disponible para hacer este cambio');
            } else {
                $visit->client->balance_quota += $difference;
                $visit->client->save();
            }
            DB::commit();
            return response()->json($visit);
        } catch (\Exception $e) {
            DB::rollback();
            DB::commit();
            return response()->json(['errors'=>[$e->getMessage()]]);
        }

        return response()->json($visit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Visit $visit
     * @return void
     * @throws \Exception
     */
    public function destroy(Visit $visit)
    {
        $visit->client->balance_quota += $visit->value_visit;
        $visit->client->save();
        $visit->delete();
    }
}
