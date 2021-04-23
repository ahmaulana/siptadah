<?php

namespace App\Http\Livewire\Siptadah;

use App\Models\EvidenceList;
use App\Models\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    public $request, $evidence, $barang_bukti;

    public $i = 0;
    public $inputs = [];    
    public $request_status;

    use WithFileUploads;

    public $suratPermohonan, $laporanPolisi, $sppp, $beritaAcara, $suratPenerimaan, $spPenyidikan, $spdp, $resume;

    public $file_surat_permohonan, $file_laporan_polisi, $file_sp_pp, $file_berita_acara, $file_surat_penerimaan, $file_sp_penyidikan, $file_spdp, $file_resume;

    public $user_id, $asal_instansi, $email, $no_hp, $no_surat_permohonan, $tgl_surat_permohonan, $jenis_permohonan, $penyitaan_penggeledahan, $tgl_sita_geledah, $berkas_surat_permohonan, $berkas_laporan_polisi, $berkas_sp_pp, $berkas_berita_acara, $berkas_surat_penerimaan, $berkas_sp_penyidikan, $berkas_spdp, $berkas_resume, $pasal, $sumber, $nama_tersangka, $tempat_lahir, $tgl_lahir, $jenis_kelamin, $kebangsaan, $alamat, $agama, $pekerjaan;

    protected $rules = [
        'asal_instansi' => 'required',
        'email' => 'required|email',
        'no_hp' => 'required|min:9|max:13',
        'no_surat_permohonan' => 'required',
        'tgl_surat_permohonan' => 'required|date',
        'jenis_permohonan' => 'required',
        'penyitaan_penggeledahan' => 'required',
        'tgl_sita_geledah' => 'nullable|required_if:penyitaan_penggeledahan,sudah|date',
        'berkas_surat_permohonan' => 'nullable|mimes:docx,pdf,doc|max:2048',
        'berkas_laporan_polisi' => 'nullable|mimes:docx,pdf,doc|max:2048',
        'berkas_sp_pp' => 'nullable|mimes:docx,pdf,doc|max:2048',
        'berkas_berita_acara' => 'nullable|mimes:docx,pdf,doc|max:2048',
        'berkas_surat_penerimaan' => 'nullable|mimes:docx,pdf,doc|max:2048',
        'berkas_sp_penyidikan' => 'nullable|mimes:docx,pdf,doc|max:2048',
        'berkas_spdp' => 'nullable|mimes:docx,pdf,doc|max:2048',
        'berkas_resume' => 'nullable|mimes:docx,pdf,doc|max:2048',
        'pasal' => 'required',
        'barang_bukti.*' => 'required',
        'sumber' => 'required',
        'nama_tersangka' => 'required',
        'tempat_lahir' => 'required',
        'tgl_lahir' => 'required|date',
        'jenis_kelamin' => 'required',
        'kebangsaan' => 'required',
        'agama' => 'required',
        'pekerjaan' => 'required',
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
        'tgl_sita_geledah.required_if' => 'Tanggal tidak boleh kosong!',
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
        'jenis_kelamin.required' => ':attribute tidak boleh kosong!',
        'agama.required' => ':attribute tidak boleh kosong!',
        'pekerjaan.required' => ':attribute tidak boleh kosong!',
        'kebangsaan.required' => ':attribute tidak boleh kosong!',
        'alamat.required' => ':attribute tidak boleh kosong!',
    ];

    public function mount()
    {        
        $this->user_id = $this->request->user_id;
        $this->asal_instansi = $this->request->asal_instansi;
        $this->email = $this->request->email;
        $this->no_hp = $this->request->no_hp;
        $this->no_surat_permohonan = $this->request->no_surat_permohonan;
        $this->tgl_surat_permohonan = date('Y-m-d', strtotime($this->request->tgl_surat_permohonan));
        $this->jenis_permohonan = $this->request->jenis_permohonan;
        $this->penyitaan_penggeledahan = $this->request->penyitaan_penggeledahan;
        $this->tgl_sita_geledah = $this->request->tgl_sita_geledah != null ? date('Y-m-d', strtotime($this->request->tgl_sita_geledah)) : null;
        $this->pasal = $this->request->pasal;
        $this->sumber = $this->request->sumber;
        $this->nama_tersangka = $this->request->nama_tersangka;
        $this->tempat_lahir = $this->request->tempat_lahir;

        $this->tgl_lahir = date('Y-m-d', strtotime($this->request->tgl_lahir));
        $this->jenis_kelamin = $this->request->jenis_kelamin;
        $this->agama = $this->request->agama;
        $this->pekerjaan = $this->request->pekerjaan;
        $this->kebangsaan = $this->request->kebangsaan;
        $this->alamat = $this->request->alamat;

        $this->file_surat_permohonan = ['name' => 'Surat Permohonan', 'link' => $this->request->berkas_surat_permohonan];
        $this->file_laporan_polisi = ['name' => 'Laporan Polisi', 'link' => $this->request->berkas_laporan_polisi];
        $this->file_sp_pp = ['name' => 'Surat Perintah Penyitaan/Penggeledahan', 'link' => $this->request->berkas_sp_pp];
        $this->file_berita_acara = ['name' => 'Berita Acara Penyitaan/Penggeledahan', 'link' => $this->request->berkas_berita_acara];
        $this->file_surat_penerimaan = ['name' => 'Surat Tanda Penerimaan', 'link' => $this->request->berkas_surat_penerimaan];
        $this->file_sp_penyidikan = ['name' => 'Surat Perintah Penyidikan', 'link' => $this->request->berkas_sp_penyidikan];
        $this->file_spdp = ['name' => 'Surat Perintah Dimulainya Penyidikan (SPDP)', 'link' => $this->request->berkas_spdp];
        $this->file_resume = ['name' => 'Resume', 'link' => $this->request->berkas_resume];

        $this->suratPermohonan = (isset($this->request->berkas_surat_permohonan)) ? true : false;
        $this->laporanPolisi = (isset($this->request->berkas_laporan_polisi)) ? true : false;
        $this->sppp = (isset($this->request->berkas_sp_pp)) ? true : false;
        $this->beritaAcara = (isset($this->request->berkas_berita_acara)) ? true : false;
        $this->suratPenerimaan = (isset($this->request->berkas_surat_penerimaan)) ? true : false;
        $this->spPenyidikan = (isset($this->request->berkas_sp_penyidikan)) ? true : false;
        $this->spdp = (isset($this->request->berkas_spdp)) ? true : false;
        $this->resume = (isset($this->request->berkas_resume)) ? true : false;

        //Barang Bukti
        $this->i = count($this->evidence);
        $this->i--;
        foreach ($this->evidence as $key => $bukti) {
            $this->inputs[] = $bukti->barang_bukti;
            $this->barang_bukti[] = $bukti->barang_bukti;
        }
    }

    public function render()
    {
        return view('livewire.siptadah.edit');
    }

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs, $i);
    }

    public function remove($i)
    {        
        unset($this->inputs[$i]);
        unset($this->barang_bukti[$i]);        
    }

    public function update()
    {
        if (auth()->user()->cannot('Edit Siptadah')) {
            abort(403);
        }

        $request = $this->validate();
        DB::transaction(function () use ($request) {
            $update = Request::findOrFail($this->request->id);
            $update->email = $request['email'];
            $update->no_hp = $request['no_hp'];
            $update->no_surat_permohonan = $request['no_surat_permohonan'];
            $update->tgl_surat_permohonan = $request['tgl_surat_permohonan'];
            $update->jenis_permohonan = $request['jenis_permohonan'];
            $update->penyitaan_penggeledahan = $request['penyitaan_penggeledahan'];
            $update->tgl_sita_geledah = ($request['penyitaan_penggeledahan'] == 'sudah') ? $request['tgl_sita_geledah'] : null;
            $update->pasal = $request['pasal'];
            $update->sumber = $request['sumber'];
            $update->nama_tersangka = $request['nama_tersangka'];
            $update->tempat_lahir = $request['tempat_lahir'];
            $update->tgl_lahir = $request['tgl_lahir'];
            $update->jenis_kelamin = $request['jenis_kelamin'];
            $update->agama = $request['agama'];
            $update->pekerjaan = $request['pekerjaan'];
            $update->kebangsaan = $request['kebangsaan'];
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

            if (isset($request['berkas_sp_pp'])) {
                $request['berkas_sp_pp']->store('berkas');
                $update->berkas_sp_pp = $request['berkas_sp_pp']->hashName();
            }

            if (isset($request['berkas_berita_acara'])) {
                $request['berkas_berita_acara']->store('berkas');
                $update->berkas_berita_acara = $request['berkas_berita_acara']->hashName();
            }

            if (isset($request['berkas_surat_penerimaan'])) {
                $request['berkas_surat_penerimaan']->store('berkas');
                $update->berkas_surat_penerimaan = $request['berkas_surat_penerimaan']->hashName();
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

            //Delete & Update
            $update->evidence_lists()->delete();

            foreach ($this->barang_bukti as $bukti) {
                $update_barang_bukti = EvidenceList::create(
                    ['request_id' => $this->request->id, 'barang_bukti' => $bukti],
                    ['barang_bukti' => $bukti]
                );
            }

            session()->flash('flash.banner', 'Permohonan berhasil diperbarui!');
            session()->flash('flash.bannerStyle', 'success');
        });
        return redirect(route('siptadah.index'));
    }

    public function download($file, $name)
    {
        $path = storage_path('app/berkas/' . $file);
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        return response()->download($path, $name . '.' . $extension);
    }
    
}
