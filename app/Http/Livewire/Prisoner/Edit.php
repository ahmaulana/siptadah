<?php

namespace App\Http\Livewire\Prisoner;

use App\Models\Prisoner;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{

    public $request;

    public $suratPermohonan, $laporanPolisi, $beritaAcara, $penetapanPenahananPenyidik, $penetapanPerpanjanganPenahanan, $spPenyidikan, $spdp, $resume;

    public $file_surat_permohonan, $file_laporan_polisi, $file_berita_acara, $file_penetapan_penahanan_penyidik, $file_penetapan_perpanjangan_penahanan, $file_sp_penyidikan, $file_spdp, $file_resume;

    public $nama_pemohon, $no_hp, $no_surat, $tgl_surat, $nama_tersangka, $tempat_lahir, $tgl_lahir, $jenis_kelamin, $alamat, $agama, $pekerjaan, $berkas_surat_permohonan, $berkas_laporan_polisi, $berkas_sp_penyidikan, $berkas_spdp, $berkas_penetapan_penahanan_penyidik, $berkas_penetapan_perpanjangan_penahanan, $berkas_berita_acara, $berkas_resume;

    use WithFileUploads;

    protected $rules = [
        'nama_pemohon' => 'required',
        'no_hp' => 'required|min:9|max:13',
        'no_surat' => 'required',
        'tgl_surat' => 'required|date',
        'nama_tersangka' => 'required',
        'tempat_lahir' => 'required',
        'tgl_lahir' => 'required|date',
        'jenis_kelamin' => 'required',
        'agama' => 'required',
        'pekerjaan' => 'required',
        'alamat' => 'required',
        'berkas_surat_permohonan' => 'nullable|mimes:docx,pdf,doc|max:2048',
        'berkas_laporan_polisi' => 'nullable|mimes:docx,pdf,doc|max:2048',
        'berkas_sp_penyidikan' => 'nullable|mimes:docx,pdf,doc|max:2048',
        'berkas_spdp' => 'nullable|mimes:docx,pdf,doc|max:2048',
        'berkas_penetapan_penahanan_penyidik' => 'nullable|mimes:docx,pdf,doc|max:2048',
        'berkas_penetapan_perpanjangan_penahanan' => 'nullable|mimes:docx,pdf,doc|max:2048',
        'berkas_berita_acara' => 'nullable|mimes:docx,pdf,doc|max:2048',
        'berkas_resume' => 'nullable|mimes:docx,pdf,doc|max:2048',
    ];

    protected $messages = [
        'nama_pemohon.required' => ':attribute tidak boleh kosong!',        
        'no_hp.required' => ':attribute tidak boleh kosong!',
        'no_hp.min' => ':attribute tidak valid!',
        'no_hp.max' => ':attribute tidak valid!',
        'no_surat.required' => ':attribute tidak boleh kosong!',
        'tgl_surat.required' => 'Tanggal tidak boleh kosong!',
        'nama_tersangka.required' => ':attribute tidak boleh kosong!',
        'tempat_lahir.required' => ':attribute tidak boleh kosong!',
        'tgl_lahir.required' => 'Tanggal tidak boleh kosong!',
        'jenis_kelamin.required' => ':attribute tidak boleh kosong!',
        'agama.required' => ':attribute tidak boleh kosong!',
        'pekerjaan.required' => ':attribute tidak boleh kosong!',
        'alamat.required' => ':attribute tidak boleh kosong!',
        'berkas_surat_permohonan.required' => ':attribute tidak boleh kosong!',
        'berkas_surat_permohonan.mimes' => 'format file tidak valid! hanya mendukung format (.docx, .doc, .pdf)',
        'berkas_surat_permohonan.max' => 'file terlalu besar! maksimal 2MB',
        'berkas_laporan_polisi.required' => ':attribute tidak boleh kosong!',
        'berkas_laporan_polisi.mimes' => 'format file tidak valid! hanya mendukung format (.docx, .doc, .pdf)',
        'berkas_laporan_polisi.max' => 'file terlalu besar! maksimal 2MB',
        'berkas_sp_penyidikan.required' => ':attribute tidak boleh kosong!',
        'berkas_sp_penyidikan.mimes' => 'format file tidak valid! hanya mendukung format (.docx, .doc, .pdf)',
        'berkas_sp_penyidikan.max' => 'file terlalu besar! maksimal 2MB',
        'berkas_spdp.required' => ':attribute tidak boleh kosong!',
        'berkas_spdp.mimes' => 'format file tidak valid! hanya mendukung format (.docx, .doc, .pdf)',
        'berkas_spdp.max' => 'file terlalu besar! maksimal 2MB',
        'berkas_penetapan_penahanan_penyidik.required' => ':attribute tidak boleh kosong!',
        'berkas_penetapan_penahanan_penyidik.mimes' => 'format file tidak valid! hanya mendukung format (.docx, .doc, .pdf)',
        'berkas_penetapan_penahanan_penyidik.max' => 'file terlalu besar! maksimal 2MB',
        'berkas_penetapan_perpanjangan_penahanan.required' => ':attribute tidak boleh kosong!',
        'berkas_penetapan_perpanjangan_penahanan.mimes' => 'format file tidak valid! hanya mendukung format (.docx, .doc, .pdf)',
        'berkas_penetapan_perpanjangan_penahanan.max' => 'file terlalu besar! maksimal 2MB',
        'berkas_berita_acara.required' => ':attribute tidak boleh kosong!',
        'berkas_berita_acara.mimes' => 'format file tidak valid! hanya mendukung format (.docx, .doc, .pdf)',
        'berkas_berita_acara.max' => 'file terlalu besar! maksimal 2MB',
        'berkas_resume.required' => ':attribute tidak boleh kosong!',
        'berkas_resume.mimes' => 'format file tidak valid! hanya mendukung format (.docx, .doc, .pdf)',
        'berkas_resume.max' => 'file terlalu besar! maksimal 2MB',
        'pasal.required' => ':attribute tidak boleh kosong!',
        'barang_bukti.*.required' => 'Barang bukti tidak boleh kosong!',
        'sumber.required' => ':attribute tidak boleh kosong!',
    ];

    public function mount()
    {
        $this->user_id = $this->request->user_id;
        $this->nama_pemohon = $this->request->nama_pemohon;
        $this->no_hp = $this->request->no_hp;
        $this->asal_instansi = $this->request->asal_instansi;        
        $this->no_surat = $this->request->no_surat;
        $this->tgl_surat = date('Y-m-d', strtotime($this->request->tgl_surat));        
        $this->nama_tersangka = $this->request->nama_tersangka;
        $this->tempat_lahir = $this->request->tempat_lahir;
        $this->tgl_lahir = date('Y-m-d', strtotime($this->request->tgl_lahir));
        $this->jenis_kelamin = $this->request->jenis_kelamin;
        $this->agama = $this->request->agama;
        $this->pekerjaan = $this->request->pekerjaan;        
        $this->alamat = $this->request->alamat;

        $this->file_surat_permohonan = ['name' => 'Surat Permohonan', 'link' => $this->request->berkas_surat_permohonan];
        $this->file_laporan_polisi = ['name' => 'Laporan Polisi', 'link' => $this->request->berkas_laporan_polisi];
        $this->file_berita_acara = ['name' => 'Berita Acara', 'link' => $this->request->berkas_berita_acara];
        $this->file_penetapan_penahanan_penyidik = ['name' => 'Penetapan Penahanan Penyidik', 'link' => $this->request->berkas_penetapan_penahanan_penyidik];
        $this->file_penetapan_perpanjangan_penahanan = ['name' => 'Penetapan Perpanjangan Penahanan', 'link' => $this->request->berkas_penetapan_perpanjangan_penahanan];        
        $this->file_sp_penyidikan = ['name' => 'Surat Perintah Penyidikan', 'link' => $this->request->berkas_sp_penyidikan];
        $this->file_spdp = ['name' => 'Surat Perintah Dimulainya Penyidikan (SPDP)', 'link' => $this->request->berkas_spdp];
        $this->file_resume = ['name' => 'Resume', 'link' => $this->request->berkas_resume];        

        $this->suratPermohonan = (isset($this->request->berkas_surat_permohonan)) ? true : false;
        $this->laporanPolisi = (isset($this->request->berkas_laporan_polisi)) ? true : false;
        $this->beritaAcara = (isset($this->request->berkas_berita_acara)) ? true : false;
        $this->penetapanPenahananPenyidik = (isset($this->request->berkas_penetapan_penahanan_penyidik)) ? true : false;
        $this->penetapanPerpanjanganPenahanan = (isset($this->request->berkas_penetapan_perpanjangan_penahanan)) ? true : false;        
        $this->spPenyidikan = (isset($this->request->berkas_sp_penyidikan)) ? true : false;
        $this->spdp = (isset($this->request->berkas_spdp)) ? true : false;
        $this->resume = (isset($this->request->berkas_resume)) ? true : false;
    }

    public function render()
    {
        return view('livewire.prisoner.edit');
    }

    public function update()
    {
        if (auth()->user()->cannot('Edit Tahanan')) {
            abort(403);
        }

        $request = $this->validate();
        DB::transaction(function () use ($request) {
            $update = Prisoner::findOrFail($this->request->id);            
            $update->nama_pemohon = $request['nama_pemohon'];
            $update->no_hp = $request['no_hp'];
            $update->no_surat = $request['no_surat'];
            $update->tgl_surat = $request['tgl_surat'];                        
            $update->nama_tersangka = $request['nama_tersangka'];
            $update->tempat_lahir = $request['tempat_lahir'];
            $update->tgl_lahir = $request['tgl_lahir'];
            $update->jenis_kelamin = $request['jenis_kelamin'];
            $update->agama = $request['agama'];
            $update->pekerjaan = $request['pekerjaan'];            
            $update->alamat = $request['alamat'];

            //Simpan Berkas-Berkas
            if (isset($request['berkas_surat_permohonan'])) {
                $request['berkas_surat_permohonan']->store('berkas');
                $update->berkas_surat_permohonan = $request['berkas_surat_permohonan']->hashName();
            }

            if (isset($request['berkas_laporan_polisi'])) {
                $request['berkas_laporan_polisi']->store('berkas');
                $update->berkas_laporan_polisi = $request['berkas_laporan_polisi']->hashName();
            }            

            if (isset($request['berkas_berita_acara'])) {
                $request['berkas_berita_acara']->store('berkas');
                $update->berkas_berita_acara = $request['berkas_berita_acara']->hashName();
            }

            if (isset($request['berkas_penetapan_penahanan_penyidik'])) {
                $request['berkas_penetapan_penahanan_penyidik']->store('berkas');
                $update->berkas_penetapan_penahanan_penyidik = $request['berkas_penetapan_penahanan_penyidik']->hashName();
            }

            if (isset($request['berkas_penetapan_perpanjangan_penahanan'])) {
                $request['berkas_penetapan_perpanjangan_penahanan']->store('berkas');
                $update->berkas_penetapan_perpanjangan_penahanan = $request['berkas_penetapan_perpanjangan_penahanan']->hashName();
            }

            if (isset($request['berkas_sp_penyidikan'])) {
                $request['berkas_sp_penyidikan']->store('berkas');
                $update->berkas_sp_penyidikan = $request['berkas_sp_penyidikan']->hashName();
            }

            if (isset($request['berkas_spdp'])) {
                $request['berkas_spdp']->store('berkas');
                $update->berkas_spdp = $request['berkas_spdp']->hashName();
            }

            if (isset($request['berkas_resume'])) {
                $request['berkas_resume']->store('berkas');
                $update->berkas_resume = $request['berkas_resume']->hashName();
            }

            $update->save();            

            session()->flash('flash.banner', 'Permohonan berhasil diperbarui!');
            session()->flash('flash.bannerStyle', 'success');
        });
        return redirect(route('tahanan.index'));
    }

    public function download($file, $name)
    {
        $path = storage_path('app/berkas/' . $file);
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        return response()->download($path, $name . '.' . $extension);
    }
}
