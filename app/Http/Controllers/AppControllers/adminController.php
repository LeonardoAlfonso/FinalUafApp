<?php

namespace App\Http\Controllers\AppControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class adminController extends Controller
{
    public function getAdminView()
    {
        return view('app.admin');
    }
}
