<?php

namespace App\Http\Controllers\AppControllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Logic\CreationUser\UserTools;
use App\Logic\UafParameters\UafParametersTools;
use App\Models\Departament;
use App\Models\UafParameter;
use App\User;
use Session;
use Validator;

class adminController extends Controller
{
    public function getListUsers(Request $request, $searchWord = "")
    {
        $usersIndex = collect();
        $users = "";

        if(empty($searchWord))
        {
            $users = User::paginate(10);
        }
        else
        {
            $allUsers = User::all();
            foreach($allUsers as $user)
            {
                // dd($user->full_name);
                if(strpos($user->full_name, $searchWord) !== false)
                {
                    $usersIndex->prepend($user->idUser);
                }
            }
            
            $users = User::whereIn('idUser',$usersIndex)->paginate(10);
        }

        $option = 'listUser';

        $roles = array('admin','expert','cartographer');

        if($request->ajax())
        {
            $view = view('app.partials.admin.tableUsers')
                    ->with('users', $users);
            return response()->json(["html"=>$view->render()]);
        }
        else
        {
            $view = view('app.admin')
                        ->with('users', $users)
                        ->with('option',$option);
            return $view;
        }
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
                return $createUser->createUserView($request, $validations);
            }
            else
            {
                $createUser->createUser($request);

                Session::flash('Message','Usuario Guardado');
      
                return redirect()->route('admin');
            }
    }

    public function deleteUser($idUser)
    {
        $createUser = new UserTools();
        $createUser->deleteUser($idUser);
        return redirect()->route('admin');
    }

    public function getEditIndicators(Request $request, $validations = "")
    {
        $option = 'indicators';
        
        if(!empty($request->all()))
        {
            $parameters = UafParameter::all();
            $index = 1;

                foreach ($parameters as $parameter)
                {
                    $parameter->valueParameter = $request->$index;
                    $index++;
                }
        }
        else
        {
            $parameters = UafParameter::all();
        }

        $view = view('app.admin')
                    ->with('parameters', $parameters)
                    ->with('option',$option)
                    ->withErrors($validations);
        return $view;
    }

    public function saveIndicators(Request $request)
    {
        $editParameters = new UafParametersTools();
        $validations = $editParameters->validationParameters($request);

        if($validations->fails())
        {
            return $this->getEditIndicators($request, $validations);
        }
        else
        {
            $editParameters->saveIndicators($request);

            Session::flash('Message','Indicadores Actualizados');
    
            return redirect()->route('admin');
        }
    }
}
