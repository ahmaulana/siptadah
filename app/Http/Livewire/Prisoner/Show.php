<?php

namespace App\Http\Livewire\Prisoner;

use App\Models\Notification;
use App\Models\Prisoner;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Show extends Component
{
    public $request;
    public $request_data;

    public function render()
    {        
        $this->request_data = Prisoner::findOrFail($this->request);
        $data = $this->request_data;
        if (auth()->user()->can('Verifikasi Permohonan')) {            
            if ($data->status == 'menunggu') {
                $data->status = 'sedang diproses';
                $data->save();
            }
        }
        
        $files = [
            ['name' => 'Surat Permohonan', 'link' => $data->berkas_surat_permohonan],
            ['name' => 'Laporan Polisi', 'link' => $data->berkas_laporan_polisi],
            ['name' => 'Surat Perintah Penyidikan', 'link' => $data->berkas_sp_penyidikan],
            ['name' => 'Surat Perintah Dimulainya Penyidikan (SPDP)', 'link' => $data->berkas_spdp],
            ['name' => 'Penetapan Penahanan Penyidik', 'link' => $data->berkas_penetapan_penahanan_penyidik],
            ['name' => 'Penetapan Perpanjangan Penahanan', 'link' => $data->berkas_penetapan_perpanjangan_penahanan],
            ['name' => 'Berita Acara Penyitaan/Penggeledahan', 'link' => $data->berkas_berita_acara],            
            ['name' => 'Resume', 'link' => $data->berkas_resume]
        ];
        return view('livewire.prisoner.show', compact(['data', 'files']));
    }

    public function download($file, $name)
    {
        $path = storage_path('app/berkas/' . $file);
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        return response()->download($path, $name . '.' . $extension);
    }

    public function verify($status)
    {        
        if (auth()->user()->cannot('Verifikasi Permohonan')) {
            abort(403);
        }

        $request_status = $this->request_data;
        DB::transaction(function () use ($status, $request_status) {
            if ($status == 'setuju') {
                $request_status->status = 'disetujui';
                $message = 'Permohonan nomor ' . $request_status->no_surat_permohonan . ' disetujui! Silahkan ambil dokumen ke kantor dengan membawa berkas-berkas dan e-ticket.';
            } else if ($status == 'selesai') {
                $request_status->status = 'selesai';
                $message = 'Permohonan ' . $request_status->no_surat_permohonan . ' selesai diproses!';
            } else {
                $request_status->status = 'ditolak';
                $message = 'Maaf, permohonan nomor ' . $request_status->no_surat_permohonan . ' ditolak, silahkan ajukan permohonan baru';
            }

            $notify = Notification::create([
                'user_id' => $this->request_data->user_id,
                'message' => $message,
            ]);
            $request_status->save();
        });

        session()->flash('flash.banner', 'Permohonan berhasil diperbarui!');
        session()->flash('flash.bannerStyle', 'success');
        return redirect(route('permohonan.index'));
    }
}
