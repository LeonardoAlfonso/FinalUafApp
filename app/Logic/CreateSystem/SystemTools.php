<?php

namespace App\Logic\CreateSystem;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Logic\CreateSystem\SystemTools;
use App\Models\Cost;
use App\Models\Entry;
use App\Models\UafParameter;
use App\Models\Virtuals\CostVirtual;
use App\Models\Virtuals\EntryVirtual;
use Validator;

class SystemTools
{
    public function saveCost($request)
    {
        for($i=0; $i<=12; $i++)
        {
            $cost = new Cost();
            $quantity = 'quantity'.$i;
              //Attributes
                $cost->detail = $request->input('detail');
                $cost->group = $request->input('listGroup');
                $cost->subGroup = $request->input('listSubGroup');
                $cost->quantity = $request->input($quantity);
                $cost->period = $i;

                $cost->rememberToken = $request->input('tokenSystem');

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

            $cost->save();
        }        
    }

    public function showCosts($token)
    {
        
        $costs = Cost::select('detail')->where('rememberToken', $token)->distinct('detail')->get();
        $listCosts = array();

        if($costs->count() > 0)
        {
            foreach($costs as $cost)
            {
                $newCost = new CostVirtual;
                $completeCost = Cost::where('detail',$cost->detail)->where('period',0)->first();
    
                    $newCost->id = $completeCost->idCost;
                    $newCost->detail = $completeCost->detail;
                    $newCost->group = $completeCost->group;
                    $newCost->subGroup = $completeCost->subGroup;
                    $newCost->unitaryCost = $completeCost->unitaryCost;
    
                for($i=0; $i <= 12; $i++)
                {
                    $quantityPeriod = 'quantity'.$i;
                    $auxCost = Cost::where('detail', $cost->detail)->where('period',$i)->first();
                    $newCost->$quantityPeriod = $auxCost->quantity;
                }
    
                $listCosts = array_merge($listCosts, array($newCost));
            }
        }
        return $listCosts;
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

    public function getGroup()
    {
        $groups = $this->uafParameters = json_decode(Storage::disk('public')->get('costGroups.json'));
        $optionsGroup = array();
        
        foreach($groups as $group)
        {
            $optionsGroup = array_merge($optionsGroup, array($group->group));
        }

        return $optionsGroup;
    }

    public function getSubGroup($group)
    {
        $groups = $this->uafParameters = json_decode(Storage::disk('public')->get('costGroups.json'));
        $optionsSubGroup = array();

        for($i=0; $i<count($groups); $i++)
        {
            if(strpos($groups[$i]->group,$group) !== false)
            {
                foreach($groups[$i]->subGroup as $subGroup)
                {
                    $optionsSubGroup = array_merge($optionsSubGroup, array($subGroup));
                }
            }
        }

       return $optionsSubGroup;
    }

/*-/////////Entries//////////////////*/
    public function saveEntry($request)
    {
        for($i=1; $i<=12; $i++)
        {
            $entry = new Entry();
            $quantity = 'quantity'.$i;

            //Attributes
                $entry->name = $request->input('concept');
                $entry->measureUnity = $request->input('measureUnity');
                $entry->priceSource = $request->input('source');
                $entry->datePriceSource = $request->input('sourceDate');
                $entry->integralIndicator = "0";
                $entry->quantity = $request->input($quantity);
                $entry->period = $i;

                $entry->rememberToken = $request->input('tokenSystem');


            if($i == 1)
            {
                $entry->unitaryPrice = $request->input('unitaryPrice');
                // $entry->unitaryPrice = "2";
            }
            else
            {
                $initialEntry = $request->input('unitaryPrice');
                // $initialEntry = "2";
                $entry->unitaryPrice = $this->calculateUnitaryEntry($initialEntry, $i);
            }

            $entry->total = $entry->unitaryPrice * $entry->quantity;
            $entry->save();
        }        
    }

    private function calculateUnitaryEntry($initialEntry, $period)
    {
        $inflation = UafParameter::where('showParameter', 'Inflacion')->first();
        $inflation = 1 + ($inflation->valueParameter/100);
        $unitaryEntry = $initialEntry;

        for($i = 0; $i < $period; $i++)
        {
            $unitaryEntry*=$inflation;
        }

        return $unitaryEntry;
    }

    public function showEntries($token)
    {
        $entries = Entry::select('name')->where('rememberToken', $token)->distinct('name')->get();
        $listEntries = array();

        if($entries->count() > 0)
        {
            foreach($entries as $entry)
            {
                $newEntry = new EntryVirtual;
                $completeEntry = Entry::where('name', $entry->name)->where('period',1)->first();
    
                    $newEntry->id = $completeEntry->idEntry;
                    $newEntry->name = $completeEntry->name;
                    $newEntry->unitaryPrice = $completeEntry->unitaryPrice;
                    $newEntry->measureUnity = $completeEntry->measureUnity;
                    $newEntry->priceSource = $completeEntry->priceSource;
                    $newEntry->datePriceSource = $completeEntry->datePriceSource;

                for($i=1; $i <= 12; $i++)
                {
                    $quantityPeriod = 'quantity'.$i;
                    $auxEntry = Entry::where('name', $entry->name)->where('period',$i)->first();
                    $newEntry->$quantityPeriod = $auxEntry->quantity;
                }
    
                $listEntries = array_merge($listEntries, array($newEntry));
            }
        }

        return $listEntries;
    }

}
