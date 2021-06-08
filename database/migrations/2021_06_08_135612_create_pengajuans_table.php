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
            $table->string('no_disposisi');
            $table->bigInteger('no_kantor');
            $table->integer('kode_mustahik');
            $table->text('kegiatan');
            $table->decimal('jmlh_pengajuan');
            $table->date('tgl_realisasi');
            $table->decimal('jmlh_realisasi');
            $table->integer('jenis');
            $table->text('keterangan');
            $table->text('rekomendasi');
            $table->integer('asnaf');
            $table->integer('sumber_dana');
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
        Schema::dropIfExists('pengajuans');
    }
}
