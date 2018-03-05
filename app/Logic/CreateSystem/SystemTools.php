<?php

namespace App\Logic\CreateSystem;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Logic\CreateSystem\SystemTools;
use App\Models\Cost;
use App\Models\UafParameter;
use Validator;

class SystemTools
{
    public function saveCost($request)
    {
        for($i=0; $i<=12; $i++)
        {
            $cost = new Cost();
            $quantity = 'quantity'.$i;
            //   //Attributes
                $cost->detail = $request->input('detail');
                $cost->group = $request->input('group');
                $cost->subGroup = $request->input('subGroup');
                $cost->quantity = $request->input($quantity);
                $cost->period = $i;

                $cost->rememberToken = $request->input('tokenSystem');
            //
              if($i == 0 || $i == 1)
              {
                  $cost->unitaryCost = $request->input('unitaryCost');
              }
              else
              {
                  $initialCost = $request->input('unitaryCost');
                  $cost->unitaryCost = $this->calculateUnitaryCost($initialCost, $i);
              }

              $cost->total = $cost->unitaryCost * $cost->quantity;
            //
            $cost->save();
        }
    }

    ////////////////////////////Auxiliars////////////////////////////////
    private function calculateUnitaryCost($initialCost, $period)
    {
        $inflation = UafParameter::where('showParameter', 'Inflacion')->first();
        $inflation = 1 + ($inflation->valueParameter/100);
        $unitaryCost = $initialCost;

        for($i = 0; $i < $period; $i++)
        {
            $unitaryCost*=$inflation;
        }

        return $unitaryCost;
    }
}
