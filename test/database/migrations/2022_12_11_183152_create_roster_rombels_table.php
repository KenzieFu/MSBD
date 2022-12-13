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
        Schema::create('roster_rombels', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_rombel')->unsigned();
            $table->foreign('id_rombel')->references('id')->on('rombels');
            $table->time('sesi1')->nullable();
            $table->time('sesi2')->nullable();
            $table->bigInteger('id_mapel')->unsigned();
            $table->foreign('id_mapel')->references('id')->on('mapels');
            $table->enum("Hari",["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"]);
            $table->string('id_guru');
            $table->foreign('id_guru')->references('NIG')->on('teachers');
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
        Schema::dropIfExists('roster_rombels');
    }
};
