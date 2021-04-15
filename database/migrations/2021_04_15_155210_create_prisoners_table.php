<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrisonersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prisoners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('asal_instansi');
            $table->string('no_surat');
            $table->dateTime('tgl_surat');
            $table->string('nama_tersangka');
            $table->string('tempat_lahir');
            $table->dateTime('tgl_lahir');
            $table->string('jenis_kelamin');
            $table->string('alamat');
            $table->string('agama');
            $table->string('pekerjaan');
            $table->string('berkas_surat_permohonan')->nullable();
            $table->string('berkas_laporan_polisi')->nullable();
            $table->string('berkas_sp_penyidikan')->nullable();
            $table->string('berkas_spdp')->nullable();
            $table->string('berkas_penetapan_penahanan_penyidik')->nullable();
            $table->string('berkas_penetapan_perpanjangan_penahanan')->nullable();
            $table->string('berkas_berita_acara')->nullable();
            $table->string('berkas_resume')->nullable();
            $table->enum('status', ['menunggu', 'sedang diproses', 'disetujui', 'ditolak', 'selesai'])->default('menunggu');
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
        Schema::dropIfExists('prisoners');
    }
}
