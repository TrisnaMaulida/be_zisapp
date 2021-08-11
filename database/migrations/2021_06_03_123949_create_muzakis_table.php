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
            //$table->integer('npwp');
            $table->integer('npwz'); //generate otomatis (1011110001)
            $table->integer('nik')->length(16);
            $table->string('nama_muzaki');
            $table->integer('jk');
            $table->string('alamat_muzaki');
            $table->string('profesi');
            $table->bigInteger('telepon_muzaki');
            $table->integer('kategori_muzaki');
            $table->integer('status_muzaki');
            $table->integer('id_pengguna'); //buat mengambil data pengguna
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
