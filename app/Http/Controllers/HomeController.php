<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        if (Auth::id()){
            if (Auth::user()->role == "administrateur"){
                return redirect()->route("admin.dashboard");
            }else if(Auth::user()->role=="chef_filliere"){
                return redirect()->route("chef-filiere.dashboard");
            }else if(Auth::user()->role==="fourmateur"){
                return redirect()->route("fourmateur.dashboard");
            }
        }
    }
}
