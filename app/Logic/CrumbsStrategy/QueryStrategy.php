<?php

namespace App\Logic\CrumbsStrategy;

use Illuminate\Http\Request;

class QueryStrategy implements IStrategyCrumbs
{
    public function returnParameter(Request $request)
    {
        $response = array();

        array_push($parametersArray,);

        if($request->query()->has('Departament'))
        {
            array_push($response,['Departament' => $request->query('Departament')]);
        }
        return $request->query($parameter);
    }
}
