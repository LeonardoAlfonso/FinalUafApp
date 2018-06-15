<?php

namespace App\Logic\CreationZone;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Logic\CreationZone\ZoneTools;
use App\Models\CharacteristicZone;
use App\Models\ZoneMunicipality;
use App\Models\IndicatorZone;
use App\Models\Municipality;
use App\Models\Zone;
use App\User;
use Validator;

class ZoneTools
{
    protected $characteristicsFileGlobal = "";
    protected $indicatorFileGlobal = "";

    public function __construct()
    {
        $this->characteristicsFileGlobal = json_decode(Storage::disk('public')->get('characteristicsZones.json'));
        $this->indicatorsFileGlobal = json_decode(Storage::disk('public')->get('indicatorsZones.json'));
    }

    public function reconstructItems($input, $items)
    {
        $resultItems = array();

        foreach ($items as $characteristic)
        {
            foreach ($input as $key => $value)
            {
                if(($characteristic->name == $key) || ($characteristic->show == $key))
                {
                    $characteristic->value = $value;
                }
            }

            $resultItems = array_merge($resultItems, array($characteristic));
        }

        return $resultItems;
    }

    public function validateZone(Request $request)
    {
        $input = $request->all();
        $finalInput = array();

        $currentNewRules = array();
        $rules = array();

        foreach($this->indicatorsFileGlobal as $currentIndicator)
        {
            $indicatorsRules = explode('|', $currentIndicator->rules);

            foreach($indicatorsRules as $currentRule)
            {
                $newRule = array($currentRule);
                $currentNewRules = array_merge($currentNewRules, $newRule);
            }
            $rules = array_merge($rules, array($currentIndicator->show => $currentNewRules));
            $currentNewRules = array();
        }

        foreach($this->characteristicsFileGlobal as $currentCharacteristic)
        {

            $characteristicsRules = explode('|', $currentCharacteristic->rules);

            foreach($characteristicsRules as $currentRule)
            {
                $newRule = array($currentRule);
                $currentNewRules = array_merge($currentNewRules, $newRule);
            }

            $rules = array_merge($rules, array($currentCharacteristic->name => $currentNewRules));
            $currentNewRules = array();
        }

        //Extra Rules
        //$rules = array_merge($rules, array('fileState' => array('required')));
        //$rules = array_merge($rules, array('miniMapFile' => array('image','max:10240')));
        $rules = array_merge($rules, array('nameZone' => array('required','max:40')));

        $messages = [
          'required' => 'Campo Obligatorio',
          'numeric' => 'Campo Numérico',
          'image' => 'Debe ser imagen (png, jpg)',
          'max'=>[
                'file' => 'Peso Máximo: 10 MB',
                'string' => 'El campo debe tener máximo 40 caracteres',
                'numeric' => 'Porcentaje entre 0 y 100'
          ],
          'min'=>[
                'numeric' => 'Porcentaje entre 0 y 100'
          ]
        ];
        return Validator::make($input, $rules, $messages);

    }

    public function createUpdateZone(Request $request)
    {
        $zone = is_null(Zone::where('idZone', $request->idZone)->first()) ? new Zone(): 
                        Zone::where('idZone', $request->idZone)->first();
                
            $zone->nameZone = $request->nameZone;
            $zone->autor = Auth::user()->full_name;

                if(!empty($request->file('miniMapFile')))
                {
                    $zone->miniMapPath = url(Storage::putFileAs(
                        'miniMaps', $request->file('miniMapFile'), $request->nameZone.".png"
                    ));
                }
                else if($request->session()->has('routeMiniMap'))
                {
                    $zone->miniMapPath = $request->session()->get('routeMiniMap');
                }

            $zone->idDepartament = $request->idDepartament;

        $zone->save();
        
        $viewCharacteristics = $this->reconstructItems($request->input(), $this->characteristicsFileGlobal);
        $viewIndicators = $this->reconstructItems($request->input(), $this->indicatorsFileGlobal);

        foreach($viewCharacteristics as $characteristic)
        {
            $validation = $zone->Characteristics()->where('nameCharacteristic', $characteristic->name)->get();
            $newCharacteristic = $validation->isEmpty() ? new CharacteristicZone(): $validation->first();
                $newCharacteristic->nameCharacteristic = $characteristic->name;
                $newCharacteristic->valueCharacteristic = $characteristic->value;
                $newCharacteristic->showCharacteristic = $characteristic->show;
                $newCharacteristic->idZone = $zone->idZone;
            $newCharacteristic->save();
        }

        foreach($viewIndicators as $indicator)
        {
            $validation = $zone->Indicators()->where('nameIndicator', $indicator->name)->get();
            $newIndicator = $validation->isEmpty() ? new IndicatorZone(): $validation->first();
                $newIndicator->nameIndicator = $indicator->name;
                $newIndicator->valueIndicator = $indicator->value;
                $newIndicator->showIndicator = $indicator->show;
                $newIndicator->idZone = $zone->idZone;
            $newIndicator->save();
        }

        if($request->session()->has('lastList') && empty($request->idZone))
        {
            $municipalities = $request->session()->get('lastList');

            foreach($municipalities as $municipality)
            {
                $zoneMunicipality = new ZoneMunicipality();
                    $zoneMunicipality->idMunicipality = $municipality;
                    $zoneMunicipality->idZone = $zone->idZone;
                
                $zoneMunicipality->save();
            }    
        }

        if($request->session()->has('villages') && empty($request->idZone))
        {
            $villages = $request->session()->get('villages');

            foreach($villages as $village)
            {
                $village->save();
            }    
        }
    }

