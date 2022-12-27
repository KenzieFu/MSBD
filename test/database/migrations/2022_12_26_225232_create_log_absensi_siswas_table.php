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
        Schema::create('log_absensi_siswas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_rombel');
            $table->string("NIS");
            $table->biginteger('absen_lama');
            $table->biginteger('izin_lama');
            $table->biginteger('sakit_lama');
            $table->biginteger('absen_baru');
            $table->biginteger('izin_baru');
            $table->biginteger('sakit_baru');
          
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
        Schema::dropIfExists('log_absensi_siswas');
    }
};
