<?php

namespace App\Http\Controllers\AppControllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use App\Logic\CreationZone\ZoneTools;
use App\Models\Departament;
use App\Models\CharacteristicZone;
use App\Models\IndicatorZone;
use App\Models\Zone;
use App\Models\Municipality;
use App\User;

class cartographerController extends Controller
{
    public function cartographerPanel()
    {
        $idUser = Auth::user()->idUser;
        $departaments = User::find($idUser)->departaments;
        $departaments = $departaments->sortBy('departamentName');
        $option = '';
        $token ='';

        return view('app.cartographer')
                  ->with('departaments', $departaments)
                  ->with('option', $option)
                  ->with('token', $token);
    }

    public function getListZones($idDepartament)
    {
        $idUser = Auth::user()->idUser;
        $departaments = User::find($idUser)->departaments;
        $departaments = $departaments->sortBy('departamentName');
        $selectDepartament = $departaments->first();

        $zones = Zone::where('idDepartament', $idDepartament)->get();
        $option = 'listZones';

        return view('app.cartographer')
                  ->with('departaments', $departaments)
                  ->with('zones', $zones)
                  ->with('option', $option)
                  ->with('selectDepartament', $selectDepartament);
    }

    public function getZone($idZone, $idDepartament)
    {
        //Objects and Resources
          $idUser = Auth::user()->idUser;
          $departaments = User::find($idUser)->departaments;
          $tools = new ZoneTools();

        //Assignments
          $characteristicsPath = database_path('data/characteristicsZones.json');
          $indicatorsPath = database_path('data/indicatorsZones.json');

          $characteristicsFile = File::get($characteristicsPath);
          $indicatorFile = File::get($indicatorsPath);

          $option = 'configZone';
        //Transformations
          $characteristicsFile = json_decode($characteristicsFile);
          $indicatorFile = json_decode($indicatorFile);

        //Actions
          if($idZone == 'null')
          {
              $zone = new Zone();
              $token = $tools->createRelations($characteristicsFile, $indicatorFile);
              $characteristics = CharacteristicZone::where('rememberToken',$token)->get();
              $indicators = IndicatorZone::where('rememberToken',$token)->get();
          }
          else
          {
              $zone = Zone::find($idZone);
              $characteristics = $zone->Characteristics;
              $indicators = $zone->Indicators;
              $token = $indicators->first()->rememberToken;
          }

          return view('app.cartographer')
                    ->with('departaments', $departaments)
                    ->with('option', $option)
                    ->with('characteristics', $characteristics)
                    ->with('indicators', $indicators)
                    ->with('token', $token)
                    ->with('idDepartament', $idDepartament)
                    ->with('zone', $zone);
    }

    public function saveZone(Request $request)
    {
        if(isset($_POST['saveZone']))
        {
            $tools = new ZoneTools();
            $tools->createZone($request);
            return redirect()->route('listZones',['idDepartament' => $request->idDepartament]);
        }
        else if(isset($_POST['addMunicipality']))
        {
            $sessionZone = $request->all();
            $request->session()->put('sessionZone', $sessionZone);
            return redirect()->route('municipality');
        }
    }

    public function deleteZone($idZone)
    {
        $zone = Zone::find($idZone);
        $zone->delete();
        return redirect()->route('cartographer');
    }

    public function getMunicipality(Request $request)
    {

        $tools = new ZoneTools();
        $session = $request->session()->get('sessionZone');
        $tools->updateZoneSession($session);

        $idUser = Auth::user()->idUser;
        $departaments = User::find($idUser)->departaments;
        $departaments = $departaments->sortBy('departamentName');
        $idZone = array_get($session, 'idZone');
        $token = array_get($session, 'tokenZone');
        $option = 'Municipalities';

        if(is_null($idZone))
        {
            $municipalities = Municipality::with('Villages')->where('rememberToken', $token)->get();
        }
        else
        {
            $municipalities = Municipality::with('Villages')->where('idZone', $idZone)->get();
        }

        return view('app.cartographer')
                  ->with('departaments', $departaments)
                  ->with('option', $option)
                  ->with('municipalities', $municipalities);
    }

    public function returnMunicipalityZone(Request $request)
    {
        $idUser = Auth::user()->idUser;
        $departaments = User::find($idUser)->departaments;
        $departaments = $departaments->sortBy('departamentName');

        $option = 'configZone';
        $session = $request->session()->get('sessionZone');
        $token = array_get($session, 'tokenZone');
        $idDepartament = array_get($session, 'idDepartament');
        $idZone = array_get($session, 'idZone');

        $characteristics = CharacteristicZone::where('rememberToken',$token)->get();
        $indicators = IndicatorZone::where('rememberToken',$token)->get();

        if(is_null($idZone))
        {
            $zone = new Zone();
        }
        else
        {
            $zone = Zone::find($idZone);
        }

        $zone->nameZone = array_get($session, 'nameZone');

        return view('app.cartographer')
                ->with('departaments', $departaments)
                ->with('option', $option)
                ->with('characteristics', $characteristics)
                ->with('indicators', $indicators)
                ->with('token', $token)
                ->with('idDepartament', $idDepartament)
                ->with('zone', $zone);
    }
    //http://localhost/uafApp/public/cartographer/saveMunicipality/Leo

    public function saveMunicipality(Request $request, $nameMunicipality)
    {
        $session = $request->session()->get('sessionZone');
        $idZone = array_get($session, 'idZone');

        $municipality = new Municipality();
          $municipality->nameMunicipality = $nameMunicipality;
          $municipality->rememberToken = array_get($session, 'tokenZone');

        //http://localhost/uafApp/public/cartographer/saveMunicipality/Leokarimasd

        if(is_null($idZone))
        {
            $municipality->save();
            $municipalities = Municipality::with('Villages')->where('rememberToken', array_get($session, 'tokenZone'))->get();
        }
        else
        {
            $municipality->idZone = $idZone;
            $municipality->save();
            $municipalities = Municipality::with('Villages')->where('idZone', $idZone)->get();
        }

        if($request->ajax())
        {
            $view = view('app.partials.cartographer.tableMunicipality')
                        ->with('municipalities', $municipalities);
            $newView = $view->render();
            return response()->json(["html"=>$newView]);
        }
    }

    public function deleteMunicipality(Request $request, $idMunicipality)
    {
        $session = $request->session()->get('sessionZone');
        $municipality = Municipality::find($idMunicipality);
        $idZone = array_get($session, 'idZone');
        // dd($municipality);
        $municipality->delete();

        if(is_null($idZone))
        {
            $municipalities = Municipality::with('Villages')->where('rememberToken', array_get($session, 'tokenZone'))->get();
        }
        else
        {
            $municipalities = Municipality::with('Villages')->where('idZone', $idZone)->get();
        }

        if($request->ajax())
        {
            $view = view('app.partials.cartographer.tableMunicipality')
                        ->with('municipalities', $municipalities);
            $newView = $view->render();
            return response()->json(["html"=>$newView]);
        }

    }

}
