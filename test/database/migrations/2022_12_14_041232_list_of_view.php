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
        //Menampilkan data mahasiswa VIEW #1
        DB::unprepared('CREATE OR REPLACE VIEW data_siswa AS SELECT s.NIS,s.name,s.status,s.gender,s.SMP ,t.TahunAjaran , k.nama_kelas FROM students s INNER JOIN tahun_akademiks t ON s.angkatan=t.angkatan INNER JOIN kelas k ON s.id_kelas =k.id ');

        //Menampilkan data rombel berdasarkan tahun yang diaktifkan VIEW #2
        DB::unprepared('CREATE OR REPLACE VIEW data_rombel_thn AS SELECT r.id ,r.SMP ,k.nama_kelas, t.NIG, th.TahunAjaran,jumlah_siswa_kelas(r.id,r.id_thnakademik) as jumlah  FROM rombels r INNER JOIN kelas k ON k.id=r.id_kelas INNER JOIN teachers t ON t.NIG=r.id_wali INNER JOIN tahun_akademiks th ON th.id=r.id_thnakademik WHERE r.id_thnakademik=(SELECT th.id FROM tahun_akademiks th WHERE status ="Aktif" )');

        //Menampilkan semua data rombel  VIEW #3
        DB::unprepared('CREATE OR REPLACE VIEW data_rombel AS SELECT r.id ,r.SMP ,k.nama_kelas, t.NIG, th.TahunAjaran, jumlah_siswa_kelas(r.id,r.id_thnakademik) as jumlah FROM rombels r INNER JOIN kelas k ON k.id=r.id_kelas INNER JOIN teachers t ON t.NIG=r.id_wali INNER JOIN tahun_akademiks th ON th.id=r.id_thnakademik');

        //menampilkan daftar siswa di kelas/rombel  VIEW #4
        DB::unprepared('CREATE OR REPLACE VIEW data_rombel_siswa AS SELECT rs.id_rombel ,s.name ,rs.id_siswa, s.NIS ,rs.id  FROM rombel_siswas rs INNER JOIN students s ON s.NIS=rs.id_siswa ');

        //Menampilkan Roster kelas View #5
        DB::unprepared('CREATE OR REPLACE VIEW roster_kelas AS SELECT rr.sesi1 ,rr.id_rombel, rr.sesi2 ,m.mapel, rr.id ,rr.Hari, t.name as nama_wali   FROM roster_rombels rr INNER JOIN teachers t ON t.NIG=rr.id_guru INNER JOIN mapels m ON m.id=rr.id_mapel');

        //Menampilkan nilai mapel  VIEW #6
        DB::unprepared('CREATE OR REPLACE VIEW nilai_mapel_siswa AS SELECT ns.id_rsiswa,ns.id, m.mapel, ns.nilai FROM nilai_siswas ns INNER JOIN mapels m ON m.id=ns.id_mapel');

        //Menampilkan absensi siswa VIEW #7
        DB::unprepared('CREATE OR REPLACE VIEW absensisiswa AS SELECT abs.id,abs.id_rsiswa,rs.id_rombel, s.NIS, s.name ,abs.absen,abs.sakit,abs.izin FROM absensi_siswas abs INNER JOIN rombel_siswas rs ON rs.id=abs.id_rsiswa INNER JOIN students s ON s.NIS=rs.id_siswa ');
        
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
