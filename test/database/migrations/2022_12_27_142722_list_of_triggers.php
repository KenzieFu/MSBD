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

        //Trigger insert validasi roster kelas jika terjadi bentrok jam pada hari yang bersamaan Pake fungsi timediff
        DB::unprepared('
        CREATE OR REPLACE TRIGGER  insert_validasi_roster BEFORE INSERT ON roster_rombels FOR EACH ROW
        BEGIN
        DECLARE vcheck INT;
        SET vcheck =( validasi_roster(NEW.id,NEW.id_rombel,NEW.sesi1,NEW.sesi2,NEW.Hari));
        IF vcheck > 0 THEN
            SIGNAL SQLSTATE "45000"
            SET MESSAGE_TEXT="Jadwal Bentrok";
        END IF;

        END;
        ');
        //Trigger update validasi roster kelas jika terjadi bentrok jam pada hari yang bersamaan Pake fungsi timediff
        DB::unprepared('
        CREATE OR REPLACE TRIGGER  update_validasi_roster BEFORE UPDATE ON roster_rombels FOR EACH ROW
        BEGIN
        DECLARE vcheck INT;
        SET vcheck =( validasi_roster(NEW.id,NEW.id_rombel,NEW.sesi1,NEW.sesi2,NEW.Hari));
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
            SELECT NEW.id, id,now(),now() FROM mapels WHERE status ="Aktif" ;
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
        //Triggwe utk memeriksa jika kita tidak bs membuat pembelajaran di tahun tersebut jika tahun tersebut blm aktif
        DB::unprepared('
            CREATE OR REPLACE TRIGGER validasi_update_pembelajaran BEFORE UPDATE ON tahun_akademiks FOR EACH ROW
            BEGIN
                IF(OLD.status="Tidak Aktif") THEN
                    IF(NEW.Pembelajaran="Selesai" AND OLD.Pembelajaran="Belum Selesai")THEN
                    SIGNAL SQLSTATE "45000"
                    SET MESSAGE_TEXT="Tahun Ajaran harus Aktif terlebih Dahulu";
                    END IF;
                END IF;
            END;
        ');

        //Trigger validasi siswa jika sudah tamat kita tidak boleh mengganti statusny menjadi aktif/tidak aktif
        DB::unprepared('
            CREATE OR REPLACE TRIGGER siswa_tamat BEFORE UPDATE ON students FOR EACH ROW
            BEGIN
                IF(NEW.status !="Tamat" AND OLD.status="Tamat") THEN
                SIGNAL SQLSTATE "45000"
                SET MESSAGE_TEXT="Tidak Bisa Merubah Status Siswa Jika Siswa Sudah Tamat";
                END IF;
            END;
        ');

        //Trigger insert intinya agar tidak wali kelas yang mempunyai 2 kelas dimana dia sebagai wakel di tahun ajaran tersebut
        DB::unprepared('
            CREATE OR REPLACE TRIGGER validasi_insert_penentuan_wali BEFORE INSERT  ON rombels FOR EACH ROW
            BEGIN
            DECLARE vcheck int;
       

            SET vcheck:=(SELECT COUNT(*) FROM teachers t WHERE status="Aktif" AND EXISTS(SELECT * FROM rombels r WHERE r.id_thnakademik =NEW.id_thnakademik && r.id_wali=NEW.id_wali));
            IF(vcheck>0) THEN 
            SIGNAL SQLSTATE "45000"
            SET MESSAGE_TEXT="Guru ini  telah menjadi wali kelas di kelas lain";
            END IF;

            END;
        ');
        //Trigger iupdate intinya agar tidak wali kelas yang mempunyai 2 kelas dimana dia sebagai wakel di tahun ajaran tersebut
        DB::unprepared('
            CREATE OR REPLACE TRIGGER validasi_update_penentuan_wali BEFORE UPDATE  ON rombels FOR EACH ROW
            BEGIN

            DECLARE vcheck int;
          

            SET vcheck:=(SELECT COUNT(*) FROM teachers t WHERE status="Aktif" AND  EXISTS(SELECT * FROM rombels r WHERE r.id_thnakademik =NEW.id_thnakademik && r.id_wali=NEW.id_wali));
            IF(vcheck>0) THEN 
            SIGNAL SQLSTATE "45000"
            SET MESSAGE_TEXT="Guru ini  telah menjadi wali kelas di kelas lain";
            END IF;

            END;
        ');

        //trigger update validasi guru mapel di satu rombel gk boleh ada dua/lebih guru yang berbeda pada satu mata pelajaran
        DB::unprepared('
        CREATE OR REPLACE TRIGGER update_jadwal_mapel_guru BEFORE UPDATE ON roster_rombels FOR EACH ROW
        BEGIN
        DECLARE vcheck VARCHAR(7);
          

        SET vcheck:=(SELECT id_guru from roster_rombels WHERE id_rombel=NEW.id_rombel AND id_mapel=NEW.id_mapel AND id!=NEW.id LIMIT 1);

        IF(vcheck != NEW.id_guru AND !ISNULL(vcheck)) THEN
            SIGNAL SQLSTATE "45000"
            SET MESSAGE_TEXT="Satu Mapel Hanya Boleh diajari oleh satu guru saja";
        END IF;
        END;
        
        ');
        //trigger insert validasi guru mapel di satu rombel gk boleh ada dua/lebih guru yang berbeda pada satu mata pelajaran
        DB::unprepared('
        CREATE OR REPLACE TRIGGER insert_jadwal_mapel_guru BEFORE INSERT ON roster_rombels FOR EACH ROW
        BEGIN
        DECLARE vcheck VARCHAR(7);
          
        SET vcheck:=(SELECT id_guru from roster_rombels WHERE id_rombel=NEW.id_rombel AND id_mapel=NEW.id_mapel AND id!=NEW.id LIMIT 1);

        IF(vcheck != NEW.id_guru AND !ISNULL(vcheck)) THEN
            SIGNAL SQLSTATE "45000"
            SET MESSAGE_TEXT="Satu Mapel Hanya Boleh diajari oleh satu guru saja";
        END IF;
        
        END;
        
        ');
        //17 trigger validasi


        //Table Untuk Log semua aktivitas
        //1.Siswa

        DB::unprepared('
        CREATE OR REPLACE TRIGGER log_insert_siswa AFTER INSERT ON students FOR EACH ROW
        BEGIN
     
        DECLARE text TEXT;
        SET text=CONCAT("Menambahkan Siswa dengan NIS ",NEW.NIS);
     
        
        INSERT INTO log_aktivitas (aktivitas,status,created_at,updated_at)
        SELECT text,"insert",now(),now();
        END;
        
        ');
        DB::unprepared('
        CREATE OR REPLACE TRIGGER log_update_siswa AFTER UPDATE ON students FOR EACH ROW
        BEGIN
    
        DECLARE text TEXT;
        SET text=CONCAT("Mengubah Siswa dengan NIS ",NEW.NIS);
     
        
        INSERT INTO log_aktivitas (aktivitas,status,created_at,updated_at)
        SELECT text,"update",now(),now();
        END;
        
        ');
        DB::unprepared('
        CREATE OR REPLACE TRIGGER log_delete_siswa AFTER DELETE ON students FOR EACH ROW
        BEGIN
    
        DECLARE text TEXT;
        SET text=CONCAT("Menghapus Siswa dengan NIS ",OLD.NIS);
     
        
        INSERT INTO log_aktivitas (aktivitas,status,created_at,updated_at)
        SELECT text,"delete",now(),now();
        END;
        
        ');
        //2.Trigger Guru
        DB::unprepared('
            CREATE OR REPLACE TRIGGER log_insert_guru AFTER INSERT ON teachers FOR EACH ROW
            BEGIN
            DECLARE text TEXT;
            SET text=CONCAT("Menambah Guru dengan NIG ",NEW.NIG);
     
        
            INSERT INTO log_aktivitas (aktivitas,status,created_at,updated_at)
            SELECT text,"insert",now(),now();
        END;
        ');
        DB::unprepared('
            CREATE OR REPLACE TRIGGER log_update_guru AFTER update ON teachers FOR EACH ROW
            BEGIN
            DECLARE text TEXT;
            SET text=CONCAT("Mengupdate Guru dengan NIG ",NEW.NIG);
     
        
            INSERT INTO log_aktivitas (aktivitas,status,created_at,updated_at)
            SELECT text,"update",now(),now();
        END;
        ');
        DB::unprepared('
            CREATE OR REPLACE TRIGGER log_delete_guru AFTER DELETE ON teachers FOR EACH ROW
            BEGIN
            DECLARE text TEXT;
            SET text=CONCAT("Menghapus Guru dengan NIG ",OLD.NIG);
     
        
            INSERT INTO log_aktivitas (aktivitas,status,created_at,updated_at)
            SELECT text,"delete",now(),now();
        END;
        ');

        //Trigger kelas
        DB::unprepared('
        CREATE OR REPLACE TRIGGER log_insert_kelas AFTER INSERT ON kelas FOR EACH ROW
        BEGIN
        DECLARE text TEXT;
        SET text=CONCAT("Menambah Kelas dengan id ",NEW.id);
 
        INSERT INTO log_aktivitas (aktivitas,status,created_at,updated_at)
        SELECT text,"insert",now(),now();

        
        END;  
        ');

        DB::unprepared('
        CREATE OR REPLACE TRIGGER log_update_kelas AFTER UPDATE ON kelas FOR EACH ROW
        BEGIN
        DECLARE text TEXT;
        SET text=CONCAT("Mengubah Kelas dengan id  ",NEW.id);
 
        INSERT INTO log_aktivitas (aktivitas,status,created_at,updated_at)
        SELECT text,"update",now(),now();

        END;  
        ');

        DB::unprepared('
        CREATE OR REPLACE TRIGGER log_delete_kelas AFTER DELETE ON kelas FOR EACH ROW
        BEGIN
        DECLARE text TEXT;
        SET text=CONCAT("Mendelete Kelas dengan id  ",OLD.id);
 
        INSERT INTO log_aktivitas (aktivitas,status,created_at,updated_at)
        SELECT text,"delete",now(),now();

        END;  
        ');


        //Mapel
        DB::unprepared('
        CREATE OR REPLACE TRIGGER log_insert_mapel AFTER INSERT ON mapels FOR EACH ROW
        BEGIN
        DECLARE text TEXT;
        SET text=CONCAT("Menambah Mapel dengan id  ",NEW.id);
 
        INSERT INTO log_aktivitas (aktivitas,status,created_at,updated_at)
        SELECT text,"insert",now(),now();
        END;  
        ');
        
        DB::unprepared('
        CREATE OR REPLACE TRIGGER log_update_mapel AFTER UPDATE ON mapels FOR EACH ROW
        BEGIN
        DECLARE text TEXT;
        SET text=CONCAT("Mengubah Mapel dengan id  ",NEW.id);
 
        INSERT INTO log_aktivitas (aktivitas,status,created_at,updated_at)
        SELECT text,"update",now(),now();
        END;  
        ');
        
        DB::unprepared('
        CREATE OR REPLACE TRIGGER log_delete_mapel AFTER DELETE ON mapels FOR EACH ROW
        BEGIN
        DECLARE text TEXT;
        SET text=CONCAT("Menghapus Mapel dengan id  ",OLD.id);
 
        INSERT INTO log_aktivitas (aktivitas,status,created_at,updated_at)
        SELECT text,"delete",now(),now();
        END;  
        ');
        
        //Rombel
        DB::unprepared('
        CREATE OR REPLACE TRIGGER log_insert_rombel AFTER INSERT ON rombels FOR EACH ROW
        BEGIN
        DECLARE text TEXT;
        SET text=CONCAT("Menambah rombel dengan id  ",NEW.id);
 
        INSERT INTO log_aktivitas (aktivitas,status,created_at,updated_at)
        SELECT text,"insert",now(),now();
        END;  
        ');
        
        DB::unprepared('
        CREATE OR REPLACE TRIGGER log_update_rombel AFTER UPDATE ON rombels FOR EACH ROW
        BEGIN
        DECLARE text TEXT;
        SET text=CONCAT("Mengubah rombel dengan id  ",NEW.id);
 
        INSERT INTO log_aktivitas (aktivitas,status,created_at,updated_at)
        SELECT text,"update",now(),now();
        END;  
        ');
        
        DB::unprepared('
        CREATE OR REPLACE TRIGGER log_delete_rombel AFTER DELETE ON rombels FOR EACH ROW
        BEGIN
        DECLARE text TEXT;
        SET text=CONCAT("Mengdelete rombel dengan id  ",OLD.id);
 
        INSERT INTO log_aktivitas (aktivitas,status,created_at,updated_at)
        SELECT text,"delete",now(),now();
        END;  
        ');

        //Pengumuman
        DB::unprepared('
        CREATE OR REPLACE TRIGGER log_insert_pengumuman AFTER INSERT ON announcements FOR EACH ROW
        BEGIN
        DECLARE text TEXT;
        SET text=CONCAT("Menambah pengumuman dengan id  ",NEW.id);
 
        INSERT INTO log_aktivitas (aktivitas,status,created_at,updated_at)
        SELECT text,"insert",now(),now();
        END;  
        ');
        
        DB::unprepared('
        CREATE OR REPLACE TRIGGER log_delete_pengumuman AFTER DELETE ON announcements FOR EACH ROW
        BEGIN
        DECLARE text TEXT;
        SET text=CONCAT("Menghapus pengumuman dengan id  ",OLD.id);
 
        INSERT INTO log_aktivitas (aktivitas,status,created_at,updated_at)
        SELECT text,"delete",now(),now();
        END;  
        ');

        //jadwal
        DB::unprepared('
        CREATE OR REPLACE TRIGGER log_insert_roster AFTER INSERT ON roster_rombels FOR EACH ROW
        BEGIN
        DECLARE text TEXT;
        SET text=CONCAT("Menambah jadwal dengan id  ",NEW.id," Pada Rombel dengan id ",NEW.id_rombel);
 
        INSERT INTO log_aktivitas (aktivitas,status,created_at,updated_at)
        SELECT text,"insert",now(),now();
        END;  
        ');
        DB::unprepared('
        CREATE OR REPLACE TRIGGER log_update_roster AFTER UPDATE ON roster_rombels FOR EACH ROW
        BEGIN
        DECLARE text TEXT;
        SET text=CONCAT("Mengubah jadwal dengan id  ",NEW.id," Pada Rombel dengan id ",NEW.id_rombel);
 
        INSERT INTO log_aktivitas (aktivitas,status,created_at,updated_at)
        SELECT text,"update",now(),now();
        END;  
        ');
        
        DB::unprepared('
        CREATE OR REPLACE TRIGGER log_update_roster AFTER DELETE ON roster_rombels FOR EACH ROW
        BEGIN
        DECLARE text TEXT;
        SET text=CONCAT("Menghapus jadwal dengan id  ",OLD.id," Pada Rombel dengan id ",OLD.id_rombel);
 
        INSERT INTO log_aktivitas (aktivitas,status,created_at,updated_at)
        SELECT text,"delete",now(),now();
        END;  
        ');

        //NIlai
        DB::unprepared('
            CREATE OR REPLACE TRIGGER log_nilai AFTER UPDATE ON nilai_siswas FOR EACH ROW
            BEGIN
            
            INSERT INTO log_nilais (id_rombel,nama_mapel,NIS,nilai_lama,nilai_baru,created_at,updated_at)
            SELECT rs.id_rombel,m.mapel,rs.id_siswa,OLD.nilai,NEW.nilai,now(),now() FROM nilai_siswas ns INNER JOIN rombel_siswas rs ON rs.id=ns.id_rsiswa INNER JOIN mapels m ON m.id=ns.id_mapel WHERE ns.id=NEW.id;
            END;
        ');

        //absensi
        DB::unprepared('
            CREATE OR REPLACE TRIGGER log_absensi_siswa AFTER UPDATE ON absensi_siswas FOR EACH ROW
            BEGIN

            INSERT INTO log_absensi_siswas(id_rombel,NIS,absen_lama,izin_lama,sakit_lama,absen_baru,izin_baru,sakit_baru,created_at,updated_at)
            SELECT rs.id_rombel,rs.id_siswa,OLD.absen,OLD.izin,OLD.sakit,NEW.absen,NEW.izin,NEW.sakit,now(),now() FROM absensi_siswas abs  INNER JOIN rombel_siswas rs ON rs.id=abs.id_rsiswa WHERE abs.id=NEW.id; 
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


/* DECLARE checkthn int;
SET checkthn :=(SELECT COUNT(*) FROM tahun_akademiks WHERE status="Aktif" AND id=NEW.id);
IF(checkthn = 0) THEN
SIGNAL SQLSTATE "45000"
SET MESSAGE_TEXT="Tahun Akademik Belum Aktif";
END IF; */