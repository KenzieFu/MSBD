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
            $table->enum("status",["Aktif","Tidak Aktif","Selesai"])->default("Aktif");
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
