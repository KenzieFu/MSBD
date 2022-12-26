<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_absensi_gurus', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_thnakademik')->unsigned();
            $table->foreign('id_thnakademik')->references('id')->on('tahun_akademiks');
            $table->string('id_guru');
            $table->foreign('id_guru')->references('NIG')->on('teachers')->onDelete('cascade');
            $table->bigInteger('absen')->unsigned()->default(0);
            $table->bigInteger('sakit')->unsigned()->default(0);
            $table->bigInteger('izin')->unsigned()->default(0);
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
        Schema::dropIfExists('daftar_absensi_gurus');
    }
};
