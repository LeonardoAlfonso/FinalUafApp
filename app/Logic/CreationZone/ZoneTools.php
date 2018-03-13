<?php

namespace App\Logic\CreationZone;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Logic\CreationZone\ZoneTools;
use App\Models\CharacteristicZone;
use App\Models\IndicatorZone;
use App\Models\Municipality;
use App\Models\Zone;
use Validator;

class ZoneTools
{
    protected $characteristicsFileGlobal = "";
    protected $indicatorFileGlobal = "";

    public function __construct()
    {
        $this->characteristicsFileGlobal = json_decode(Storage::disk('public')->get('characteristicsZones.json'));
        $this->indicatorFileGlobal = json_decode(Storage::disk('public')->get('indicatorsZones.json'));
    }


    public function createRelations($zoneCharacteristics, $zoneIndicators)
    // public function createRelations()
    {
        $token = str_random(10);

        foreach ($zoneCharacteristics as $zoneCharacteristic)
        // foreach ($characteristicsFileGlobal as $zoneCharacteristic)
        {
            $characteristics = new CharacteristicZone();
            $characteristics->nameCharacteristic = $zoneCharacteristic->name;
            $characteristics->valueCharacteristic = $zoneCharacteristic->value;
            $characteristics->showCharacteristic = $zoneCharacteristic->show;
            $characteristics->rememberToken =  $token;
            $characteristics->save();
        }

        foreach ($zoneIndicators as $zoneIndicator)
        // foreach ($indicatorFileGlobal as $zoneIndicator)
        {
            $indicators = new IndicatorZone();
            $indicators->nameIndicator = $zoneIndicator->name;
            $indicators->valueIndicator = $zoneIndicator->value;
            $indicators->showIndicator = $zoneIndicator->show;
            $indicators->rememberToken =  $token;
            $indicators->save();
        }

        return $token;
    }

    public function createZone(Request $request)
    {
            if(is_null($request->idZone))
            {
                $zone = new Zone();
                $municipalities = Municipality::with('Villages')->where('rememberToken', $request->tokenZone)->get();
                $characteristics = CharacteristicZone::where('rememberToken', $request->tokenZone)->get();
                $indicators = IndicatorZone::where('rememberToken', $request->tokenZone)->get();
            }
            else
            {
                $zone = Zone::find($request->idZone);
                $municipalities = Municipality::with('Villages')->where('idZone', $request->idZone)->get();
                $characteristics = CharacteristicZone::where('idZone', $request->idZone)->get();
                $indicators = IndicatorZone::where('idZone', $request->idZone)->get();
            }

          //Atributes
            $zone->nameZone = $request->nameZone;
            $zone->autor = $request->nameZone;
            $zone->miniMapPath = $request->nameZone;
            $zone->idDepartament = $request->idDepartament;
            $zone->save();

        foreach ($characteristics as $characteristic)
        {
            foreach ($this->characteristicsFileGlobal as $keyCharacteristic)
            {
                if($characteristic->showCharacteristic == $keyCharacteristic->show)
                {
                    $nameParameter = $keyCharacteristic->show;
                    $characteristic->valueCharacteristic = $request->$nameParameter;
                }
            }

            $characteristic->idZone = $zone->idZone;
            $characteristic->save();
        }


        foreach ($indicators as $indicator)
        {
            foreach ($this->indicatorFileGlobal as $keyindicator)
            {
                if($indicator->showIndicator == $keyindicator->show)
                {
                    $nameParameter = $keyindicator->show;
                    $indicator->valueIndicator = $request->$nameParameter;
                }
            }

            $indicator->idZone = $zone->idZone;
            $indicator->save();
        }

        foreach ($municipalities as $municipality)
        {
            $municipality->idZone = $zone->idZone;
            $municipality->save();
        }

        // $this->saveMiniMap($request);
    }

    public function updateZoneSession($session)
    {
        $characteristics = CharacteristicZone::where('rememberToken', array_get($session, 'tokenZone'))->get();
        $indicators = IndicatorZone::where('rememberToken', array_get($session, 'tokenZone'))->get();

        foreach ($characteristics as $characteristic)
        {
            foreach ($session as $key => $value)
            {
                if($characteristic->showCharacteristic == $key)
                {
                    $characteristic->valueCharacteristic = $value;
                }
            }

            $characteristic->save();
        }

        foreach ($indicators as $indicator)
        {
            foreach ($session as $key => $value)
            {
                if($indicator->showIndicator == $key)
                {
                    $indicator->valueIndicator = $value;
                }
            }

            $indicator->save();
        }
    }

    //Functions Aux:
    protected function saveMiniMap($request)
    {
        $file = $request->file('miniMapFile');
        $name = $file->getClientOriginalName();
        $test = $request->miniMapFile->storeAs('Map', $name, 'local');

    }


}
