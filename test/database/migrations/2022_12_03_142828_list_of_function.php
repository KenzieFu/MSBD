<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        //Function menghasilkan Nim siswa
        DB::unprepared('
        CREATE OR REPLACE FUNCTION generate_nim (angkatan VARCHAR(2),no_urut VARCHAR(3)) RETURNS VARCHAR(7)
            BEGIN
            DECLARE res VARCHAR(7);
            DECLARE kode_sekolah VARCHAR(2);
            SET angkatan =(SELECT LPAD(angkatan,2,0));
            SET kode_sekolah="35";
            SET res=(CONCAT(angkatan,kode_sekolah,no_urut));
            return res;
            END;
        ');
        //Function untuk menentukan 3 nim blkng siswa yang merupakan no urut
        DB::unprepared('
        CREATE OR REPLACE FUNCTION no_urut (thn_aktif VARCHAR(2)) RETURNS VARCHAR(3)
            BEGIN
            DECLARE res VARCHAR(3);
            SET res=(SELECT COUNT(*) FROM students WHERE angkatan=thn_aktif) +1;
            SET res=(SELECT LPAD(res,3,0));
            RETURN res;
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
