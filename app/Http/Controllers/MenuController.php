<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function project()
    {
        return view('menu.project');
    }
    
    public function scm()
    {
        if(auth()->user()->type !== 0){
            if(auth()->user()->department_id !== 6){return abort(404);}
            else{return view('menu.scm');}
        }else{return view('menu.scm');}
    }

    public function hrd()
    {
        if(auth()->user()->type !== 0){
            if(auth()->user()->department_id !== 4){return abort(404);}
            else{return view('menu.hrd');}
        }else{return view('menu.hrd');}
    }
    
    public function gait()
    {
        if(auth()->user()->type !== 0){
            if(auth()->user()->department_id !== 3){return abort(404);}
            else{return view('menu.gait');}
        }else{return view('menu.gait');}
    }

    public function application()
    {
        if(auth()->user()->type === 0){return view('menu.application');}
        else{return abort(404);}
    }
}
