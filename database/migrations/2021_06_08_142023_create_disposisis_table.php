<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisposisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposisis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_disposisi');
            $table->string('nama_pengirim');
            $table->date('tgl_surat');
            $table->date('tertanggal_surat');
            $table->text('perihal');
            $table->text('catatan_penerima');
            $table->date('tgl_survey');
            $table->integer('status');
            $table->string('deliver_to');
            $table->string('cratedby');
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
        Schema::dropIfExists('disposisis');
    }
}
