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
            $table->increments('id_detaildonasi');
            $table->text('id_donasi');
            $table->integer('id_program');
            $table->integer('jumlah_donasi');
            $table->text('keterangan');
            $table->integer('id_pengguna');
            $table->integer('status_detaildonasi');
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
