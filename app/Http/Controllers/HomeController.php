<?php

namespace App\Http\Controllers;

use App\Models\Prisoner;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
{    
    public function index()
    {
        if (auth()->user()->cannot('Dashboard')) {
            abort(403);
        }
        //Siptadah
        $siptadah_new = ModelsRequest::where('status', 'menunggu')->count();
        $siptadah_processed = ModelsRequest::where('status', 'sedang diproses')->count();
        $siptadah_done = ModelsRequest::where('status', 'selesai')->count();
        $siptadah_rejected = ModelsRequest::where('status', 'ditolak')->count();

        //Prisoner
        $prisoner_new = Prisoner::where('status', 'menunggu')->count();
        $prisoner_processed = Prisoner::where('status', 'sedang diproses')->count();
        $prisoner_done = Prisoner::where('status', 'selesai')->count();
        $prisoner_rejected = Prisoner::where('status', 'ditolak')->count();

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
