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
        Schema::create('tahun_akademiks', function (Blueprint $table) {
            $table->id();
            $table->string("TahunAjaran");
            $table->string("kurikulum");
            $table->string("angkatan");
            $table->enum("status",["Aktif","Tidak Aktif"])->default("Tidak Aktif");
            $table->enum("Pembelajaran",["Selesai","Belum Selesai"])->default("Belum Selesai");
            $table->timestamps();
        });
    }
    //Trigger cek klo tahun akademik cuman bole satu yg aktif ,pendaftaran 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tahun_akademiks');
    }
};
