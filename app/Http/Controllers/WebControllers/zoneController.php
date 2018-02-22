<?php

namespace App\Http\Controllers\WebControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Departament;
use App\Models\Zone;

class zoneController extends Controller
{
    protected $option;

      public function getZone(Request $request)
      {
          $departament = Departament::where('departamentName',$request->Departament)->first();

          $zone = Zone::where([
                        ['idDepartament','=',$departament->idDepartament],
                        ['nameZone','=',$request->Zone],
            ])->first();

          $elements = $this->showCrumb($request);

          $characteristics = $zone->Characteristics()->get();
          $municipalities = '';

          foreach ($zone->Municipalities()->get() as $currentMunicipality) {
              $municipalities .= $currentMunicipality->name.', '.$municipalities;
          }

          $municipalities = substr($municipalities,0,-2);

          $this->option = 0;

          return view('web.zone')
                      ->with('elements',$elements)
                      ->with('zone',$zone)
                      ->with('characteristics',$characteristics)
                      ->with('municipalities',$municipalities)
                      ->with('option', $this->option)
                      ->with('departamentName', $departament->departamentName);
      }

      public function getClimaticElements(Request $request, $id)
      {
          $zone = Zone::find($id);
          $characteristics = $zone->Characteristics()->get();
          $municipalities = '';

          foreach ($zone->Municipalities()->get() as $currentMunicipality) {
              $municipalities .= $currentMunicipality->name.', '.$municipalities;
          }

          $municipalities = substr($municipalities,0,-2);

          if($request->ajax())
          {
              $view = view('web.partials.zone.characteristicsZone')
                        ->with('zone',$zone)
                        ->with('characteristics',$characteristics)
                        ->with('municipalities',$municipalities);
              $newView = $view->render();
              return response()->json(['html'=>$newView]);
            // return response()->json(["mensaje"=>"hola"]);
          }
      }

      public function getSocioeconomicCharacteristics(Request $request, $id)
      {

          $zone = Zone::find($id);
          $indicators = $zone->Indicators()->get();

          if($request->ajax())
          {
              $view = view('web.partials.zone.socioEconomicStudy')
                          ->with('zone',$zone)
                          ->with('indicators',$indicators);
              $newView = $view->render();
              return response()->json(['html'=>$newView]);
            // return response()->json(["mensaje"=>"hola"]);
          }
      }

      public function getPrevZone($name)
      {

          $zone = Zone::where('nameZone',$name)->first();
          $departament = $zone->Departament()->first();

          $requestCrumb = Request::create(
                  '/zone/prevZone/', 'GET', array(
                      'Departament' => $departament->departamentName,
                      'Zone' => $zone->nameZone
                  ));

          $elements = $this->showCrumb($requestCrumb);

          $characteristics = $zone->Characteristics()->get();
          $municipalities = '';

          foreach ($zone->Municipalities()->get() as $currentMunicipality) {
              $municipalities .= $currentMunicipality->name.', '.$municipalities;
          }

          $municipalities = substr($municipalities,0,-2);
          $this->option = 0;

          return view('web.zone')
                      ->with('elements',$elements)
                      ->with('zone',$zone)
                      ->with('characteristics',$characteristics)
                      ->with('municipalities',$municipalities)
                      ->with('option', $this->option)
                      ->with('departamentName', $departament->departamentName);
      }
}
