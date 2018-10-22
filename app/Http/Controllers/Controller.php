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

    public function dashboard(Request $request){

        $today = date('Y-m-d');
        $fecha_desde = date('Y-m-d', strtotime($today . ' - 30 days'));
        $fecha_hasta = $today;

        if($request->get('start_date'))
            $fecha_desde = $request->get('start_date');

        if($request->get('end_date'))
            $fecha_hasta = $request->get('end_date');


        $dashboard = array();
        return view('dashboard')->with('dashboard',$dashboard)->with('start_date',$fecha_desde)->with('end_date',$fecha_hasta);
    }
}
