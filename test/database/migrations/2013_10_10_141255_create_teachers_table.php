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
        Schema::create('teachers', function (Blueprint $table) {
            $table->string("NIG")->primary();
            $table->string("alias");
            $table->string('name');
            $table->string('NUPTK');
            $table->enum('agama',['Islam','Kristen','Buddha','Katolik','Hindu','Kong Hu Chu']);
            $table->enum('status_kepegawaian',['GTY/PTY','Guru Honor Sekolah']);
            $table->date('Tanggal_Lahir');
            $table->bigInteger('Tempat_Lahir')->unsigned();
            $table->foreign('Tempat_Lahir')->references('id')->on('kotas');
            $table->string("alamat")->nullable();
            $table->enum("status",["Aktif","Tidak Aktif"])->default("Aktif");
            $table->enum("gender",["L","P"])->nullable();
            $table->bigInteger('Tahun_Daftar')->unsigned();
            $table->foreign('Tahun_Daftar')->references('id')->on('tahun_akademiks');
            $table->string("angkatan");
            $table->string('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('teachers');
    }
};
