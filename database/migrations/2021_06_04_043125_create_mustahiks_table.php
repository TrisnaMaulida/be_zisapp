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
            $table->increments('id');
            $table->integer('kode');
            $table->string('nama');
            $table->string('alamat');
            $table->bigInteger('telepon');
            $table->integer('kategori');
            $table->integer('aktif');
            $table->bigInteger('no_kantor');
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
        Schema::dropIfExists('mustahiks');
    }
}
