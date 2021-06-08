<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailDonasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_donasis', function (Blueprint $table) {
            $table->increments('id');
            $table->text('no_donasi');
            $table->integer('kode_program');
            $table->integer('jumlah_donasi');
            $table->text('keterangan');
            $table->text('createdby');
            $table->integer('status');
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
        Schema::dropIfExists('detail_donasis');
    }
}
