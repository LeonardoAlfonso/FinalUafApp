<?php

namespace App\Logic\CreationZone;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Logic\CreationZone\ZoneTools;
use App\Models\CharacteristicZone;
use App\Models\IndicatorZone;
use App\Models\Zone;
use Validator;

class ZoneTools
{
    public function createRelations($zoneCharacteristics, $zoneIndicators)
    {
        $token = str_random(10);

        foreach ($zoneCharacteristics as $zoneCharacteristic)
        {
            $characteristics = new CharacteristicZone();
            $characteristics->nameCharacteristic = $zoneCharacteristic->name;
            $characteristics->valueCharacteristic = $zoneCharacteristic->value;
            $characteristics->rememberToken =  $token;
            $characteristics->save();
        }

        foreach ($zoneIndicators as $zoneIndicator)
        {
            $indicators = new IndicatorZone();
            $indicators->nameIndicator = $zoneIndicator->name;
            $indicators->valueIndicator = $zoneIndicator->value;
            $indicators->rememberToken =  $token;
            $indicators->save();
        }

        return $token;
    }

    public function createZone(Request $request)
    {
        $zone = new Zone();
          //Atributes
            $zone->nameZone = $request->nameZone;
            $zone->autor = $request->nameZone;
            $zone->miniMapPath = $request->nameZone;
            $zone->idDepartament = $request->idDepartament;
            $zone->save();

            $characteristics = CharacteristicZone::where('rememberToken', $request->tokenZone)->get();
            $indicators = IndicatorZone::where('rememberToken', $request->tokenZone)->get();

        foreach ($characteristics as $characteristic)
        {
            $characteristic->idZone = $zone->idZone;
            $characteristic->save();
        }

        foreach ($indicators as $indicator)
        {
            $indicator->idZone = $zone->idZone;
            $indicator->save();
        }

    }

}
