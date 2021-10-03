<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubSubKatAkuns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_sub_kat_akuns', function (Blueprint $table) {
            $table->increments('id_sub_sub_kat_akun');
            $table->integer('id_sub_kat_akun');
            $table->string('nama_sub_sub_kat_akun');
            $table->string('kode_sub_sub_kat_akun');
            $table->integer('saldo_normal'); //isinya D sama K
            $table->string('laporan');
            $table->integer('saldo_awal');
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
        Schema::dropIfExists('sub_sub_kat_akuns');
    }
}
