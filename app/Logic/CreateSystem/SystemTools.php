<?php

namespace App\Logic\CreateSystem;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use App\Logic\CreateSystem\SystemTools;
use App\Models\Cost;
use App\Models\Entry;
use App\Models\Utility;
use App\Models\UafParameter;
use App\Models\Zone;
use App\Models\Virtuals\CostVirtual;
use App\Models\Virtuals\EntryVirtual;
use App\Models\SystemIndicator;
use App\User;
use Validator;

class SystemTools
{
    public function getSystemList(Request $request, $idZone)
    {
        $this->forgetSession($request);
        $idUser = Auth::user()->idUser;
        $departaments = User::find($idUser)->departaments;
        $option = 'List';
        $selectZone = Zone::where('idZone', $idZone)->first();
        $selectDepartament = $selectZone->Departament()->first();  
        $zones = $selectDepartament->zones()->get();
        $systems = $selectZone->Systems()->get();

        $view = view('app.expert')
                  ->with('departaments', $departaments)
                  ->with('option', $option)
                  ->with('zones', $zones)
                  ->with('systems', $systems)
                  ->with('selectZone', $selectZone)
                  ->with('selectDepartament', $selectDepartament);

        return $view;
    }

    public function showCosts(Request $request)
    {
        if($request->session()->has('costs'))
        {
            $costs = $request->session()->get('costs');
        }
        else
        {
            $costs = collect([]);
        }

        $index = $costs->count();

        $optionsGroup = $this->getGroup();

        $newCost = new CostVirtual;
        $cleanCost = new CostVirtual();
            $newCost->id = $index;
            $newCost->detail = $request->input('detail');
            $newCost->group = $request->input('listGroup');
            $newCost->subGroup = $request->input('listSubGroup');
            $newCost->unitaryCost = $request->input('unitaryCost');

            $newCost->quantity0 = $request->input('quantity0');
            $newCost->quantity1 = $request->input('quantity1');
            $newCost->quantity2 = $request->input('quantity2');
            $newCost->quantity3 = $request->input('quantity3');
            $newCost->quantity4 = $request->input('quantity4');
            $newCost->quantity5 = $request->input('quantity5');
            $newCost->quantity6 = $request->input('quantity6');
            $newCost->quantity7 = $request->input('quantity7');
            $newCost->quantity8 = $request->input('quantity8');
            $newCost->quantity9 = $request->input('quantity9');
            $newCost->quantity10 = $request->input('quantity10');
            $newCost->quantity11 = $request->input('quantity11');
            $newCost->quantity12 = $request->input('quantity12');
           
            $cleanCost->id = "";
            $cleanCost->detail = "";
            $cleanCost->group = NULL;
            $cleanCost->subGroup = NULL;
            $cleanCost->unitaryCost = "";

            $cleanCost->quantity0 = "";
            $cleanCost->quantity1 = "";
            $cleanCost->quantity2 = "";
            $cleanCost->quantity3 = "";
            $cleanCost->quantity4 = "";
            $cleanCost->quantity5 = "";
            $cleanCost->quantity6 = "";
            $cleanCost->quantity7 = "";
            $cleanCost->quantity8 = "";
            $cleanCost->quantity9 = "";
            $cleanCost->quantity10 = "";
            $cleanCost->quantity11 = "";
            $cleanCost->quantity12 = "";

        $validations = $this->validateCost($newCost);  

        if($validations->fails())
        {
            $optionsSubGroup = $this->getSubGroup($newCost->group);
            $modalView = view('app.partials.expert.modals.costModal')
                            ->with('modalCost', $newCost)
                            ->with('optionsGroup', $optionsGroup)
                            ->with('optionsSubGroup',$optionsSubGroup)
                            ->withErrors($validations);
            $modalCostView = $modalView->render();
            
            return collect(['modal' => $modalCostView, 'table' => "", 
                            'validation' => $validations->fails()]);
        }
        else
        {
            $optionsSubGroup = $this->getSubGroup($cleanCost->group);
            $costs->push($newCost);
            $request->session()->put('costs', $costs);

            $tableView = view('app.partials.expert.tableCosts')
                            ->with('listCosts',$costs);

            $tableCostsView = $tableView->render();

            $modalView = view('app.partials.expert.modals.costModal')
                            ->with('modalCost', $cleanCost)
                            ->with('optionsGroup', $optionsGroup)
                            ->with('optionsSubGroup',$optionsSubGroup)
                            ->withErrors($validations);
            $modalCostView = $modalView->render();

            return collect(['modal' => $modalCostView, 'table' => $tableCostsView, 
                            'validation' => $validations->fails()]);
        }
    }

