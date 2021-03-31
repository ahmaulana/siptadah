<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvidenceListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidence_lists', function (Blueprint $table) {            
            $table->id();
            $table->foreignId('request_id')->constrained('requests')->onDelete('cascade')->onUpdate('cascade');;
            $table->string('barang_bukti');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evidence_lists');
    }
}
