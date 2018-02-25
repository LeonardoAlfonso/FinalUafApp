<?php

namespace App\Http\Controllers\AppControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class adminController extends Controller
{
    public function getListUsers()
    {
        $users = User::paginate(10);

        return view('app.admin')
                  ->with('users', $users);
    }
}
