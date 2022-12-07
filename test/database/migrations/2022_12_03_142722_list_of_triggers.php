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

        //Trigger validasi pengaktifan tahun ajaran
        DB::unprepared('
            CREATE OR REPLACE TRIGGER validasi_thnAjaran BEFORE UPDATE ON tahun_akademiks FOR EACH ROW
                BEGIN
                CALL validasi_thnAjaran();
                END;
        ');
        //Trigger untuk Validasi insert untuk menentukan angkatan
        DB::unprepared('
            CREATE OR REPLACE TRIGGER angkatan_thnAka BEFORE INSERT ON tahun_akademiks FOR EACH ROW
            BEGIN
            SET NEW.angkatan=(SELECT COUNT(*) as row FROM tahun_akademiks)+1;
            END;
        ');
      
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
