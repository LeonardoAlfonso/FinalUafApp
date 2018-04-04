<?php

namespace App\Http\Controllers\AppControllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Logic\CreateSystem\SystemTools;
use App\Models\Departament;
use App\Models\Virtuals\CostVirtual;
use App\Models\UafParameter;
use App\Models\Zone;
use App\Models\Cost;
use App\Models\Entry;
use App\Models\System;
use App\SystemIndicator;
use App\User;


class systemController extends Controller
{
    public function expertPanel(Request $request)
    {
        $systemTools = new SystemTools();
        $systemTools->forgetSession($request);
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
        $systemTools = new SystemTools();
        $systemTools->forgetSession($request);
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
        $systemTools = new SystemTools();
        $systemTools->forgetSession($request);
        $idDepartament = Departament::where('departamentName', $request->Departament)->first()->idDepartament;
        $idUser = Auth::user()->idUser;
        $departaments = User::find($idUser)->departaments;
        $zones = Zone::where('idDepartament', $idDepartament)->get();
        $selectZone = Zone::where('idDepartament', $idDepartament)->where('nameZone', $request->Zone)->first();
        $systems = $selectZone->Systems()->get();
        $option = 'List';

        return view('app.expert')
                  ->with('departaments', $departaments)
                  ->with('option', $option)
                  ->with('zones', $zones)
                  ->with('systems', $systems)
                  ->with('selectZone', $selectZone->idZone);
    }

    public function getSystem(Request $request, $idZone, $idSystem = NULL)
    {
        $zone = Zone::find($idZone);
        $system = is_null($idSystem) ? new System(): System::find($idSystem);

        $systemTools = new SystemTools();
        $optionsGroup = $systemTools->getGroup();
        $systemTools->createUpdateIndicator($request);
        $indicators = $request->session()->get('indicators');

          $option = 'configSystem';
          $listCost = new CostVirtual();
          return view('app.expert')
                  ->with('option', $option)
                  ->with('listCost', $listCost)
                  ->with('optionsGroup',$optionsGroup)
                  ->with('system', $system)
                  ->with('zone', $zone)
                  ->with('indicators',$indicators);
    }

    public function getSubGroup(Request $request, $group)
    {
        $systemTools = new SystemTools();
        $optionsSubGroup = $systemTools->getSubGroup($group);

        if($request->ajax())
        {
            $view = view('app.partials.expert.modals.subGroupsCost')
                        ->with('optionsSubGroup', $optionsSubGroup);
            $newview = $view->render();
            return response()->json(["html" => $newview]);
        }
    }

    public function storageCost(Request $request)
    {
        $systemTools = new SystemTools();
        $table = $systemTools->showCosts($request);

      if($request->ajax())
      {
            $view = view('app.partials.expert.tableCosts')
                        ->with('listCost', $table);
            $newView = $view->render();
            return response()->json(["html"=>$newView]);
      }
    }

    // public function deleteCost($id)
    public function deleteCost(Request $request, $idCost)
    {
        $costs = $request->session()->get('costs');
        
        $costs->each(function($item, $key) use($idCost, $costs) {
            if($item->id == $idCost)
            {
                $costs->pull($key);
                return false;
            }
        });

        if($request->ajax())
        {
              $view = view('app.partials.expert.tableCosts')
                          ->with('listCost', $costs);
              $newView = $view->render();
              return response()->json(["html"=>$newView]);
        }
    }

    public function storageEntry(Request $request)
    {
        $systemTools = new SystemTools();
        $table = $systemTools->showEntries($request);

        if($request->ajax())
        {
            $view = view('app.partials.expert.tableEntries')
                        ->with('listEntries', $table);
            $newView = $view->render();
                return response()->json(["html"=>$newView]);
        }
    }

    public function deleteEntry(Request $request, $idEntry)
    {

        $entries = $request->session()->get('entries');
        
        $entries->each(function($item, $key) use($idEntry, $entries) {
            if($item->id == $idEntry)
            {
                $entries->pull($key);
                return false;
            }
        });

        if($request->ajax())
        {
            $view = view('app.partials.expert.tableEntries')
                        ->with('listEntries', $entries);
            $newView = $view->render();
                return response()->json(["html"=>$newView]);
        }
    }

    public function calculateIndicators(Request $request)
    {
        $request->session()->forget('realCosts');
        $request->session()->forget('realEntries');
        $request->session()->forget('utilities');

        $systemTools = new SystemTools();

        // $systemTools->createIndicator($request, , );

        $systemTools->reconstructItems($request);
        $systemTools->calculateSalaries($request);
        $systemTools->calculateUtilities($request);
        // dd($systemTools->calculateTIR($request));
        $systemTools->createUpdateIndicator($request, "VPN", $systemTools->calculateVPN($request));
        $systemTools->createUpdateIndicator($request, "TIR", $systemTools->calculateTIR($request));
        $systemTools->calculateIPA($request);
        $systemTools->calculateUNPA($request);
        $systemTools->createUpdateIndicator($request, "UAFM", 
                        $systemTools->calculateIPA($request)/$systemTools->calculateUNPA($request));

        $indicators = $request->session()->get('indicators');

        if($request->ajax())
        {
            $view = view('app.partials.expert.systemIndicators')
                        ->with('indicators',$indicators);
            $newView = $view->render();

            return response()->json(["html"=>$newView]);
        }
    }
    



    public function saveSystem(Request $request)
    {
        dd($request);
    }
}
