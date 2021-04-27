<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('asal_instansi');
            $table->string('nama_pemohon');
            $table->string('no_hp');
            $table->string('no_surat_permohonan');
            $table->dateTime('tgl_surat_permohonan');
            $table->string('jenis_permohonan');
            $table->string('penyitaan_penggeledahan');
            $table->dateTime('tgl_sita_geledah')->nullable();
            $table->string('berkas_surat_permohonan')->nullable();
            $table->string('berkas_laporan_polisi')->nullable();
            $table->string('berkas_sp_pp')->nullable();
            $table->string('berkas_berita_acara')->nullable();
            $table->string('berkas_surat_penerimaan')->nullable();
            $table->string('berkas_sp_penyidikan')->nullable();
            $table->string('berkas_spdp')->nullable();
            $table->string('berkas_resume')->nullable();
            $table->string('pasal');            
            $table->text('sumber');
            $table->string('nama_tersangka');
            $table->string('tempat_lahir');
            $table->dateTime('tgl_lahir');
            $table->string('jenis_kelamin');
            $table->string('kebangsaan')->default('Indonesia');
            $table->text('alamat');
            $table->string('agama');
            $table->string('pekerjaan');
            $table->enum('status',[0, 1, 2, 3, 4])->default(0)->comment('0:menunggu, 1:sedang diproses, 2:disetujui, 3:ditolak, 4:selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
