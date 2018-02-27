<?php

namespace App\Http\Controllers\AppControllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Logic\CreationZone\ZoneTools;
use App\Models\Departament;
use App\Models\CharacteristicZone;
use App\Models\IndicatorZone;
use App\Models\Zone;
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

        $zones = Zone::where('idDepartament', $idDepartament)->get();
        $option = 'listZones';

        return view('app.cartographer')
                  ->with('departaments', $departaments)
                  ->with('zones', $zones)
                  ->with('option', $option)
                  ->with('selectDepartament', $idDepartament);
    }

    public function getZone($idZone, $idDepartament)
    {
        //Objects and Resources

          $idUser = Auth::user()->idUser;
          $departaments = User::find($idUser)->departaments;
          $tools = new ZoneTools();

        //Assignments
          $characteristicsPath = database_path('data\characteristicsZones.json');
          $indicatorsPath = database_path('data\indicatorsZones.json');

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
        $tools = new ZoneTools();
        $tools->createZone($request);

        return redirect()->route('listZones',['idDepartament' => $request->idDepartament]);
    }

    public function deleteZone($idZone)
    {
        $zone = Zone::find($idZone);
        $zone->delete();
        return redirect()->route('cartographer');
    }
}
