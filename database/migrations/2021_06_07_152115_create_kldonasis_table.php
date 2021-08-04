<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKldonasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kldonasis', function (Blueprint $table) {
            $table->increments('id_donasi');
            $table->bigInteger('no_kantor');
            $table->integer('no_bukti');
            $table->char('periode');
            $table->date('tgl_donasi');
            $table->integer('npwz');
            $table->integer('kode_program');
            $table->integer('jumlah_donasi');
            $table->decimal("total_donasi", $precision = 8, $scale = 2);
            $table->integer('metode');
            $table->bigInteger('no_rek');
            $table->integer('status');
            $table->text('cratedby');
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
        Schema::dropIfExists('kldonasis');
    }
}
