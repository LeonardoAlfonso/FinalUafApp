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
            'password' => array('required', 
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ])/',
                    'between:8,15')
          ];
            

          $messages = [
            'required' => 'Campo Obligatorio',
            'email' => 'Correo Incorrecto',
            'same' => 'Las contraseñas no coinciden',
            'min' => 'El campo debe contener mínimo 6 caracteres',
            'max' => 'El campo debe contener máximo 40 caracteres',
            'between' => 'La contraseña debe contener entre 8 y 15 dígitos',
            'regex' => 'La contraseña debe contener al menos una Mayúscula, una minuscúla, 1 digito y un caractér especial'
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
                  $userDepartament = UserDepartament::where('idUser', $request->idUser)->delete();
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

    public function createUserView(Request $request, $validations = "")
    {
        $user = new User;  
            $user->idUser = $request->idUser;
            $user->firstName = $request->firstName;
            $user->lastName = $request->lastName;
            $user->email = $request->email;
            $user->role = $request->role;

        $option = empty($request->idUser) ? 'newUser' : 'editUser';

        $roles = array('admin','expert','cartographer');

        $departaments = Departament::all();
        $index = 1;

            foreach ($departaments as $departament)
            {
                $inputRequest = "Departament".$index;

                if(empty($request->$inputRequest))
                {
                    $departament->setIscheckAttribute(false);
                }
                else
                {
                    $departament->setIscheckAttribute(true);
                }

                $index++;
            }

        $departaments = $departaments->chunk(3);

        return view('app.admin')
                  ->with('user', $user)
                  ->with('option',$option)
                  ->with('roles', $roles)
                  ->with('departaments', $departaments)
                  ->withErrors($validations);
    }
}
