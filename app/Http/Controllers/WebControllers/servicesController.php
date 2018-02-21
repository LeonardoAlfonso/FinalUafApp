<?php

namespace App\Http\Controllers\WebControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Departament;
use App\Models\Zone;
use Response;

class servicesController extends Controller
{
    public function getServices()
    {
        $option = 0;
        $departaments = Departament::all();
        $zones = collect(new Zone);
        return view('web.services')
                    ->with('option',$option)
                    ->with('departaments',$departaments)
                    ->with('zones',$zones);
    }

    public function getPrevServices($name)
    {
        $option = 1;
        $departaments = Departament::whereNotIn('departamentName',[$name])->get();
        $zones = Departament::where('departamentName', $name)->first()->zones()->get();
        return view('web.services')
                    ->with('option',$option)
                    ->with('prevDepartament',$name)
                    ->with('departaments',$departaments)
                    ->with('zones',$zones);
    }

    public function getZones(Request $request, $name)
    {
        $departament = Departament::where('departamentName', $name)->first();
        $zones = $departament->zones()->get();

        //Ajax Handler
        if($request->ajax())
        {
            $view = view('web.partials.services.zonesList')->with('zones',$zones);
            // return response()->json(["mensaje"=>"Hola"]);
            $newZones = $view->render();
            return response()->json(['html'=>$newZones]);
        }
      }
}
