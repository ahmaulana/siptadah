<?php

namespace App\Http\Livewire\Prisoner;

use App\Models\Prisoner;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $i = 0;
    public $inputs = [];

    public $suratPermohonan, $laporanPolisi, $beritaAcara, $penetapanPenahananPenyidik, $penetapanPerpanjanganPenahanan, $spPenyidikan, $spdp, $resume;

    public $nama_pemohon, $no_hp, $no_surat, $tgl_surat, $nama_tersangka, $tempat_lahir, $tgl_lahir, $jenis_kelamin, $alamat, $agama, $pekerjaan, $berkas_surat_permohonan, $berkas_laporan_polisi, $berkas_sp_penyidikan, $berkas_spdp, $berkas_penetapan_penahanan_penyidik,$berkas_penetapan_perpanjangan_penahanan, $berkas_berita_acara, $berkas_resume;

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

    public function render()
    {      
        if(!User::findOrFail(auth()->user()->id)->hasPermissionTo('Input Tahanan')){
            abort(403);
        }
        return view('livewire.prisoner.create');
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
        unset($this->barang_bukti[$i + 1]);
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

        if (isset($request['berkas_sp_penyidikan'])) {
            $request['berkas_sp_penyidikan']->store('berkas');
            $request['berkas_sp_penyidikan'] = $request['berkas_sp_penyidikan']->hashName();
        }

        if (isset($request['berkas_spdp'])) {
            $request['berkas_spdp']->store('berkas');
            $request['berkas_spdp'] = $request['berkas_spdp']->hashName();
        }

        if (isset($request['berkas_penetapan_penahanan_penyidik'])) {
            $request['berkas_penetapan_penahanan_penyidik']->store('berkas');
            $request['berkas_penetapan_penahanan_penyidik'] = $request['berkas_penetapan_penahanan_penyidik']->hashName();
        }

        if (isset($request['berkas_penetapan_perpanjangan_penahanan'])) {
            $request['berkas_penetapan_perpanjangan_penahanan']->store('berkas');
            $request['berkas_penetapan_perpanjangan_penahanan'] = $request['berkas_penetapan_perpanjangan_penahanan']->hashName();
        }        

        if (isset($request['berkas_berita_acara'])) {
            $request['berkas_berita_acara']->store('berkas');
            $request['berkas_berita_acara'] = $request['berkas_berita_acara']->hashName();
        }        

        if (isset($request['berkas_resume'])) {
            $request['berkas_resume']->store('berkas');
            $request['berkas_resume'] = $request['berkas_resume']->hashName();
        }
        
        $user_id = auth()->user()->id;

        $user = User::find($user_id);
        $request['user_id'] = $user_id;
        $request['asal_instansi'] = $user->getRoleNames()->first();                

        $store_request = Prisoner::create($request);
        
        session()->flash('flash.banner', 'Permohonan berhasil disimpan!');
        session()->flash('flash.bannerStyle', 'success');

        return redirect(route('tahanan.index'));
    }
}
