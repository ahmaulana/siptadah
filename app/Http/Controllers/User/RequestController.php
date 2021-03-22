<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RequestController extends Controller
{
    public function index()
    {
        return view('user.request.index');
    }

    public function create()
    {
        return view('user.request.create');
    }

    public function show($id)
    {
        $request = ModelsRequest::findOrFail($id);
        $files = [
            ['name' => 'Surat Permohonan', 'link' => $request->berkas_surat_permohonan],
            ['name' => 'Laporan Polisi', 'link' => $request->berkas_laporan_polisi],
            ['name' => 'Surat Perintah Penyitaan/Penggeledahan', 'link' => $request->berkas_sp_pp],
            ['name' => 'Berita Acara Penyitaan/Penggeledahan', 'link' => $request->berkas_berita_acara],
            ['name' => 'Surat Tanda Penerimaan', 'link' => $request->berkas_surat_penerimaan],
            ['name' => 'Surat Perintah Penyidikan', 'link' => $request->berkas_sp_penyidikan],
            ['name' => 'Surat Perintah Dimulainya Penyidikan (SPDP)', 'link' => $request->berkas_spdp],
            ['name' => 'Resume', 'link' => $request->berkas_resume]
        ];
        return view('user.request.show', compact(['request', 'files']));
    }
}
