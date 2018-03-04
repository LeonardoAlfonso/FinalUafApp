<?php

namespace App\Http\Controllers\AppControllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Departament;
use App\Models\Zone;
use App\User;

class systemController extends Controller
{
    public function expertPanel()
    {

        $idUser = Auth::user()->idUser;
        $departaments = User::find($idUser)->departaments;
        $departaments = $departaments->sortBy('departamentName');
        $option = '';
        $selectZone = 'null';

        return view('app.expert')
                  ->with('departaments', $departaments)
                  ->with('option', $option)
                  ->with('selectZone', $selectZone);
    }

    public function getZonesList(Request $request, $nameDepartament)
    {
        $departament = Departament::where('departamentName', $nameDepartament)->first();
        $zones = $departament->zones()->get();

        //Ajax Handler
        if($request->ajax())
        {
            $view = view('app.partials.expert.optionsZones')->with('zones',$zones);
            // return response()->json(["mensaje"=>"Hola"]);
            $newZones = $view->render();
            return response()->json(['html'=>$newZones]);
        }
    }

    public function getSystemList(Request $request)
    {
        $idDepartament = Departament::where('departamentName', $request->Departament)->first()->idDepartament;
        $idUser = Auth::user()->idUser;
        $departaments = User::find($idUser)->departaments;
        $zones = Zone::where('idDepartament', $idDepartament)->get();
        $selectZone = Zone::where('idDepartament', $idDepartament)->where('nameZone', $request->Zone)->first();
        $systems = $selectZone->Systems()->get();
        $option = 'List';
        $selectZone = Zone::where('idDepartament', $idDepartament)->get();

        return view('app.expert')
                  ->with('departaments', $departaments)
                  ->with('option', $option)
                  ->with('zones', $zones)
                  ->with('systems', $systems)
                  ->with('selectZone', $selectZone->idZone);
    }

    public function getSystem()
    {
          $option = 'configSystem';
          return view('app.expert')
                  ->with('option', $option);
    }
}
