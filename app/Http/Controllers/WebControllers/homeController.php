<?php

namespace App\Http\Controllers\WebControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class homeController extends Controller
{

    public function getHome()
    {
        return view('web.home');
    }
}
