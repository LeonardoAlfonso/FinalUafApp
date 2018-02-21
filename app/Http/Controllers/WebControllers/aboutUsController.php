<?php

namespace App\Http\Controllers\WebControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ModelViews\aboutUs;

class aboutUsController extends Controller
{
    public function getAboutUs()
    {
        $viewOption = 0;
        return view('web.aboutUs')->with('options',$viewOption);
    }

    public function getUAF()
    {
        $viewOption = 1;
        return view('web.aboutUs')->with('options',$viewOption);
    }

    public function getUAFIntegral()
    {
        $viewOption = 2;
        return view('web.aboutUs')->with('options',$viewOption);
    }

    public function getUnity()
    {
        $viewOption = 3;
        return view('web.aboutUs')->with('options',$viewOption);
    }

}
