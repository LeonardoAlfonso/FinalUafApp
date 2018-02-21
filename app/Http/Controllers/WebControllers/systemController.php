<?php

namespace App\Http\Controllers\WebControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Zone;
use App\Models\System;

class systemController extends Controller
{
      public function getListSystem($idZone)
      {
          $zone = Zone::find($idZone);

          $systems = $zone->Systems()->get();
          $first = $zone->Systems()->first();

          $departament = $zone->Departament()->first();

          $requestCrumb = Request::create(
                  '', 'GET', array(
                      'Departament' => $departament->departamentName,
                      'Zone' => $zone->nameZone,
                      'ListSystem' => $zone->idZone
                  ));

          $elements = $this->showCrumb($requestCrumb);

          return view('web.listProductiveSystems')
                      ->with('elements',$elements)
                      ->with('first',$first)
                      ->with('systems',$systems);
      }

      public function changeSystem(Request $request, $idSystem)
      {
          $first = System::find($idSystem);

          if($request->ajax())
          {
              $view = view('web.partials.listSystems.graphicSystem')
                          ->with('first',$first);
              $newView = $view->render();
              return response()->json(['html'=>$newView]);
          }
      }

      public function getSystem($idSystem)
      {
          $system = System::find($idSystem);
          $products = $system->Entries()->get();
          $characteristics = $products->Characteristics()->get();

          $requestCrumb = Request::create(
                  '', 'GET', array(
                      'Departament' => $departament->departamentName,
                      'Zone' => $zone->nameZone,
                      'ListSystem' => $zone->idZone,
                      'System' => $system->nameSystem,
                  ));

          return view ('web.system')
                      ->with('system',$system)
                      ->with('products',$products)
                      ->with('characteristics',$characteristics);
      }
}
