<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = ['user_id', 'asal_instansi', 'email', 'no_hp', 'no_surat_permohonan', 'tgl_surat_permohonan', 'jenis_permohonan', 'penyitaan_penggeledahan', 'tgl_sita_geledah', 'berkas_surat_permohonan', 'berkas_laporan_polisi', 'berkas_sp_pp', 'berkas_berita_acara', 'berkas_surat_penerimaan', 'berkas_sp_penyidikan', 'berkas_spsd', 'berkas_resume', 'pasal', 'sumber', 'nama_tersangka', 'tempat_lahir', 'tgl_lahir', 'alamat'];    

    public function evidence_lists()
    {
        return $this->hasMany(EvidenceList::class);
    }
}
