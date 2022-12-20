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
        //Trigger setelah daftar siswa ,masukkan siswa ke kelas yang tersedia jika ada
        DB::unprepared('
        CREATE OR REPLACE TRIGGER masuk_kelas AFTER INSERT ON students FOR EACH ROW
            BEGIN
            DECLARE res INT;
            SET res=(SELECT COUNT(*) FROM rombels r WHERE  (r.id_kelas=NEW.id_kelas) AND (r.SMP=NEW.SMP) AND (r.id_thnakademik=(SELECT th.id FROM tahun_akademiks th WHERE th.status="Aktif" LIMIT 1 )));
                IF res =1 THEN
                INSERT INTO rombel_siswas (id_rombel,id_siswa,created_at,updated_at)
                SELECT r.id ,NEW.NIS,now(),now() FROM rombels r WHERE  (r.id_kelas=NEW.id_kelas) AND (r.SMP=NEW.SMP) AND (r.id_thnakademik=(SELECT th.id FROM tahun_akademiks th WHERE th.status="Aktif" LIMIT 1 ));
                
                END IF;
            END;
        ');
      

        //Trigger validasi pengaktifan tahun ajaran
        DB::unprepared('
            CREATE OR REPLACE TRIGGER validasi_thnAjaran AFTER UPDATE ON tahun_akademiks FOR EACH ROW
                BEGIN
                CALL validasi_statusAkademik();
                END;
        ');
        //Trigger untuk Validasi insert untuk menentukan angkatan
        DB::unprepared('
            CREATE OR REPLACE TRIGGER angkatan_thnAka BEFORE INSERT ON tahun_akademiks FOR EACH ROW
            BEGIN
            SET NEW.angkatan=(SELECT COUNT(*) as row FROM tahun_akademiks)+1;
            END;
        ');

        //Trigger Menginsert siswa ke kelas masing2
        DB::unprepared('
            CREATE OR REPLACE TRIGGER atur_kelas AFTER INSERT ON rombels FOR EACH ROW
            BEGIN
            
             INSERT INTO rombel_siswas (id_rombel,id_siswa,created_at,updated_at)
              SELECT NEW.id, NIS,now(),now() FROM students s WHERE s.SMP=NEW.SMP AND s.id_kelas=NEW.id_kelas AND s.status="Aktif";
            END;
        ');

        //Trigger validasi roster kelas jika terjadi bentrok jam pada hari yang bersamaan Pake fungsi timediff
        DB::unprepared('
        CREATE OR REPLACE TRIGGER  validasi_roster BEFORE INSERT ON roster_rombels FOR EACH ROW
        BEGIN
        DECLARE vcheck INT;
        SET vcheck =( validasi_roster(NEW.id_rombel,NEW.sesi1,NEW.sesi2,NEW.Hari));
        IF vcheck > 0 THEN
            SIGNAL SQLSTATE "45000"
            SET MESSAGE_TEXT="Jadwal Bentrok";
        END IF;

        END;
        ');

        //trigger untuk membuat nilai tiap mapel seorang siswa di kelas tersebut 
        DB::unprepared('
        CREATE OR REPLACE TRIGGER nilaimapelsiswa AFTER INSERT ON rombel_siswas FOR EACH ROW
        BEGIN
            INSERT INTO nilai_siswas (id_rsiswa,id_mapel,created_at,updated_at)
            SELECT NEW.id, id,now(),now() FROM mapels ;
        END;
        ');

        //Triggwe untuk menyediakan absensi siswa di kelas tersebut
        DB::unprepared('
        CREATE OR REPLACE TRIGGER absensisiswa AFTER INSERT ON rombel_siswas FOR EACH ROW
        BEGIN
            INSERT INTO absensi_siswas (id_rsiswa,created_at,updated_at)
            SELECT NEW.id, now(),now()  ;
        END;
        ');

        //trigger tahun akademiks jika kita mengupdate pembelejaran jadi selesai maka update tingkat Smp menjadi diatasny
        //jika siswa berada di kelas 3 dan naek kelas maka akan mengupdate status siswa tsb menjadi tamat

        DB::unprepared('
        CREATE OR REPLACE TRIGGER selesai_thnajaran BEFORE UPDATE ON tahun_akademiks FOR EACH ROW
        BEGIN 

            IF (OLD.Pembelajaran !=NEW.Pembelajaran) THEN
            UPDATE students
                SET 
                status=(CASE WHEN SMP=3 THEN "Tamat" ELSE status END),
                SMP=( CASE WHEN SMP  <3 THEN SMP+1 ELSE SMP END)
             
                WHERE status ="Aktif";
            END IF;
        END;
        ');

        //Trigger tahun akademik tidak bs dinonaktifkan jika Pembelajaran belum selesai
        DB::unprepared('
        CREATE OR REPLACE TRIGGER cek_pembelajaran BEFORE UPDATE ON tahun_akademiks FOR EACH ROW
        BEGIN
            IF( NEW.status = "Tidak Aktif" AND OLD.status ="Aktif") THEN
                IF OLD.Pembelajaran ="Belum Selesai" THEN
                    SIGNAL SQLSTATE "45000"
                    SET MESSAGE_TEXT="Selesaikan Pembelajaran Terlebih Dahulu";
                END IF;
            END IF;
        END;
        
        ');

        //TRigger  tahun akademik jika pembelajaran selesai tidak bs mengedit pembelajaran menjadi belum selesai
        DB::unprepared('
            CREATE OR REPLACE TRIGGER jangan_update_pembelajaran BEFORE UPDATE ON tahun_akademiks FOR EACH ROW
            BEGIN
                IF(NEW.Pembelajaran ="Belum Selesai" AND OLD.Pembelajaran="Selesai") THEN
                SIGNAL SQLSTATE "45000"
                SET MESSAGE_TEXT="Pembelajaran Telah Selesai, Tidak bs di update Pembelajaran";
                END IF;

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
