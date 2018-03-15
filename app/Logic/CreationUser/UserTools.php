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
    public function validationNewUser(Request $request)
    {
          $input = $request->all();
          $rules = [
            'firstName' => 'required|min:6|max:40',
            'lastName' => 'required|min:6|max:40',
            'email' => 'required|email',
            'password' => 'required',
            'confirmPassword' => 'required|same:password',
            'role' => 'required',
          ];
          $messages = [
            'required' => 'Campo Obligatorio',
            'email' => 'Correo Incorrecto',
            'same' => 'Las contraseñas no coinciden',
            'min' => 'El campo debe contener mínimo 6 caracteres',
            'max' => 'El campo debe contener máximo 40 caracteres',
          ];

          return Validator::make($input, $rules, $messages);
    }

    public function validationEditUser(Request $request)
    {
          $input = $request->all();
          $rules = [
            'firstName' => 'required|min:6|max:40',
            'lastName' => 'required|min:6|max:40',
            'email' => 'required|email',
            'role' => 'required',
          ];
          $messages = [
            'required' => 'Campo Obligatorio',
            'email' => 'Correo Incorrecto',
            'min' => 'El campo debe contener mínimo 6 caracteres',
            'max' => 'El campo debe contener máximo 40 caracteres',
          ];

          return Validator::make($input, $rules, $messages);
    }

    public function createUser(Request $request)
    {
            //Atributes
              if(!is_null($request->idUser))
              {
                  $user = User::find($request->idUser);
              }
              else
              {
                  $user = new User();
                    $user->password = $request->password;
              }

              $user->firstName = $request->firstName;
              $user->lastName = $request->lastName;
              $user->email = $request->email;
              $user->role = $request->role;

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

    public function deleteUser($idUser)
    {
        $user = User::find($idUser);
        $usersDepartaments = UserDepartament::where('idUser',$idUser)->get();
        // dd($usersDepartaments);

        foreach ($usersDepartaments as $userDepartament)
        {
            // dd($userDepartament);
            $userDepartament->where('idUser',$idUser)->delete();
        }

        $user->delete();
    }
}
