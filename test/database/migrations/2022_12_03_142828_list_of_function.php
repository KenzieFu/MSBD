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
            SET kode_sekolah="35";
            SET res=(SELECT LPAD((CONCAT(angkatan,kode_sekolah,no_urut)),7,0));
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



        ///////////////Procedure
        //procedure untuk cek validasi tahun akademik tidak ada yang bole mengaktifkan dua tahun ajaran sekaligus
        DB::unprepared('
        CREATE OR REPLACE PROCEDURE validasi_statusAkademik()
        BEGIN
        DECLARE vcheck INT;
        SET vcheck:=(SELECT COUNT(*) FROM tahun_akademiks WHERE (status="Aktif") OR (status="Pendaftaran"));
        	IF vcheck > 1 THEN
            	SIGNAL SQLSTATE "45000"
            	SET MESSAGE_TEXT="Hanya boleh Mengaktifkan Satu Tahun Ajaran Saja";
        	END IF;
        END;
        ');

        //function  menghitung jumlah siswa
        DB::unprepared('
            CREATE OR REPLACE PROCEDURE  jumlah_siswa_kelas(id_rombel INT,thak INT)
            BEGIN
                SELECT COUNT(*) as t FROM rombel_siswas rs INNER JOIN rombels r ON r.id=rs.id_rombel WHERE rs.id_rombel=id_rombel AND r.id_thnakademik=thak;
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
        
    }
};
