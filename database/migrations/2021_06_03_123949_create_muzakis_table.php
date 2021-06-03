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
            $table->increments('id');
            $table->integer('npwz');
            $table->integer('nik');
            $table->string('nama');
            $table->integer('jk');
            $table->integer('kategori');
            $table->string('alamat');
            $table->integer('phone');
            $table->string('petugas');
            $table->string('kantor_layanan');
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