    public function showEntries(Request $request)
    {
        if($request->session()->has('entries'))
        {
            $entries = $request->session()->get('entries');
        }
        else
        {
            $entries = collect([]);
        }

        $index = $entries->count();

        $newEntry = new EntryVirtual;
            $newEntry->id = $index;
            $newEntry->name = $request->input('concept');
            $newEntry->unitaryPrice = $request->input('unitaryPrice');
            $newEntry->measureUnity = $request->input('measureUnity');
            $newEntry->priceSource = $request->input('source');
            $newEntry->datePriceSource = $request->input('sourceDate');

            $newEntry->quantity1 = $request->input('quantity1');
            $newEntry->quantity2 = $request->input('quantity2');
            $newEntry->quantity3 = $request->input('quantity3');
            $newEntry->quantity4 = $request->input('quantity4');
            $newEntry->quantity5 = $request->input('quantity5');
            $newEntry->quantity6 = $request->input('quantity6');
            $newEntry->quantity7 = $request->input('quantity7');
            $newEntry->quantity8 = $request->input('quantity8');
            $newEntry->quantity9 = $request->input('quantity9');
            $newEntry->quantity10 = $request->input('quantity10');
            $newEntry->quantity11 = $request->input('quantity11');
            $newEntry->quantity12 = $request->input('quantity12');
    
        $entries->push($newEntry);
        $request->session()->put('entries', $entries);

        return $entries;
    }

    public function reconstructItems(Request $request)
    {
        $virtualCosts = $request->session()->get('costs');
        $virtualEntries = $request->session()->get('entries');
        $efectiveRate = UafParameter::where('nameParameter', 'TasaEfectiva')->first();
        $efectiveRate = $efectiveRate->valueParameter/ 100;
        $IVP = UafParameter::where('nameParameter', 'IVP')->first();
        $IVP = $IVP->valueParameter/ 100;
        $nominalRate = pow((1+$efectiveRate),(1/12)) -1;
        $creditPeriods = UafParameter::where('nameParameter', 'PeriodosFinanciacion')->first();
        $creditPeriods = $creditPeriods->valueParameter;
        $costs = collect([]);
        $entries = collect([]);
        $futureEntries = collect([]);
        
        $virtualCosts->each(function($item, $key) use($costs, $request){

            for($i=0; $i<=12; $i++)
            {
                $cost = new Cost();
                $quantity = 'quantity'.$i;

                    $cost->detail = $item->detail;         
                    $cost->group = "$item->group";                    
                    $cost->subGroup = $item->subGroup;                    
                    $cost->quantity = $item->$quantity;
                    $cost->period = $i;
                   

                    if($i == 0 || $i == 1)
                    {
                        $cost->unitaryCost = $item->unitaryCost;
                    }
                    else
                    {
                        $initialCost = $item->unitaryCost;
                        $cost->unitaryCost = $this->calculateUnitaryCost($initialCost, $i);
                    }
                   
                    $cost->total = $cost->unitaryCost * $cost->quantity;
                    
                $costs->push($cost);
                $request->session()->put('realCosts', $costs);
            }
        });
    
        $establishmentCost = $costs->where('period', 0)->sum('total');
        $mensualPayment = ($establishmentCost * $nominalRate) /
                          (1 - pow((1 + $nominalRate), ($creditPeriods * (-1))));
                          
        for($i=1; $i<=12; $i++)
        {
            $financialCost = new Cost();
            $quantity = 'quantity'.$i;

                $financialCost->detail = "Crédito";
                $financialCost->group = "Financiero";
                $financialCost->subGroup = "Financiero";
                $financialCost->quantity = "12";
                $financialCost->period = $i;
                $financialCost->unitaryCost = $mensualPayment;
                $financialCost->total = $financialCost->unitaryCost * $financialCost->quantity;

                $costs->push($financialCost);
                $request->session()->put('realCosts', $costs);
        }

        $virtualEntries->each(function($item, $key) use($entries, $futureEntries, $request, $IVP){
            
            for($i=1; $i<=12; $i++)
            {
                $entry = new Entry();
                $futureEntry = new Entry();
                $quantity = 'quantity'.$i;

                    $entry->name = $item->name;
                    $entry->measureUnity = $item->measureUnity;
                    $entry->priceSource = $item->priceSource;
                    $entry->datePriceSource = $item->datePriceSource;
                    $entry->integralIndicator = "0";
                    $entry->quantity = $item->$quantity;
                    $entry->period = $i;

                    $futureEntry->name = $item->name;
                    $futureEntry->measureUnity = $item->measureUnity;
                    $futureEntry->priceSource = $item->priceSource;
                    $futureEntry->datePriceSource = $item->datePriceSource;
                    $futureEntry->integralIndicator = "0";
                    $futureEntry->quantity = $item->$quantity;
                    $futureEntry->period = $i;

                    if($i == 1)
                    {
                        $entry->unitaryPrice = $item->unitaryPrice;
                        $futureEntry->unitaryPrice = $item->unitaryPrice/(1+$IVP);
                    }
                    else
                    {
                        $initialEntry = $item->unitaryPrice;
                        $entry->unitaryPrice = $this->calculateUnitaryEntry($initialEntry, $i);
                        $futureEntry->unitaryPrice = $entry->unitaryPrice/(1+$IVP);
                    }
                
                    $entry->total = $entry->unitaryPrice * $entry->quantity;
                    $futureEntry->total = $futureEntry->unitaryPrice * $futureEntry->quantity;

                $entries->push($entry);
                $futureEntries->push($futureEntry);
                $request->session()->put('realEntries', $entries);
                $request->session()->put('futureEntries', $futureEntries);
            }
        });
    }
    
