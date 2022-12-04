<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       /* 
        DB::unprepared('
        CREATE OR REPLACE Trigger add_students  BEFORE INSERT ON students FOR EACH ROW 
            BEGIN
            SET NEW.NIM = (SELECT generate_nim(NEW.angkatan,no_urut(NEW.angkatan)));
            SET NEW.password=SHA("NEW.NIM");
            END;
        '); */
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
