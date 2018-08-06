<?php

namespace App\Http\Controllers\AppControllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Logic\CreationZone\ZoneTools;
use App\Models\Departament;
use App\Models\CharacteristicZone;
use App\Models\ZoneMunicipality;
use App\Models\ZoneMunicipalityVillage;
use App\Models\IndicatorZone;
use App\Models\Zone;
use App\Models\Municipality;
use App\Models\Village;
use App\User;
use Session;

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
        $request->session()->forget('lastList');
        $request->session()->forget('routeMiniMap');
        $request->session()->forget('villages');

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
        if(!is_null($idZone))
        {
            $zone = Zone::find($idZone);

            if ($zone->autor !== Auth::user()->full_name)
            {
                Session::flash('Message','No Autorizado!');
                return redirect()->route('listZones', ['idDepartament' => $idDepartament]);
            }
        }

        //Objects and Resources
          $tools = new ZoneTools();
          $idUser = Auth::user()->idUser;
          $departaments = User::find($idUser)->departaments;
          $currentDepartament = Departament::find($idDepartament);

        //Assignments
          $climaticOptions = array('Cálido','Templado','Frio','Extremadamente frío');
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

            if(!empty($request->input()))
            {
                $characteristics = $tools->reconstructItems($request->input(), $this->characteristicsFileGlobal);
                $indicators = $tools->reconstructItems($request->input(), $this->indicatorsFileGlobal);
                $zone->nameZone = $request->nameZone;

            }
            else if($request->session()->has('sessionZone'))
            {
                $input = $request->session()->get('sessionZone');
                $characteristics = $tools->reconstructItems($input, $this->characteristicsFileGlobal);
                $indicators = $tools->reconstructItems($input, $this->indicatorsFileGlobal);
                $zone->nameZone = array_get($input, 'nameZone');    
            }
            else
            {
                $characteristics = $this->characteristicsFileGlobal;
                $indicators = $this->indicatorsFileGlobal;
                $lastZone = DB::table('zones')
                                ->orderBy('idZone', 'desc')
                                ->first();
                $lastZone = is_null($lastZone) ? 1: $lastZone->idZone + 1;              

                $zone->nameZone = "ZRH".$idDepartament.'-'.$lastZone;
            }

            if($request->session()->has('routeMiniMap'))
            {
                $zone->miniMapPath = $request->session()->get('routeMiniMap');
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
                Session::flash('Message','Zona Guardada!');
                return redirect()->route('listZones',['idDepartament' => $request->idDepartament]);
            }
        }
        else if(isset($_POST['addMunicipality']))
        {
            if(!empty($request->file('miniMapFile')))
            {
                //dd($request->file('miniMapFile'));
                $routeMiniMap = url(Storage::putFileAs(
                    'miniMaps', $request->file('miniMapFile'), $request->nameZone.".png"
                ));
                $request->session()->put('routeMiniMap', $routeMiniMap);
            }

            $sessionZone = $request->all();
            unset($sessionZone['miniMapFile']);
            $request->session()->put('sessionZone', $sessionZone);
            return redirect()->route('municipality');
        }
    }

    public function deleteZone($idZone, $idDepartament)
    {
        $user = Auth::user();
        $zone = Zone::find($idZone);
        if ($zone->autor == $user->full_name)
        {
            $zone->delete();
            Session::flash('Message','Zona Eliminada!');
        }
        else
        {
            Session::flash('Message','No Autorizado!');
        }

        return redirect()->route('listZones', ['idDepartament' => $idDepartament]);
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
            $municipalitiesZone = Zone::find($currentZone->idZone)->Municipalities;
            $municipalitiesZone = $tools->getIds($municipalitiesZone);
            $municipalitiesZone = Municipality::with('Villages')->whereIn('idMunicipality', $municipalitiesZone)->get();
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
                  ->with('currentZone', $currentZone)
                  ->with('readonly', true)
                  ->with('nameMunicipality', '');
    }

    public function saveMunicipality(Request $request, $nameMunicipality)
    {
        
        $tools = new ZoneTools();
        $municipalities = $tools->saveAjaxMunicipality($request, $nameMunicipality);
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
        $idZone = array_get($session, 'idZone');
        $tools = new ZoneTools();
        $listMunicipalities = Municipality::where('idDepartament', array_get($session, 'idDepartament'))->get();
        $villages = NULL;

        if(!is_null($idZone))
        {
            $municipalities = Zone::find($idZone)->Municipalities;
            // dd($municipalities);
            $zoneMunicipality = ZoneMunicipality::where([
                ['idZone', '=', $idZone],
                ['idMunicipality', '=', $idMunicipality],
            ])->delete();
            $municipalities = Zone::find($idZone)->Municipalities;
            $municipalities = $tools->getIds($municipalities);
            $municipalities = Municipality::with('Villages')->whereIn('idMunicipality', $municipalities)->get();
        }
        else
        {
            $list = $request->session()->get('lastList');
            if($request->session()->has('villages'))
            {
                $villages = $request->session()->get('villages');
                $villages->each(function($item, $key) use(&$villages, $idMunicipality){
                    if($item->idMunicipality == $idMunicipality)
                    {
                        $villages->pull($key);
                    }
                });
            }
            
            // dd($list);
            $list = array_diff($list->toArray(), array($idMunicipality));  
            $request->session()->put('lastList', collect($list));

            $listMunicipalities = $tools->getIds($listMunicipalities)->diff($list);
            $listMunicipalities = Municipality::whereIn('idMunicipality', $listMunicipalities->all())->get();
            
            $municipalities = Municipality::whereIn('idMunicipality', $list)->get();
        }

        if($request->ajax())
        {
            $viewTable = view('app.partials.cartographer.tableMunicipality')
                        ->with('municipalities', $municipalities);

            $viewList = view('app.partials.cartographer.listMunicipalities')
                        ->with('listMunicipalities', $listMunicipalities);

            $tableVillages = view('app.partials.cartographer.tableVillages')
                                ->with('villages', collect([]))
                                ->with('idMunicipality', NULL);
            $nameVillage = view('app.partials.cartographer.nameVillage')
                                ->with('readonly', true);

            $newViewTable = $viewTable->render();
            $newViewList = $viewList->render();
            $newTableVillages = $tableVillages->render();
            $newNameVillage = $nameVillage->render();

            return response()->json(["viewTable"=>$newViewTable, "viewList" => $newViewList,
                                     "tableVillage"=>$newTableVillages, "nameVillage" => $newNameVillage]);
        }
    }

    public function showVillages(Request $request, $idMunicipality)
    {
        //Resources
        $session = $request->session()->get('sessionZone');
        $idUser = Auth::user()->idUser;
        $idZone = array_get($session, 'idZone');

        if(empty($idZone))
        {
            if($request->session()->has('villages'))
            {
                $villagesSession = $request->session()->get('villages');
                $villages = $villagesSession->where('idMunicipality',$idMunicipality);
            }
            else
            {
                $villages = collect([]);
            }
        }
        else
        {
            $villages = Village::where('idMunicipality',$idMunicipality)->get();
        }

        $municipalityName = Municipality::where('idMunicipality',$idMunicipality)->first()->nameMunicipality;

        $table = view('app.partials.cartographer.tableVillages')
                    ->with('villages', $villages)
                    ->with('idMunicipality', $idMunicipality);
        $nameVillage = view('app.partials.cartographer.nameVillage')
                            ->with('readonly', false);
        $titleVillage = view('app.partials.cartographer.villageTitle')
                            ->with('nameMunicipality', $municipalityName);

        $newTable = $table->render();
        $newNameVillage = $nameVillage->render();
        $newTitleVillage = $titleVillage->render();

        if($request->ajax())
        {
            return response()->json(["viewTable"=>$newTable, "inputName"=>$newNameVillage, "titleMunicipality"=>$newTitleVillage]);
        }
    }

    public function saveVillage(Request $request, $nameVillage)
    {
        //Resources
        $session = $request->session()->get('sessionZone');
        $idUser = Auth::user()->idUser;
        $idZone = array_get($session, 'idZone');
        $idMunicipality = $request->input('idMunicipality');
        
        if(empty($idZone))
        {
            if($request->session()->has('villages'))
            {
                $villages = $request->session()->get('villages');
            }
            else
            {   
                $villages = collect([]);
            }

            $village = new Village();
                $village->nameVillage = $nameVillage;
                $village->idMunicipality = $idMunicipality;
            
            $villages->push($village);
            $request->session()->put('villages', $villages);

        }
        else
        {
            $village = new Village();
                $village->nameVillage = $nameVillage;
                $village->idMunicipality = $idMunicipality;
            $village->save();

            $villages = Village::where('idMunicipality',$idMunicipality)->get();
        }

        return redirect()->route('showVillages',['idMunicipality' => $idMunicipality]);
    }

    public function deleteVillage(Request $request, $nameVillage)
    {
        $session = $request->session()->get('sessionZone');
        $idUser = Auth::user()->idUser;
        $idZone = array_get($session, 'idZone');
        $idMunicipality = $request->input('idMunicipality');

        if(empty($idZone))
        {
            $villages = $request->session()->get('villages');
            $villages->each(function($item, $key) 
                                use($nameVillage, $idMunicipality, &$deleteItem, &$villages){
                if(($item->nameVillage == $nameVillage) && ($item->idMunicipality == $idMunicipality))
                {
                    $villages->pull($key);
                }
            });

            $request->session()->put('villages', $villages);
        }
        else
        {
            $village = Village::where([
                        ['nameVillage','=', $nameVillage],
                        ['idMunicipality','=', $idMunicipality],
                        // ['idMunicipality','=', 1049],
            ])->get();
            $village->each(function($item, $key){
                $item->delete();
            });
        }

        return redirect()->route('showVillages',['idMunicipality' => $idMunicipality]);
    }

}