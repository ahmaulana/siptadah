<?php

namespace App\Http\Livewire;

use App\Models\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class RequestForm extends Component
{
    use WithFileUploads;

    public $suratPermohonan, $laporanPolisi, $sppp, $beritaAcara, $suratPenerimaan, $spPenyidikan, $spdp, $resume;

    public $asal_instansi, $email, $no_hp, $no_surat_permohonan, $tgl_surat_permohonan, $jenis_permohonan, $penyitaan_penggeledahan, $berkas_surat_permohonan, $berkas_laporan_polisi, $berkas_sp_pp, $berkas_berita_acara, $berkas_surat_penerimaan, $berkas_sp_penyidikan, $berkas_spdp, $berkas_resume, $pasal, $barang_bukti, $sumber, $nama_tersangka, $tempat_lahir, $tgl_lahir, $alamat;

    protected $rules = [
        'asal_instansi' => 'required',
        'email' => 'required|email',
        'no_hp' => 'required|min:9|max:13',
        'no_surat_permohonan' => 'required',
        'tgl_surat_permohonan' => 'required|date',
        'jenis_permohonan' => 'required',
        'penyitaan_penggeledahan' => 'required',
        'berkas_surat_permohonan' => 'nullable|mimes:docx,pdf,doc|max:2048',
        'berkas_laporan_polisi' => 'nullable|mimes:docx,pdf,doc|max:2048',
        'berkas_sp_pp' => 'nullable|mimes:docx,pdf,doc|max:2048',
        'berkas_berita_acara' => 'nullable|mimes:docx,pdf,doc|max:2048',
        'berkas_surat_penerimaan' => 'nullable|mimes:docx,pdf,doc|max:2048',
        'berkas_sp_penyidikan' => 'nullable|mimes:docx,pdf,doc|max:2048',
        'berkas_spdp' => 'nullable|mimes:docx,pdf,doc|max:2048',
        'berkas_resume' => 'nullable|mimes:docx,pdf,doc|max:2048',
        'pasal' => 'required',
        'barang_bukti' => 'required',
        'sumber' => 'required',
        'nama_tersangka' => 'required',
        'tempat_lahir' => 'required',
        'tgl_lahir' => 'required|date',
        'alamat' => 'required',
    ];

    protected $messages = [
        'asal_instansi.required' => ':attribute tidak boleh kosong!',
        'email.required' => ':attribute tidak boleh kosong!',
        'email.email' => ':attribute tidak valid!',
        'no_hp.required' => ':attribute tidak boleh kosong!',
        'no_hp.min' => ':attribute tidak valid!',
        'no_hp.max' => ':attribute tidak valid!',
        'no_surat_permohonan.required' => ':attribute tidak boleh kosong!',
        'tgl_surat_permohonan.required' => ':attribute tidak boleh kosong!',
        'jenis_permohonan.required' => ':attribute tidak boleh kosong!',
        'penyitaan_penggeledahan.required' => ':attribute tidak boleh kosong!',
        'berkas_surat_permohonan.required' => ':attribute tidak boleh kosong!',
        'berkas_surat_permohonan.mimes' => 'format file tidak valid! hanya mendukung format (.docx, .doc, .pdf)',
        'berkas_surat_permohonan.max' => 'file terlalu besar! maksimal 2MB',
        'berkas_laporan_polisi.required' => ':attribute tidak boleh kosong!',
        'berkas_laporan_polisi.mimes' => 'format file tidak valid! hanya mendukung format (.docx, .doc, .pdf)',
        'berkas_laporan_polisi.max' => 'file terlalu besar! maksimal 2MB',
        'berkas_sp_pp.required' => ':attribute tidak boleh kosong!',
        'berkas_sp_pp.mimes' => 'format file tidak valid! hanya mendukung format (.docx, .doc, .pdf)',
        'berkas_sp_pp.max' => 'file terlalu besar! maksimal 2MB',
        'berkas_berita_acara.required' => ':attribute tidak boleh kosong!',
        'berkas_berita_acara.mimes' => 'format file tidak valid! hanya mendukung format (.docx, .doc, .pdf)',
        'berkas_berita_acara.max' => 'file terlalu besar! maksimal 2MB',
        'berkas_surat_penerimaan.required' => ':attribute tidak boleh kosong!',
        'berkas_surat_penerimaan.mimes' => 'format file tidak valid! hanya mendukung format (.docx, .doc, .pdf)',
        'berkas_surat_penerimaan.max' => 'file terlalu besar! maksimal 2MB',
        'berkas_sp_penyidikan.required' => ':attribute tidak boleh kosong!',
        'berkas_sp_penyidikan.mimes' => 'format file tidak valid! hanya mendukung format (.docx, .doc, .pdf)',
        'berkas_sp_penyidikan.max' => 'file terlalu besar! maksimal 2MB',
        'berkas_spdp.required' => ':attribute tidak boleh kosong!',
        'berkas_spdp.mimes' => 'format file tidak valid! hanya mendukung format (.docx, .doc, .pdf)',
        'berkas_spdp.max' => 'file terlalu besar! maksimal 2MB',
        'berkas_resume.required' => ':attribute tidak boleh kosong!',
        'berkas_resume.mimes' => 'format file tidak valid! hanya mendukung format (.docx, .doc, .pdf)',
        'berkas_resume.max' => 'file terlalu besar! maksimal 2MB',
        'pasal.required' => ':attribute tidak boleh kosong!',
        'barang_bukti.required' => ':attribute tidak boleh kosong!',
        'sumber.required' => ':attribute tidak boleh kosong!',
        'nama_tersangka.required' => ':attribute tidak boleh kosong!',
        'tempat_lahir.required' => ':attribute tidak boleh kosong!',
        'tgl_lahir.required' => ':attribute tidak boleh kosong!',
        'alamat.required' => ':attribute tidak boleh kosong!',
    ];

    public function render()
    {
        return view('livewire.request-form');
    }

    public function submit()
    {
        //Validasi Inputan User             
        $request = $this->validate();
        //Simpan Berkas-Berkas
        if (isset($request['berkas_surat_permohonan'])) {
            $request['berkas_surat_permohonan']->store('berkas');
            $request['berkas_surat_permohonan'] = $request['berkas_surat_permohonan']->hashName();
        }

        if (isset($request['berkas_laporan_polisi'])) {
            $request['berkas_laporan_polisi']->store('berkas');
            $request['berkas_laporan_polisi'] = $request['berkas_laporan_polisi']->hashName();
        }

        if (isset($request['berkas_sp_pp'])) {
            $request['berkas_sp_pp']->store('berkas');
            $request['berkas_sp_pp'] = $request['berkas_sp_pp']->hashName();
        }

        if (isset($request['berkas_berita_acara'])) {
            $request['berkas_berita_acara']->store('berkas');
            $request['berkas_berita_acara'] = $request['berkas_berita_acara']->hashName();
        }

        if (isset($request['berkas_surat_penerimaan'])) {
            $request['berkas_surat_penerimaan']->store('berkas');
            $request['berkas_surat_penerimaan'] = $request['berkas_surat_penerimaan']->hashName();
        }

        if (isset($request['berkas_sp_penyidikan'])) {
            $request['berkas_sp_penyidikan']->store('berkas');
            $request['berkas_sp_penyidikan'] = $request['berkas_sp_penyidikan']->hashName();
        }

        if (isset($request['berkas_spdp'])) {
            $request['berkas_spdp']->store('berkas');
            $request['berkas_spdp'] = $request['berkas_spdp']->hashName();
        }

        if (isset($request['berkas_resume'])) {
            $request['berkas_resume']->store('berkas');
            $request['berkas_resume'] = $request['berkas_resume']->hashName();
        }

        $store = Request::create($request);
        session()->flash('flash.banner', 'Permohonan berhasil disimpan!');
        session()->flash('flash.bannerStyle', 'success');    

        return redirect(route('user.request.index'));
    }
}
