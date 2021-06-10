<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMuzakisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('muzakis', function (Blueprint $table) {
            $table->increments('id_muzaki');
            $table->integer('npwz');
            $table->integer('nik');
            $table->string('nama_muzaki');
            $table->integer('jk');
            $table->string('alamat');
            $table->string('profesi');
            $table->bigInteger('no_hp');
            $table->integer('kategori');
            $table->integer('status');
            $table->char('kode_petugas');
            $table->bigInteger('no_kantor');
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
        Schema::dropIfExists('muzakis');
    }
}
