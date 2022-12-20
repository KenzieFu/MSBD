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
            DECLARE kode_siswa VARCHAR(2);
            SET kode_siswa="01";
            SET res=(SELECT LPAD((CONCAT(angkatan,kode_siswa,no_urut)),7,0));
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
            CREATE OR REPLACE FUNCTION  jumlah_siswa(id_rombel INT) RETURNS INT
            BEGIN
                RETURN (SELECT COUNT(*) as t FROM rombel_siswas rs  WHERE rs.id_rombel=id_rombel);
            END;
        ');

        //Procedure utk menemukan jadwal apakah jadwal bentrok/tidak
        DB::unprepared('
            CREATE OR REPLACE FUNCTION validasi_roster(id_rombel INT,new_sesi1 time,new_sesi2 time, hari VARCHAR(10)) RETURNS INT
                BEGIN
                 
              RETURN (SELECT COUNT(*) FROM roster_rombels rr 
        WHERE 
        (
            CASE WHEN rr.sesi1 > new_sesi1 THEN TIMEDIFF(rr.sesi1,new_sesi1) ELSE TIMEDIFF(new_sesi1,rr.sesi1) END <"00:40:00" OR 
            CASE WHEN rr.sesi2 > new_sesi2 THEN TIMEDIFF(rr.sesi2,new_sesi2)ELSE TIMEDIFF(new_sesi2,rr.sesi2) END <"00:40:00" OR
            CASE WHEN rr.sesi1 > new_sesi2 THEN TIMEDIFF(rr.sesi1,new_sesi2)ELSE TIMEDIFF(new_sesi2,rr.sesi1) END <"00:40:00" OR
            CASE WHEN rr.sesi2 > new_sesi1 THEN TIMEDIFF(rr.sesi2,new_sesi1)ELSE TIMEDIFF(new_sesi1,rr.sesi2) END <"00:40:00" OR
            CASE WHEN new_sesi1 > new_sesi2 THEN TIMEDIFF(new_sesi1,new_sesi2)ELSE TIMEDIFF(new_sesi2,new_sesi1) END <"00:40:00"
        )
        AND
        (rr.id_rombel=id_rombel) AND (rr.Hari=hari));
                END;
        ');

        //function mengenerate nig guru
        DB::unprepared('
        CREATE OR REPLACE FUNCTION generate_nig (angkatan VARCHAR(2),no_urut VARCHAR(3)) RETURNS VARCHAR(7)
            BEGIN
            DECLARE res VARCHAR(7);
            DECLARE kode_guru VARCHAR(2);
            SET kode_guru="02";
            SET res=(SELECT LPAD((CONCAT(angkatan,kode_siswa,no_urut)),7,0));
            return res;
            END;
        ');
            //function menentukan no urut guru di angkatan tersebut
        DB::unprepared('
        CREATE OR REPLACE FUNCTION no_urut (thn_aktif VARCHAR(2)) RETURNS VARCHAR(3)
            BEGIN
            DECLARE res VARCHAR(3);
            SET res=(SELECT COUNT(*) FROM teachers WHERE angkatan=thn_aktif) +1;
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
        
    }
};