    public function  reconstructItemsInvert($input, $items)
    {
        foreach($input as $elementsZone)
        {
            foreach($items as $item)
            {
                if($item->name == $elementsZone->nameCharacteristic)
                {
                    $item->value = $elementsZone->valueCharacteristic;
                }

                if($item->name == $elementsZone->nameIndicator)
                {
                    $item->value = $elementsZone->valueIndicator;
                }
            }
        }

        return $items;
    }

    public function saveAjaxMunicipality(Request $request, $nameMunicipality)
    {
        $session = $request->session()->get('sessionZone');
        $idDepartament = array_get($session, 'idDepartament');
        $idZone = array_get($session, 'idZone');
        $Municipality = Municipality::where('idDepartament',$idDepartament)
                                      ->where('nameMunicipality',$nameMunicipality)->first();

        if(empty($idZone))
        {
            if ($request->session()->has('lastList')) 
            {
                $municipalities = $request->session()->get('lastList');
            }
            else
            {
                $municipalities = collect([]);
            }

            $municipalities->push($Municipality->idMunicipality);
            $request->session()->put('lastList', $municipalities);
            return Municipality::whereIn('idMunicipality', $municipalities)->get();
        }
        else
        {
            $zoneMunicipality = new ZoneMunicipality();
                $zoneMunicipality->idMunicipality = $Municipality->idMunicipality;
                $zoneMunicipality->idZone = $idZone;
            $zoneMunicipality->save();

            $municipalitiesZone = Zone::find($idZone)->Municipalities;
            $municipalitiesZone = $this->getIds($municipalitiesZone);
            $municipalitiesZone = Municipality::whereIn('idMunicipality', $municipalitiesZone)->get();
            return $municipalitiesZone;
        }
    }

    public function getIds($items)
    {
        $idsItems = collect([]);

        foreach($items as $item)
        {
            $idsItems->push($item->idMunicipality);
        }

        return $idsItems;
    }























    // public function updateZoneSession($session)
    // {
    //     $characteristics = CharacteristicZone::where('rememberToken', array_get($session, 'tokenZone'))->get();
    //     $indicators = IndicatorZone::where('rememberToken', array_get($session, 'tokenZone'))->get();

    //     foreach ($characteristics as $characteristic)
    //     {
    //         foreach ($session as $key => $value)
    //         {
    //             if($characteristic->showCharacteristic == $key)
    //             {
    //                 $characteristic->valueCharacteristic = $value;
    //             }
    //         }

    //         $characteristic->save();
    //     }

    //     foreach ($indicators as $indicator)
    //     {
    //         foreach ($session as $key => $value)
    //         {
    //             if($indicator->showIndicator == $key)
    //             {
    //                 $indicator->valueIndicator = $value;
    //             }
    //         }

    //         $indicator->save();
    //     }
    // }











    // public function createRelations($zoneCharacteristics, $zoneIndicators)
    // // public function createRelations()
    // {
    //     $token = str_random(10);

    //     foreach ($zoneCharacteristics as $zoneCharacteristic)
    //     // foreach ($characteristicsFileGlobal as $zoneCharacteristic)
    //     {
    //         $characteristics = new CharacteristicZone();
    //         $characteristics->nameCharacteristic = $zoneCharacteristic->name;
    //         $characteristics->valueCharacteristic = $zoneCharacteristic->value;
    //         $characteristics->showCharacteristic = $zoneCharacteristic->show;
    //         $characteristics->rememberToken =  $token;
    //         $characteristics->save();
    //     }

    //     foreach ($zoneIndicators as $zoneIndicator)
    //     // foreach ($indicatorFileGlobal as $zoneIndicator)
    //     {
    //         $indicators = new IndicatorZone();
    //         $indicators->nameIndicator = $zoneIndicator->name;
    //         $indicators->valueIndicator = $zoneIndicator->value;
    //         $indicators->showIndicator = $zoneIndicator->show;
    //         $indicators->rememberToken =  $token;
    //         $indicators->save();
    //     }

    //     return $token;
    // }

    // public function createZone2(Request $request)
    // {
    //         $validations = $this->validateZone($request);

