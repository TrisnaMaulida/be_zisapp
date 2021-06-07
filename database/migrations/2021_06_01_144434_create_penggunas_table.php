<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penggunas', function (Blueprint $table) {
            $table->increments('id_pengguna');
            $table->text('kode_pengguna');
            $table->string('nama_pengguna');
            $table->string('alamat');
            $table->bigInteger('no_hp');
            $table->integer('leveluser');
            $table->string('username');
            $table->string('password');
            $table->integer('status');
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
        Schema::dropIfExists('penggunas');
    }
}
