<?php

namespace App\Logic\CreationUser;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Logic\CreationUser\UserTools;
use App\Models\Departament;
use App\Models\UserDepartament;
use App\User;
use Validator;

class UserTools
{
    public function validationData(Request $request)
    {
          $input = $request->all();
          $rules = [
            'firstName' => 'required|max:20',
            'lastName' => 'required|max:20',
            'email' => 'required|email',
            'password' => 'required',
            'confirmPassword' => 'required|same:password',
            'role' => 'required',
          ];
          $messages = [
            'required' => 'Campo Obligatorio',
            'max' => 'El campo no puede superar los 20 caracteres',
            'email' => 'Correo Incorrecto',
            'same' => 'Las contraseñas no coinciden',
          ];

          return Validator::make($input, $rules, $messages);
    }

    public function createUser($request)
    {
          $user = new User();

            //Atributes
              $user->firstName = $request->firstName;
              $user->lastName = $request->lastName;
              $user->email = $request->email;
              $user->password = $request->password;
              $user->role = $request->role;
              $user->remember_token = str_random(10);

          $user->save();

          $departaments = Departament::all();

          foreach ($departaments as $departament)
          {
                $existsParameter = 'Departament'.$departament->idDepartament;

                if($request->has($existsParameter))
                {
                    $userDepartamentRelation = new UserDepartament();

                      //Atributes
                        $userDepartamentRelation->idDepartament = $departament->idDepartament;
                        $userDepartamentRelation->idUser = $user->idUser;

                    $userDepartamentRelation->save();
                }
          }
    }
}
