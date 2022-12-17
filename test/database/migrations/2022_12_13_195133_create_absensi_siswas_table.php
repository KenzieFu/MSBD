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
        Schema::create('absensi_siswas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_rsiswa')->unsigned();
            $table->foreign('id_rsiswa')->references('id')->on('rombel_siswas');
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
        Schema::dropIfExists('absensi_siswas');
    }
};
