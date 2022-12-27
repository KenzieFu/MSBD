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
        Schema::create('log_nilais', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_rombel');
            $table->string("NIS");
            $table->string('nama_mapel');
            $table->biginteger('nilai_lama');
            $table->biginteger('nilai_baru');
          
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
        Schema::dropIfExists('log_nilais');
    }
};
