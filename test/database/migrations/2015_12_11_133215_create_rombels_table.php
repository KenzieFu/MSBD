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
        Schema::create('rombels', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_kelas')->unsigned()->nullable();
            $table->foreign('id_kelas')->references('id')->on('kelas')->onDelete('cascade');
            $table->enum("SMP",[1,2,3]);
            $table->bigInteger('id_thnakademik')->unsigned();
            $table->foreign('id_thnakademik')->references('id')->on('tahun_akademiks');
            $table->string('id_wali')->nullable();
            $table->foreign('id_wali')->references('NIG')->on('teachers')->onDelete('set null');
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
        Schema::dropIfExists('rombels');
    }
};
