<?php

namespace App\Logic\UafParameters;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Logic\UafParameters\UafParametersTools;
use App\Rules\Percentage;
use App\Models\Departament;
use App\Models\UserDepartament;
use App\Models\UafParameter;
use App\User;
use Validator;

class UafParametersTools
{
    protected $uafParameters = "";

    public function __construct()
    {
        $this->uafParameters = json_decode(Storage::disk('public')->get('uafParameters.json'));
    }

    public function validationParameters(Request $request)
    {
          $input = $request->all();
          $currentNewRules = array();
          $rules = array('0'=> '');

          for ($i=1; $i < count($input); $i++)
          {
              $j = $i -1;
              $objectRule = explode('|', $this->uafParameters[$j]->rules);

                foreach($objectRule as $currentRule)
                {
                    if($currentRule == 'Percentage')
                    {
                        $newRule = array(new Percentage);
                    }
                    else
                    {
                        $newRule = array($currentRule);
                    } 
                    
                    $currentNewRules = array_merge($currentNewRules, $newRule);
                }

                $rules = array_merge($rules, array($i => $currentNewRules));
                $currentNewRules = array();
          }

          $messages = [
            'required' => 'Campo Obligatorio',
            'numeric' => 'El campo debe ser numérico',
            'max' => 'No puede escribir más de 20 dígitos',
          ];
          
          return Validator::make($input, $rules, $messages);
    }

    public function saveIndicators(Request $request)
    {
          $index = 1;

          $parameters = UafParameter::all();

          foreach ($parameters as $parameter)
          {
              $parameter->valueParameter = $request->$index;
              $parameter->save();
              $index++;
          }
    }
}
