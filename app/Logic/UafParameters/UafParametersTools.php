<?php

namespace App\Logic\UafParameters;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Logic\UafParameters\UafParametersTools;
use App\Models\Departament;
use App\Models\UserDepartament;
use App\Models\UafParameter;
use App\User;
use Validator;

class UafParametersTools
{
    public function validationParameters(Request $request)
    {
          $input = $request->all();

          $rules = array('0'=> '');

          for ($i=1; $i < count($input); $i++)
          {
              $unitaryArray = array($i => 'required|numeric');
              $rules = array_merge($rules, $unitaryArray);
          }

          $messages = [
            'required' => 'Campo Obligatorio',
            'numeric' => 'El campo debe ser numérico',
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
