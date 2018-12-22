<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * Method for generate one new model and get with relations
     * @param $data
     * @param $model
     * @return mixed
     */
    public function createAndGet($data, $model)
    {
        $obj = new $model($data);
        $obj->save();
        $obj = $model::find($obj->id);
        return $obj;
    }
}
