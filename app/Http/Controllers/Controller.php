<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $crumbCollection;

    public function showCrumb(Request $request)
    {
        $this->crumbCollection = collect([]);
        $data = $request->all();

        if($request->has('Departament'))
        {
            $departamentCrumb = $request->Departament;
            $this->crumbCollection->put('Departament',$departamentCrumb);
        }

        if($request->has('Zone'))
        {
            $zoneCrumb = $request->Zone;
            $this->crumbCollection->put('Zone', $zoneCrumb);
        }

        if($request->has('ListSystem'))
        {
            $listSystemCrumb = $request->ListSystem;
            $this->crumbCollection->put('ListSystem', $listSystemCrumb);
        }

        if($request->has('System'))
        {
            $systemCrumb = $request->System;
            $this->crumbCollection->put('System', $systemCrumb);
        }

        return $this->crumbCollection;
    }

}