    public function calculateSalaries(Request $request)
    {
        if(!$request->session()->has('SMMLV'))
        {
            $SMMVL = UafParameter::where('nameParameter', 'SMMLV')->first();
            $SMMVL = $SMMVL->valueParameter;

            $inflation = UafParameter::where('showParameter', 'Inflacion')->first();
            $inflationFactor = 1 + ($inflation->valueParameter/100);

            $discountRate = UafParameter::where('nameParameter', 'TasaDescuento')->first();
            $discountRate = $discountRate->valueParameter/100;
            
            $salaries = collect([]);
            $salaries->put(0,$SMMVL);

            $anualSalaries = collect([]);
            $anualSalaries25 = collect([]);
            $anualSalaries25VPN = collect([]);


            for($i = 1; $i < 12; $i++)
            {
                $salary = $salaries->get($i-1)*($inflationFactor);
                $salaries->put($i,$salary);
            }

            $salaries->each(function($item, $key) use($anualSalaries, $anualSalaries25, 
                                                        $anualSalaries25VPN, $discountRate){
                $anualSalary = $item*12;
                $anualSalary25 = $anualSalary*2.5;
                $anualSalary25VPN = $anualSalary25/pow((1+$discountRate),($key+1));

                $anualSalaries->push($anualSalary);
                $anualSalaries25->push($anualSalary25);
                $anualSalaries25VPN->push($anualSalary25VPN);
            });

            $request->session()->put('anualSalaries', $anualSalaries);
            $request->session()->put('anualSalaries25', $anualSalaries25);
            $request->session()->put('anualSalary25VPN', $anualSalaries25VPN);
        }
    }

    public function calculateUtilities(Request $request)
    {
        $costs = $request->session()->get('realCosts');
        $entries = $request->session()->get('realEntries');
        $futureEntries = $request->session()->get('futureEntries');
        $utilities = collect([]);
        $futureUtilities = collect([]);

        for($i=0; $i <= 12; $i++)
        {
            $utility = new Utility();
                $utility->egress = $costs->where('period', $i)->sum('total');
                $utility->entries = $entries->where('period', $i)->sum('total');;
                $utility->utility = $utility->entries - $utility->egress;
                $utility->period = $i;

            $futureUtility = new Utility();
                $futureUtility->egress = $costs->where('period', $i)->sum('total');
                $futureUtility->entries = $futureEntries->where('period', $i)->sum('total');;
                $futureUtility->utility = $futureUtility->entries - $futureUtility->egress;
                $futureUtility->period = $i;
            
            $utilities->push($utility);
            $futureUtilities->push($futureUtility);

            $request->session()->put('utilities', $utilities);
            $request->session()->put('futureUtilities', $futureUtilities);
        }
    }

    public function calculateVPN(Request $request)
    {
        $discountRate = UafParameter::where('nameParameter', 'TasaDescuento')->first();
        $discountRate = $discountRate->valueParameter/100;
        $utilities = $request->session()->get('utilities');
        $add = 0;
        
        $VPN = 0;

        $utilities->each(function($item, $key) use(&$VPN, $discountRate, &$add){
            if($key > 0)
            {
                $VPN = $VPN + ($item->utility)/pow((1+$discountRate),($key));
            }
            else
            {
                $add = $item->utility;
            }  
        });

        $VPN = $VPN + $add;

        return $VPN;
    }

