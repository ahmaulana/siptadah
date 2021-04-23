<?php

namespace App\Http\Controllers;

use App\Models\Prisoner;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
{    
    public $pagetitle;

    public function __construct($pagetitle='Dashboard')
    {
        $this->pagetitle = $pagetitle;        
    }

    public function index()
    {
        if (auth()->user()->cannot('Kelola Dashboard')) {
            abort(403);
        }
        //Siptadah
        $siptadah_new = ModelsRequest::where('status', '0')->count();        
        $siptadah_processed = ModelsRequest::where('status', '1')->orWhere('status','2')->count();
        $siptadah_rejected = ModelsRequest::where('status', '3')->count();
        $siptadah_done = ModelsRequest::where('status', '4')->count();

        //Prisoner
        $prisoner_new = Prisoner::where('status', '0')->count();
        $prisoner_processed = Prisoner::where('status', '1')->orWhere('status','2')->count();
        $prisoner_rejected = Prisoner::where('status', '3')->count();
        $prisoner_done = Prisoner::where('status', '4')->count();

        $data['new'][0] = $siptadah_new;
        $data['new'][1] = $prisoner_new;
        $data['processed'][0] = $siptadah_processed;
        $data['processed'][1] = $prisoner_processed;
        $data['done'][0] = $siptadah_done;
        $data['done'][1] = $prisoner_done;
        $data['rejected'][0] = $siptadah_rejected;
        $data['rejected'][1] = $prisoner_rejected;        

        return view('dashboard', compact(['data']));
    }
}
