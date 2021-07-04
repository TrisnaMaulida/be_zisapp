<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMustahiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mustahiks', function (Blueprint $table) {
            $table->increments('id_mustahik');
            $table->integer('kode_mustahik'); //generate kode otomatis (1840010001)
            $table->string('nama_mustahik');
            $table->string('alamat_mustahik');
            $table->integer('asnaf');
            $table->bigInteger('telepon_mustahik');
            $table->integer('kategori_mustahik');
            $table->integer('status_mustahik');
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
        Schema::dropIfExists('mustahiks');
    }
}