    //         if($validations->fails())
    //         {
    //             return $validations;
    //         }
    //         else
    //         {
    //             if(is_null($request->idZone))
    //             {
    //                 $zone = new Zone();
    //                 $municipalities = Municipality::with('Villages')->where('rememberToken', $request->tokenZone)->get();
    //                 $characteristics = CharacteristicZone::where('rememberToken', $request->tokenZone)->get();
    //                 $indicators = IndicatorZone::where('rememberToken', $request->tokenZone)->get();
    //             }
    //             else
    //             {
    //                 $zone = Zone::find($request->idZone);
    //                 $municipalities = Municipality::with('Villages')->where('idZone', $request->idZone)->get();
    //                 $characteristics = CharacteristicZone::where('idZone', $request->idZone)->get();
    //                 $indicators = IndicatorZone::where('idZone', $request->idZone)->get();
    //             }

    //                 //Atributes
    //                     $zone->nameZone = $request->nameZone;
    //                     $zone->autor = $request->nameZone;
    //                     $zone->miniMapPath = $request->nameZone;
    //                     $zone->idDepartament = $request->idDepartament;
    //                     $zone->save();

    //                 foreach ($characteristics as $characteristic)
    //                 {
    //                     foreach ($this->characteristicsFileGlobal as $keyCharacteristic)
    //                     {
    //                         if($characteristic->showCharacteristic == $keyCharacteristic->name)
    //                         {
    //                             $nameParameter = $keyCharacteristic->name;
    //                             $characteristic->valueCharacteristic = $request->$nameParameter;
    //                         }
    //                     }

    //                     $characteristic->idZone = $zone->idZone;
    //                     $characteristic->save();
    //                 }


    //                 foreach ($indicators as $indicator)
    //                 {
    //                     foreach ($this->indicatorFileGlobal as $keyindicator)
    //                     {
    //                         if($indicator->showIndicator == $keyindicator->show)
    //                         {
    //                             $nameParameter = $keyindicator->show;
    //                             $indicator->valueIndicator = $request->$nameParameter;
    //                         }
    //                     }

    //                     $indicator->idZone = $zone->idZone;
    //                     $indicator->save();
    //                 }

    //                 foreach ($municipalities as $municipality)
    //                 {
    //                     $municipality->idZone = $zone->idZone;
    //                     $municipality->save();
    //                 }

    //                 return $validations;
    //         }
    //     // $this->saveMiniMap($request);
    // }

    // public function updateZoneSession($session)
    // {
    //     $characteristics = CharacteristicZone::where('rememberToken', array_get($session, 'tokenZone'))->get();
    //     $indicators = IndicatorZone::where('rememberToken', array_get($session, 'tokenZone'))->get();

    //     foreach ($characteristics as $characteristic)
    //     {
    //         foreach ($session as $key => $value)
    //         {
    //             if($characteristic->showCharacteristic == $key)
    //             {
    //                 $characteristic->valueCharacteristic = $value;
    //             }
    //         }

    //         $characteristic->save();
    //     }

    //     foreach ($indicators as $indicator)
    //     {
    //         foreach ($session as $key => $value)
    //         {
    //             if($indicator->showIndicator == $key)
    //             {
    //                 $indicator->valueIndicator = $value;
    //             }
    //         }

    //         $indicator->save();
    //     }
    // }

    // //Functions Aux:
    // protected function saveMiniMap($request)
    // {
    //     $file = $request->file('miniMapFile');
    //     $name = $file->getClientOriginalName();
    //     $test = $request->miniMapFile->storeAs('Map', $name, 'local');

    // }

    // public function createZoneView(Request $request, $validations = "")
    // {
    //     $user = Auth::user();
    //     $departaments = User::find($user->idUser)->departaments;
    //     $Departament = Departament::find($request->idDepartament);
    //     $option = 'configZone';
    //     $token = $request->token;

    //     $zone = new Zone;
    //         $zone->idZone = $request->idZone;
    //         $zone->nameZone = $request->nameZone;
    //         $zone->idDepartament = $idDepartament;

    //     $characteristics = CharacteristicZone::where('idZone', '28')->orderBy('nameCharacteristic','desc')->get();
    //     $indicators = IndicatorZone::where('idZone', '28')->orderBy('showIndicator','asc')->get();

    //     foreach($characteristics as $characteristic)
    //     {
    //         $parameter = $characteristic->nameCharacteristic;
    //         $characteristic->valueCharacteristic = $request->$parameter;
    //     }

    //     foreach($indicators as $indicator)
    //     {
    //         $parameter = $indicator->showIndicator;
    //         $indicator->valueIndicator = $request->$parameter;
    //     }

    //     $view = view('app.cartographer')
    //                 ->with('departaments', $departaments)
    //                 ->with('option', $option)
    //                 ->with('characteristics', $characteristics)
    //                 ->with('indicators', $indicators)
    //                 ->with('token', $token)
    //                 ->with('idDepartament', $idDepartament)
    //                 ->with('zone', $zone)
    //                 ->withErrors($validations);

    //     return $view;
    // }
}