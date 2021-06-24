<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->increments('id_pengajuan');
            $table->string('no_pengajuan');
            $table->integer('id_mustahik');
            $table->text('pengajuan_kegiatan');
            $table->decimal('jumlah_pengajuan');
            $table->integer('jenis_pengajuan');
            $table->integer('asnaf');
            $table->integer('status_pengajuan');
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
        Schema::dropIfExists('pengajuans');
    }
}
