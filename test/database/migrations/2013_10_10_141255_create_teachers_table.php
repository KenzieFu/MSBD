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
            $table->string("alamat")->nullable();
            $table->string("Kota_Lahir")->nullable();
            $table->enum("status",["Aktif","Tidak Aktif"])->default("Aktif");
            $table->enum("gender",["L","P"])->nullable();
            $table->string("angkatan");
            $table->string('email')->unique();
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
        Schema::dropIfExists('teachers');
    }
};
