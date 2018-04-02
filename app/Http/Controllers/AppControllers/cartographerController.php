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
    protected $characteristicsFileGlobal = "";
    protected $indicatorsFileGlobal = "";

    public function __construct()
    {
        $this->characteristicsFileGlobal = json_decode(Storage::disk('public')->get('characteristicsZones.json'));
        $this->indicatorsFileGlobal = json_decode(Storage::disk('public')->get('indicatorsZones.json'));
    }

    public function cartographerPanel(Request $request)
    {
        $request->session()->forget('sessionZone');
        $request->session()->forget('idsMunicipalities');
        $request->session()->forget('lastList');

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

    public function getListZones(Request $request, $idDepartament)
    {
        $request->session()->forget('sessionZone');
        $request->session()->forget('idsMunicipalities');
        $request->session()->forget('lastList');

        $idUser = Auth::user()->idUser;
        $departaments = User::find($idUser)->departaments;
        $departaments = $departaments->sortBy('departamentName');
        $currentDepartament = Departament::with('Zones')->where('idDepartament',$idDepartament)->first();

        $option = 'listZones';

        return view('app.cartographer')
                  ->with('departaments', $departaments)
                  ->with('currentDepartament', $currentDepartament)
                  ->with('option', $option);
    }

    public function getZone(Request $request, $idDepartament, $idZone = NULL, $validations = NULL)
    {
        //Objects and Resources
          $tools = new ZoneTools();
          $idUser = Auth::user()->idUser;
          $departaments = User::find($idUser)->departaments;
          $currentDepartament = Departament::find($idDepartament);

        //Assignments
          $climaticOptions = array('Cálido','Templado','Frio','Paramuno');
          $option = 'configZone';

        //Actions
        if(!is_null($idZone))
        {
            $zone = Zone::find($idZone);

            if(empty($request->input()))
            {
                $characteristics = $tools->reconstructItemsInvert($zone->Characteristics, $this->characteristicsFileGlobal);
                $indicators = $tools->reconstructItemsInvert($zone->Indicators, $this->indicatorsFileGlobal);
            }
            else
            {
                $characteristics = $tools->reconstructItems($request->input(), $this->characteristicsFileGlobal);
                $indicators = $tools->reconstructItems($request->input(), $this->indicatorsFileGlobal);
                $zone->nameZone = $request->nameZone;
            }
        }
        else
        {
            $zone = new Zone();

            if(empty($request->input()))
            {
                $characteristics = $this->characteristicsFileGlobal;
                $indicators = $this->indicatorsFileGlobal;
            }
            else
            {
                $characteristics = $tools->reconstructItems($request->input(), $this->characteristicsFileGlobal);
                $indicators = $tools->reconstructItems($request->input(), $this->indicatorsFileGlobal);
                $zone->nameZone = $request->nameZone;
            }
        }

        $view = view('app.cartographer')
                    ->with('departaments', $departaments)
                    ->with('option', $option)
                    ->with('characteristics', $characteristics)
                    ->with('indicators', $indicators)
                    ->with('currentDepartament', $currentDepartament)
                    ->with('zone', $zone)
                    ->with('climaticOptions', $climaticOptions)
                    ->withErrors($validations);

        // dd($zone->miniMapPath);
         return $view;
    }

    public function saveZone(Request $request)
    {
        if(isset($_POST['saveZone']))
        {
            $tools = new ZoneTools();
            $validations = $tools->validateZone($request);

            if($validations->fails())
            {
               $view = $this->getZone($request, $request->idDepartament , $request->idZone, $validations);
               return $view;
            }
            else
            {
                $tools->createUpdateZone($request);
                return redirect()->route('listZones',['idDepartament' => $request->idDepartament]);
            }
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
        //Objects and Resources
            $session = $request->session()->get('sessionZone');
            $idUser = Auth::user()->idUser;
            $departaments = User::find($idUser)->departaments;
            $departaments = $departaments->sortBy('departamentName');
            $currentDepartament = Departament::find(array_get($session, 'idDepartament'));

                if(!is_null(array_get($session, 'idZone')))
                {
                    $currentZone = Zone::find(array_get($session, 'idZone'));
                }
                else
                {
                    $currentZone = new Zone();
                }         

            $option = 'Municipalities';
            $municipalitiesZone = collect([]);
            $tools = new ZoneTools();
            $listMunicipalities = Municipality::where('idDepartament', $currentDepartament->idDepartament)->get();
        //Actions
        if(!is_null($currentZone->idZone))
        {
            
            $municipalitiesZone = Zone::find($currentZone->idZone)->Municipalities->with('Villages')->get();
            $listMunicipalities = $tools->getIds($listMunicipalities)->diff($tools->getIds($municipalitiesZone));
            $listMunicipalities = Municipality::whereIn('idMunicipality', $listMunicipalities->all())->get();
        }
        else
        {
            if ($request->session()->has('lastList')) 
            {
                $list = $request->session()->get('lastList');
                $municipalitiesZone = Municipality::with('Villages')->whereIn('idMunicipality', $list)->get();
                $listMunicipalities = $tools->getIds($listMunicipalities)->diff($tools->getIds($municipalitiesZone));
                $listMunicipalities = Municipality::whereIn('idMunicipality', $listMunicipalities->all())->get();
                
            }            
        }

        return view('app.cartographer')
                  ->with('departaments', $departaments)
                  ->with('option', $option)
                  ->with('municipalities', $municipalitiesZone)
                  ->with('listMunicipalities', $listMunicipalities)
                  ->with('currentDepartament', $currentDepartament)
                  ->with('currentZone', $currentZone);
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

    public function saveMunicipality(Request $request, $nameMunicipality)
    {
        $tools = new ZoneTools();
        $municipalities = $tools->saveAjaxMunicipality($request,$nameMunicipality);
        $session = $request->session()->get('sessionZone');
        $idDepartament = array_get($session, 'idDepartament');
        $listMunicipalities = Municipality::where('idDepartament', $idDepartament)->get();

        $listMunicipalities = $tools->getIds($listMunicipalities)->diff($tools->getIds($municipalities));
        $listMunicipalities = Municipality::whereIn('idMunicipality', $listMunicipalities->all())->get();
        $request->session()->put('lastList', $tools->getIds($municipalities));

        if($request->ajax())
        {
            $viewTable = view('app.partials.cartographer.tableMunicipality')
                        ->with('municipalities', $municipalities);

            $viewList = view('app.partials.cartographer.listMunicipalities')
                        ->with('listMunicipalities', $listMunicipalities);

            $newViewTable = $viewTable->render();
            $newViewList = $viewList->render();

            return response()->json(["viewTable"=>$newViewTable, "viewList" => $newViewList]);
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