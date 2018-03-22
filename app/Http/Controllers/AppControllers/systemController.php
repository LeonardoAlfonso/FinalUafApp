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

        return view('app.expert')
                  ->with('departaments', $departaments)
                  ->with('option', $option)
                  ->with('zones', $zones)
                  ->with('systems', $systems)
                  ->with('selectZone', $selectZone->idZone);
    }

    public function getSystem($idZone)
    {
        $systemTools = new SystemTools();
        $tokenSystem = str_random(10);
        $optionsGroup = $systemTools->getGroup();
          // dd($idZone);
          $option = 'configSystem';
          $listCost = new CostVirtual();
          return view('app.expert')
                  ->with('option', $option)
                  ->with('tokenSystem', $tokenSystem)
                  ->with('listCost', $listCost)
                  ->with('optionsGroup',$optionsGroup);
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

    public function saveSystem(Request $request)
    {
        dd($request);
    }

    public function storageCost(Request $request)
    {
        $systemTools = new SystemTools();
        $systemTools->saveCost($request);
        $table = $systemTools->showCosts($request->input('tokenSystem'));

      if($request->ajax())
      {
            $view = view('app.partials.expert.tableCosts')
                        ->with('listCost', $table);
            $newView = $view->render();
            return response()->json(["html"=>$newView]);
      }
    }

    // public function deleteCost($id)
    public function deleteCost(Request $request, $id)
    {
        $systemTools = new SystemTools();
        $cost = Cost::find($id);
        $token = $cost->rememberToken;
        $detail = $cost->detail;
        $cost = Cost::where('detail', $detail)->where('rememberToken', $token)->get();

        foreach($cost as $deleteCost)
        {
            $deleteCost->delete();
        }

        $table = $systemTools->showCosts($token);

        if($request->ajax())
        {
              $view = view('app.partials.expert.tableCosts')
                          ->with('listCost', $table);
              $newView = $view->render();
              return response()->json(["html"=>$newView]);
        }
    }

    public function storageEntry(Request $request)
    {
        $systemTools = new SystemTools();
        $systemTools->saveEntry($request);
        // $table = $systemTools->showEntries("gwpzcO54wN");
        
        $table = $systemTools->showEntries($request->input('tokenSystem'));

      if($request->ajax())
      {
            $view = view('app.partials.expert.tableEntries')
                        ->with('listEntries', $table);
            $newView = $view->render();
            return response()->json(["html"=>$newView ]);
      }
    }

    public function deleteEntry(Request $request, $id)
    {
        $systemTools = new SystemTools();
        $entry = Entry::find($id);
        $token = $entry->rememberToken;
        $name = $entry->name;
        $entry = Entry::where('name', $name)->where('rememberToken', $token)->get();

        foreach($entry as $deleteEntry)
        {
            $deleteEntry->delete();
        }

        $table = $systemTools->showEntries($token);

        if($request->ajax())
        {
            $view = view('app.partials.expert.tableEntries')
                        ->with('listEntries', $table);
            $newView = $view->render();
            return response()->json(["html"=>$newView ]);
        }
    }
}
