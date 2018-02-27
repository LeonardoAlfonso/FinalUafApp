<?php

namespace App\Http\Controllers\AppControllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Logic\CreationUser\UserTools;
use App\Logic\UafParameters\UafParametersTools;
use App\Models\Departament;
use App\Models\UafParameter;
use App\User;
use Validator;

class adminController extends Controller
{
    public function getListUsers()
    {
        $users = User::paginate(10);
        $option = 'listUser';
        $roles = array('admin','expert','cartographer');

        return view('app.admin')
                  ->with('users', $users)
                  ->with('option',$option);
    }

    public function getUser($id)
    {

        if($id == 'null')
        {
            $user = new User();
            $option = 'newUser';
        }
        else
        {
            $user = User::find($id);
            $option = 'editUser';
        }

          $roles = array('admin','expert','cartographer');
          $departaments = Departament::all();


        foreach ($departaments as $departament)
        {
              if(!is_null($departament->users->find($id)))
              {
                  $departament->setIscheckAttribute(true);
              }
              else
              {
                  $departament->setIscheckAttribute(false);
              }
        }

        $departaments = $departaments->chunk(3);

        return view('app.admin')
                  ->with('user', $user)
                  ->with('option',$option)
                  ->with('roles', $roles)
                  ->with('departaments', $departaments);
    }

    public function saveUser(Request $request)
    {
          $createUser = new UserTools();

          if(is_null($request->idUser))
          {
              $validations = $createUser->validationNewUser($request);
          }
          else
          {
              $validations = $createUser->validationEditUser($request);
          }

            if($validations->fails())
            {
                return redirect()->back()->withErrors($validations);
            }

          $createUser->createUser($request);

          return redirect()->route('admin');
    }

    public function deleteUser($idUser)
    {
        $createUser = new UserTools();
        $createUser->deleteUser($idUser);
        return redirect()->route('admin');
    }

    public function getEditIndicators()
    {
        $option = 'indicators';
        $parameters = UafParameter::all();
        return view('app.admin')
                    ->with('parameters', $parameters)
                    ->with('option',$option);
    }

    public function saveIndicators(Request $request)
    {

        $editParameters = new UafParametersTools();
        $validations = $editParameters->validationParameters($request);

        if($validations->fails())
        {
            return redirect()->back()->withErrors($validations);
        }

        $editParameters->saveIndicators($request);

        return redirect()->route('admin');
    }
}
