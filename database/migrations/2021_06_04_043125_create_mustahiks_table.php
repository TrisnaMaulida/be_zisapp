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
            $table->integer('kode_mustahik');
            $table->string('nama_mustahik');
            $table->string('alamat');
            $table->string('profesi');
            $table->integer('asnaf');
            $table->bigInteger('no_hp');
            $table->integer('kategori');
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
        Schema::dropIfExists('mustahiks');
    }
}
