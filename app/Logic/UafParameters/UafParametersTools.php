<?php

namespace App\Logic\UafParameters;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Logic\UafParameters\UafParametersTools;
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

          $rules = array('0'=> '');

          for ($i=1; $i < count($input); $i++)
          {
              $j = $i -1;
              $unitaryArray = array($i => $this->uafParameters[$j]->rules);
              $rules = array_merge($rules, $unitaryArray);
          }

          $messages = [
            'required' => 'Campo Obligatorio',
            'numeric' => 'El campo debe ser numérico',
            'digits_between' => 'El campo es un porcentaje y debe estar entre 0 y 100'
          ];
          
          return Validator::make($input, $rules, $messages);
    }

    public function saveIndicators(Request $request)
    {
          $index = 1;

          dd($request);

          $parameters = UafParameter::all();

          foreach ($parameters as $parameter)
          {
              $parameter->valueParameter = $request->$index;
              $parameter->save();
              $index++;
          }
    }
}
