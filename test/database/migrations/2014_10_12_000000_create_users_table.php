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
            $table->id();
            $table->string("NIM");
            $table->enum("gender",["L","P","N"])->nullable();
            $table->string("alamat")->nullable();
            $table->string("Kota Lahir")->nullable();
            $table->string('name');
            $table->integer("angkatan");
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
        Schema::dropIfExists('students');
    }
};
