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
        Schema::create('nilai_siswas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_rsiswa')->unsigned();
            $table->foreign('id_rsiswa')->references('id')->on('rombel_siswas')->onDelete('cascade');
            $table->bigInteger('id_mapel')->unsigned();
            $table->foreign('id_mapel')->references('id')->on('mapels')->onDelete('cascade');
            $table->bigInteger('nilai')->unsigned()->nullable()->default(0);
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
        Schema::dropIfExists('nilai_siswas');
    }
};
