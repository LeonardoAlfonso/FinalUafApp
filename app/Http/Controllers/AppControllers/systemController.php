<?php

namespace App\Http\Controllers\AppControllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Logic\CreateSystem\SystemTools;
use App\Http\Controllers\AppControllers\systemController;
use App\Models\Departament;
use App\Models\Virtuals\CostVirtual;
use App\Models\Virtuals\EntryVirtual;
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
        // $departaments = $departaments->orderBy('departamentName');
        $zones = collect([]);
        $option = '';
        $idZone = $request->has('idZone') ? $request->idZone: Null;
        $selectZone = is_null($idZone) ? new Zone(): Zone::with('Departament')->where('idZone',$idZone)->first(); 
        $selectDepartament = empty($selectZone) ? new Departament(): $selectZone->Departament; 

        return view('app.expert')
                  ->with('departaments', $departaments)
                  ->with('zones', $zones)
                  ->with('option', $option)
                  ->with('selectZone', $selectZone)
                  ->with('selectDepartament', $selectDepartament);
    }

    public function getZonesList(Request $request, $nameDepartament)
    {
        $systemTools = new SystemTools();
        $systemTools->forgetSession($request);
        $departament = Departament::where('departamentName', $nameDepartament)->first();
        $zones = $departament->zones()->get();
        $selectZone = new Zone();
        $systems = collect([]);

        //Ajax Handler
        if($request->ajax())
        {
            $list = view('app.partials.expert.optionsZones')
                    ->with('zones',$zones)
                    ->with('selectZone', $selectZone);
            $table = view('app.partials.expert.tableListSystems')
                    ->with('option',"")
                    ->with('zones',$zones)
                    ->with('systems', $systems);

            $newList = $list->render();
            $newTable = $table->render();
            return response()->json(['list'=>$newList, 'table'=>$newTable ]);
        }
    }

    public function getSystemList(Request $request)
    {
        $systemTools = new SystemTools();
        $idZone = Zone::where('nameZone', $request->Zone)->first()->idZone;

        return $systemTools->getSystemList($request, $idZone);
    }

    public function getSystem(Request $request, $idZone, $idSystem = NULL)
    {
        $zone = Zone::find($idZone);
        $system = is_null($idSystem) ? new System(): System::find($idSystem);
            $system->autor = Auth::user()->full_name;

        $systemTools = new SystemTools();
        $optionsGroup = $systemTools->getGroup();
        $optionsSubGroup = collect([]);
        $systemTools->createUpdateIndicator($request);
        $indicators = is_null($idSystem) ? $request->session()->get('indicators') 
                                         : $systemTools->loadIndicators($request, $system);
                                        
        if(!is_null($idSystem))
        {
            $systemTools->loadUtilities($request, $system);
            $systemTools->loadFlowCash($request, $system);
        }

        $option = 'configSystem';
        $loadScript = false;
        $modalCost = new CostVirtual();
        $modalEntry = new EntryVirtual();

        $listCosts = is_null($idSystem) ? collect([]) : $systemTools->loadCost($request, $system);
        $listEntries = is_null($idSystem) ? collect([]) : $systemTools->loadEntry($request, $system);

          return view('app.expert')
                  ->with('option', $option)
                  ->with('optionsGroup',$optionsGroup)
                  ->with('optionsSubGroup', $optionsSubGroup)
                  ->with('loadScript', $loadScript)
                  ->with('system', $system)
                  ->with('zone', $zone)
                  ->with('indicators',$indicators)
                  ->with('modalCost', $modalCost)
                  ->with('modalEntry',$modalEntry)
                  ->with('listCosts',$listCosts)
                  ->with('listEntries',$listEntries);
    }

    public function getSubGroup(Request $request, $group)
    {
        $systemTools = new SystemTools();
        $optionsSubGroup = $systemTools->getSubGroup($group);
        $modalCost = new CostVirtual();

        if($request->ajax())
        {
            $view = view('app.partials.expert.modals.subGroupsCost')
                        ->with('modalCost', $modalCost)
                        ->with('optionsSubGroup', $optionsSubGroup);
            $newview = $view->render();
            return response()->json(["html" => $newview]);
        }
    }

    public function storageCost(Request $request)
    {
        $request->session()->forget('utilities');
        $request->session()->forget('indicators');
        $request->session()->forget('flowCash');
        $systemTools = new SystemTools();

        $table = $systemTools->showCosts($request);
        $modal = $table->get('modal');
        $tableView = $table->get('table');

      if($request->ajax())
      {
            return response()->json(["modal"=>$modal, "table" => $tableView,  
                                     "validation"=>$table->get('validation')]);
      }
    }

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
                          ->with('listCosts', $costs);
              $newView = $view->render();
              return response()->json(["html"=>$newView]);
        }
    }

    public function storageEntry(Request $request)
    {
        $request->session()->forget('utilities');
        $request->session()->forget('indicators');
        $request->session()->forget('flowCash');

        $systemTools = new SystemTools();
        $table = $systemTools->showEntries($request);
        $modal = $table->get('modal');
        $tableView = $table->get('table');

        if($request->ajax())
        {
            // return response()->json(["modal"=>$table]);
            return response()->json(["modal"=>$modal, "table" => $tableView,  
                                     "validation"=>$table->get('validation')]);
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
        $systemTools->createUpdateIndicator($request, "VPN", $systemTools->calculateVPN($request));
        $systemTools->createUpdateIndicator($request, "TIR", $systemTools->calculateTIR($request));
        $systemTools->calculateIPA($request);
        $systemTools->calculateUNPA($request);
        $systemTools->createUpdateIndicator($request, "UAFM", 
                        $systemTools->calculateIPA($request)/$systemTools->calculateUNPA($request));
        $systemTools->createUpdateIndicator($request, "UAFX", 
                        $systemTools->calculateIPA($request)/$systemTools->calculateUNPAMax($request));
                        
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
        $systemTools = new SystemTools();
        $system = is_null($request->idSystem) ? new System(): System::find($request->idSystem); 
            $system->nameSystem = $request->nameSystem;
            $system->autor = $request->authorSystem;
            $system->jornalValue = $request->jornalSystem;
            $system->idZone = $request->idZone;
    
        $system->save();

        //Save Costs
        $system->deleteCosts();
        $costs = $request->session()->get('realCosts');
        $costs->each(function($item, $key) use($system){
            $item->idSystem = $system->idSystem;
            $item->save();
        });

        //Save Entries
        $system->deleteEntries();
        $entries = $request->session()->get('realEntries');
        $entries->each(function($item, $key) use($system){
            $item->idSystem = $system->idSystem;
            $item->save();
        });

        //Save Utilities
        $system->deleteUtilities();
        $utilities = $request->session()->get('utilities');
        $utilities->each(function($item, $key) use($system){
            $item->idSystem = $system->idSystem;
            $item->save();
        });

        //Save FlowCash
        $system->deleteFlowCash();
        $flowCash = $request->session()->get('flowCash');
        $flowCash->each(function($item, $key) use($system){
            $item->idSystem = $system->idSystem;
            $item->save();
        });

        //Save Indicators
        $indicators = $request->session()->get('indicators');
        $indicators->each(function($item, $key) use($system){
            $item->idSystem = $system->idSystem;
            $item->save();
        });

        return $systemTools->getSystemList($request, $system->idZone);
    }

    public function deleteSystem(Request $request, $idSystem)
    {
        $systemTools = new SystemTools();
        $system = System::find($idSystem);
        $idZone = $system->idZone;
        $system->delete();
        
        return $systemTools->getSystemList($request, $idZone);
    }

    public function validateIfIndicators(Request $request)
    {
        $systemTools = new SystemTools();
        $response = $systemTools->validationSaveSystem($request);
        $formValidation = $response->get('formValidation');
        $calculateValidation = $response->get('calculateValidation');
        $view = $response->get('view');

        if($request->ajax())
        {
            return response()->json(["formValidation" => $formValidation, 
                                    "calculateValidation" => $calculateValidation, 
                                    "view" => $view]);
        }
    }

    public function validateCalculate(Request $request)
    {
        $systemTools = new SystemTools();
        $response = $systemTools->validationCalculateData($request);

        if($request->ajax())
        {
            return response()->json(["validation" => $response]);
        }   
    }

    public function editCost(Request $request, $idCost)
    {
        $systemTools = new SystemTools();
        $modal = $systemTools->editCost($request, $idCost);

        if($request->ajax())
        {
              return response()->json(["modal"=>$modal]);
        }
    }

    public function editEntry(Request $request, $idEntry)
    {
        $systemTools = new SystemTools();
        $modal = $systemTools->editEntry($request, $idEntry);

        if($request->ajax())
        {
              return response()->json(["modal"=>$modal]);
        }
    }
    


    public function getTest(Request $request)
    {
        $entries = $request->session()->get('entries');

        $systemTools = new SystemTools();

        $newEntry = new EntryVirtual();
            $newEntry->id = 1;
            $newEntry->name = "pruebaManual";
            $newEntry->unitaryPrice = 52;
            $newEntry->measureUnity = "Kg";
            $newEntry->priceSource = "yoina";
            $newEntry->datePriceSource = "ayer";

            $newEntry->quantity1 = 1;
            $newEntry->quantity2 = 1;
            $newEntry->quantity3 = 1;
            $newEntry->quantity4 = 1;
            $newEntry->quantity5 = 1;
            $newEntry->quantity6 = 1;
            $newEntry->quantity7 = 1;
            $newEntry->quantity8 = 1;
            $newEntry->quantity9 = 1;
            $newEntry->quantity10 = 1;
            $newEntry->quantity11 = 1;
            $newEntry->quantity12 = 1;

            $validations = $systemTools->validateEntry($newEntry);

            $entries->push($newEntry);

            $tableView = view('app.partials.expert.tableEntries')
                                ->with('listEntries', $entries);

            $tableEntriesView = $tableView->render();

            dd($tableEntriesView);
                        
    }
}
