<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->enum("gender",["L","P"])->nullable();
            $table->enum("status",["Aktif","Tidak Aktif","Tamat"])->default("Aktif");
            $table->enum("SMP",[1,2,3])->default(1);
            $table->string("alamat")->nullable();
            $table->string("Kota_Lahir")->nullable();
            $table->string('name');
            $table->string("angkatan");
            $table->string('email')->unique();
            $table->bigInteger('id_kelas')->unsigned()->nullable();
            $table->foreign('id_kelas')->references('id')->on('kelas');
            $table->string('password');
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