    public function calculateTIR(Request $request, $guess = 0.1)
    {
        $utilities = $request->session()->get('utilities');
        $x1 = 0;
        $x2 = $guess;
        $f1 = 0;
        $f2 = 0;
        $f = 0;
        $rtb = 0;
        $dx = 0;

        $utilities->each(function($item, $key) use($x1, &$f1){
            $f1 = $f1 + ($item->utility)/pow((1+$x1),($key));
        });

        $utilities->each(function($item, $key) use($x2, &$f2){
            $f2 = $f2 + ($item->utility)/pow((1+$x2),($key));
        });

        for($i=0; $i<128; ++$i)
        {
            if (($f1 * $f2) < 0.0) 
            {
                break;
            }

            if (abs($f1) < abs($f2)) 
            {
                $x1 += 1.6 * ($x1 - $x2);
                    $utilities->each(function($item, $key) use($x1, &$f1){
                        $f1 = $f1 + ($item->utility)/pow((1+$x1),($key));
                    });
            } 
            else 
            {
                $x2 += 1.6 * ($x2 - $x1);
                $utilities->each(function($item, $key) use($x2, &$f2){
                    $f2 = $f2 + ($item->utility)/pow((1+$x2),($key));
                });
            }
        }

        $utilities->each(function($item, $key) use($x1, &$f){
            $f = $f + ($item->utility)/pow((1+$x1),($key));
        });

        if ($f < 0.0) 
        {
            $rtb = $x1;
            $dx = $x2 - $x1;
        } 
        else 
        {
            $rtb = $x2;
            $dx = $x1 - $x2;
        }

        for ($i = 0; $i < 128; ++$i) 
        {
            $dx *= 0.5;
            $x_mid = $rtb + $dx;
            $f_mid = 0;
            
            $utilities->each(function($item, $key) use($x_mid, &$f_mid){
                $f_mid = $f_mid + ($item->utility)/pow((1+$x_mid),($key));
            });            

            if ($f_mid <= 0.0) 
            {
                $rtb = $x_mid;
            }

            if ((abs($f_mid) < 1.0e-08) || (abs($dx) < 1.0e-08)) 
            {
                return $x_mid * 100;
            }
        }
    }

    public function calculateIPA(Request $request)
    {
        $discountRate = UafParameter::where('nameParameter', 'TasaDescuento')->first();
        $discountRate = $discountRate->valueParameter/100;

        $anualSalaries25 = $request->session()->get('anualSalaries25');

        $IPA;

        $anualSalaries25->each(function($item, $key) use(&$IPA, $discountRate){
                $IPA = $IPA + ($item)/pow((1+$discountRate),($key+1));    
        });
        return $IPA;
    }

    public function calculateUNPA(Request $request)
    {
        $discountRate = UafParameter::where('nameParameter', 'TasaDescuento')->first();
        $discountRate = $discountRate->valueParameter/100;
        $utilities = $request->session()->get('utilities');
        
        $UNPA = 0;

        $utilities->each(function($item, $key) use(&$UNPA, $discountRate){
            if($key > 0)
            {
                $UNPA = $UNPA + ($item->utility)/pow((1+$discountRate),($key));
            }      
        });

        return $UNPA;
    }

    public function calculateUNPAMax(Request $request)
    {
        $discountRate = UafParameter::where('nameParameter', 'TasaDescuento')->first();
        $discountRate = $discountRate->valueParameter/100;
        $futureUtilities = $request->session()->get('futureUtilities');
        
        $UNPA = 0;

        $futureUtilities->each(function($item, $key) use(&$UNPA, $discountRate){
            if($key > 0)
            {
                $UNPA = $UNPA + ($item->utility)/pow((1+$discountRate),($key));
            }      
        });

        return $UNPA;
    }





    ////////////////////////////Auxiliars////////////////////////////////
    private function calculateUnitaryCost($initialCost, $period)
    {
        $inflation = UafParameter::where('showParameter', 'Inflacion')->first();
        $inflation = 1 + ($inflation->valueParameter/100);
        $unitaryCost = $initialCost;

        for($i = 1; $i < $period; $i++)
        {
            $unitaryCost*=$inflation;
        }

        return $unitaryCost;
    }

