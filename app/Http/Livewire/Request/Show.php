<?php

namespace App\Http\Livewire\Request;

use App\Models\Request;
use Livewire\Component;

class Show extends Component
{
    public $request;
    public function render()
    {        
        $data = Request::findOrFail($this->request);
        $barang_bukti = Request::findOrFail($this->request)->evidence_lists;        
        $files = [
            ['name' => 'Surat Permohonan', 'link' => $data->berkas_surat_permohonan],
            ['name' => 'Laporan Polisi', 'link' => $data->berkas_laporan_polisi],
            ['name' => 'Surat Perintah Penyitaan/Penggeledahan', 'link' => $data->berkas_sp_pp],
            ['name' => 'Berita Acara Penyitaan/Penggeledahan', 'link' => $data->berkas_berita_acara],
            ['name' => 'Surat Tanda Penerimaan', 'link' => $data->berkas_surat_penerimaan],
            ['name' => 'Surat Perintah Penyidikan', 'link' => $data->berkas_sp_penyidikan],
            ['name' => 'Surat Perintah Dimulainya Penyidikan (SPDP)', 'link' => $data->berkas_spdp],
            ['name' => 'Resume', 'link' => $data->berkas_resume]
        ];
        return view('livewire.request.show', compact(['data', 'files', 'barang_bukti']));
    }

    public function download($file, $name)
    {
        $path = storage_path('app/berkas/' . $file);
        $extension = pathinfo($path, PATHINFO_EXTENSION);        
        return response()->download($path, $name . '.' . $extension);
    }
}
