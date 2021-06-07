<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donasis', function (Blueprint $table) {
            $table->increments('id_donasi');
            $table->text('no_donasi');
            $table->integer('no_bukti');
            $table->char('periode');
            $table->date('tgl_donasi');
            $table->integer('metode');
            $table->bigInteger('no_rek');
            $table->integer('status');
            $table->text('createdby');
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
        Schema::dropIfExists('donasis');
    }
}
