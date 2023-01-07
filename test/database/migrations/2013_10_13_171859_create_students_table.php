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
        Schema::create('students', function (Blueprint $table) {
            $table->string("NIS",7)->primary();
            $table->string("NIPD",6);
            $table->string("NISN",10);
            $table->string("NIK",16);
            $table->string('name');
            $table->enum('agama',['Islam','Kristen','Buddha','Katolik','Hindu','Kong Hu Chu']);
            $table->enum("gender",["L","P"])->nullable();
            $table->date('Tanggal_Lahir');
            $table->enum("status",["Aktif","Tidak Aktif","Tamat"])->default("Aktif");
            $table->enum('Jenis_Tinggal',['Bersama Orang Tua','Sendiri']);
            $table->bigInteger('Tempat_Lahir')->unsigned();
            $table->foreign('Tempat_Lahir')->references('id')->on('kotas');
            $table->bigInteger('id_kecamatan')->unsigned();
            $table->foreign('id_kecamatan')->references('id')->on('kecamatans');
            $table->bigInteger('id_kelurahan')->unsigned();
            $table->foreign('id_kelurahan')->references('id')->on('kelurahans');
            $table->string("alamat")->nullable();
            $table->string("angkatan");
            $table->bigInteger('Tahun_Masuk')->unsigned();
            $table->foreign('Tahun_Masuk')->references('id')->on('tahun_akademiks');
            $table->string('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->bigInteger('tingkatan')->unsigned()->nullable();
            $table->foreign('tingkatan')->references('id')->on('status_tingkatan_siswas');
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
        Schema::dropIfExists('students');
    }
};
