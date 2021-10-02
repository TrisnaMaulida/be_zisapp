<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubKatAkuns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_kat_akuns', function (Blueprint $table) {
            $table->increments('id_sub_kat_akun');
            $table->integer('kategori');
            $table->integer('kode_sub_kat_akun');
            $table->string('nama_sub_kat_akun');
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
        Schema::dropIfExists('sub_kat_akuns');
    }
}
