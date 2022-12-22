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
        Schema::create('rombel_siswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_rombel');
            $table->foreign("id_rombel")->references('id')->on('rombels')->onDelete('cascade');
            $table->string('id_siswa');
            $table->foreign("id_siswa")->references('NIS')->on('students')->onDelete('cascade');
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
        Schema::dropIfExists('rombel_siswas');
    }
};
