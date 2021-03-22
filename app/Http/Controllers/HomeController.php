<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if(auth()->user()->role_id == 1){
            return redirect('admin/dashboard');
        }

        if(auth()->user()->role_id == 2){
            return redirect('user/dashboard');
        }
    }
}