    private function calculateUnitaryEntry($initialEntry, $period)
    {
        $inflation = UafParameter::where('showParameter', 'Inflacion')->first();
        $inflation = 1 + ($inflation->valueParameter/100);
        $unitaryEntry = $initialEntry;

        for($i = 1; $i < $period; $i++)
        {
            $unitaryEntry*=$inflation;
        }

        return $unitaryEntry;
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

    public function createUpdateIndicator(Request $request, $name = "", $value = "")
    {
        $indicatorList = "";
        if(!$request->session()->has('indicators'))
        {
            $list = json_decode(Storage::disk('public')->get('indicatorsSystems.json'));
            $indicatorList = Collection::wrap($list);
            $indicators = collect([]);

            $indicatorList->each(function($item, $key) use($indicators, $request){
                $newIndicator = new SystemIndicator();
                    $newIndicator->nameIndicator = $item->name;
                    $newIndicator->showIndicator = $item->show;
                    $newIndicator->valueIndicator = $item->value;
        
                    $indicators->push($newIndicator);
                    $request->session()->put('indicators',$indicators);
            });
        }
        else
        {
            $indicators = $request->session()->get('indicators');

            $indicators->each(function($item, $key) use($name, $value){
                if($item->nameIndicator == $name)
                {
                    $item->valueIndicator = $value;
                }
            });

            $request->session()->put('indicators',$indicators);
        }
    }

    public function forgetSession($request)
    {
        $request->session()->forget('costs');
        $request->session()->forget('entries');
        $request->session()->forget('realCosts');
        $request->session()->forget('realEntries');
        $request->session()->forget('utilities');
        $request->session()->forget('anualSalaries');
        $request->session()->forget('anualSalaries25');
        $request->session()->forget('anualSalary25VPN');
        $request->session()->forget('indicators');
    }

    public function loadCost(Request $request, $system)
    {
        $costs = $system->Costs()->get();
        $partialCosts = $costs->groupBy('detail');
        $partialCosts->forget('Crédito');
        $index = 0;

        $partialCosts->each(function($item, $key) use(&$cost, &$index, &$costs, &$request) {

            $cost = new CostVirtual();

            if($request->session()->has('costs'))
            {
                $costs = $request->session()->get('costs');
            }
            else
            {
                $costs = collect([]);
            }
            
            $item->each(function($item, $key) use($index, &$cost){
                
                $quantity = 'quantity'.$key;

                if($key == 0)
                {
                    $cost->id = $index;
                    $cost->detail = $item->detail;
                    $cost->group = $item->group;
                    $cost->subGroup = $item->subGroup;
                    $cost->unitaryCost = $item->unitaryCost;
                }

                $cost->$quantity = $item->quantity;
            });

            $index++;
            $costs->push($cost);  
            $request->session()->put('costs', $costs);
            // dd($request->session()->get('costs'));
        });

        return $costs;
    }

    public function validateCost($newCost)
    {
        $input = $newCost->toArray();

        $rules = [
            'detail' => 'required|min:6|max:40',
            'group' => 'required', 
            'subGroup' => 'required', 
            'unitaryCost' => 'numeric|max:999999999', 
            'quantity0' => 'numeric|max:999999999', 
            'quantity1' => 'numeric|max:999999999', 
            'quantity2' => 'numeric|max:999999999', 
            'quantity3' => 'numeric|max:999999999', 
            'quantity4' => 'numeric|max:999999999', 
            'quantity5' => 'numeric|max:999999999', 
            'quantity6' => 'numeric|max:999999999', 
            'quantity7' => 'numeric|max:999999999', 
            'quantity8' => 'numeric|max:999999999', 
            'quantity9' => 'numeric|max:999999999', 
            'quantity10' => 'numeric|max:999999999', 
            'quantity11' => 'numeric|max:999999999', 
            'quantity12' => 'numeric|max:999999999', 

          ];

        $messages = [
            'required' => 'Campo Obligatorio',
            'numeric' => 'Campo Numérico',
            'max'=>[
                    'string' => 'El campo debe tener máximo 40 caracteres',
                    'numeric' => 'Excede el valor permitido'
            ],
            'min'=>[
                    'string' => 'El campo debe tener mínimo 6 caracteres'
            ]
        ];

        return Validator::make($input, $rules, $messages);

    }



    






















    public function saveCost(Request $request)
    {
        if($request->session()->has('costs'))
        {
            $costs = $request->session()->get('costs');
        }
        else
        {
            $costs = collect([]);
        }

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
              $costs->push($cost);
        }        

        $request->session()->put('costs', $costs);
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



    public function showEntries2($token)
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
