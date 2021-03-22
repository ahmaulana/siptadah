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
            $table->string('asal_instansi');
            $table->string('email');
            $table->string('no_hp');
            $table->string('no_surat_permohonan');
            $table->dateTime('tgl_surat_permohonan');
            $table->string('jenis_permohonan');
            $table->string('penyitaan_penggeledahan');
            $table->string('berkas_surat_permohonan')->nullable();
            $table->string('berkas_laporan_polisi')->nullable();
            $table->string('berkas_sp_pp')->nullable();
            $table->string('berkas_berita_acara')->nullable();
            $table->string('berkas_surat_penerimaan')->nullable();
            $table->string('berkas_sp_penyidikan')->nullable();
            $table->string('berkas_spdp')->nullable();
            $table->string('berkas_resume')->nullable();
            $table->string('pasal');
            $table->text('barang_bukti');
            $table->text('sumber');
            $table->string('nama_tersangka');
            $table->string('tempat_lahir');
            $table->dateTime('tgl_lahir');
            $table->text('alamat');
            $table->enum('status',['diproses','disetujui','ditolak'])->default('diproses');
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
