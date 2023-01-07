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
        DB::unprepared('CREATE OR REPLACE VIEW view_data_siswa AS SELECT s.*,th.TahunAjaran,kota.Kota,kec.Kecamatan,kel.Kelurahan,kel.Kode_Pos,p_cek_akun(s.NIS) as Cek_Akun,sts.tingkat FROM students s INNER JOIN tahun_akademiks th ON th.id=s.Tahun_Masuk INNER JOIN kelurahans kel ON kel.id=s.id_kelurahan INNER JOIN kecamatans kec ON kec.id=s.id_kecamatan INNER JOIN kotas kota ON kota.id=s.Tempat_Lahir INNER JOIN status_tingkatan_siswas sts ON sts.id=s.tingkatan');

        //Menampilkan view guru
        DB::unprepared('CREATE OR REPLACE VIEW data_guru AS SELECT t.*, th.TahunAjaran as Tahun_Masuk,k.Kota ,p_cek_akun(t.NIG) as Cek_Akun  FROM teachers t INNER JOIN tahun_akademiks th ON th.id=t.Tahun_Daftar INNER JOIN kotas k ON k.id=t.Tempat_Lahir ');

        
        //Menampilkan data rombel berdasarkan tahun yang diaktifkan VIEW #2
        DB::unprepared('CREATE OR REPLACE VIEW data_rombel_thn AS SELECT r.id,r.id_thnakademik ,r.SMP ,k.nama_kelas, t.alias, t.NIG, th.TahunAjaran,jumlah_siswa(r.id) as jumlah  FROM rombels r INNER JOIN kelas k ON k.id=r.id_kelas LEFT JOIN teachers t ON t.NIG=r.id_wali INNER JOIN tahun_akademiks th ON th.id=r.id_thnakademik WHERE r.id_thnakademik=(SELECT th.id FROM tahun_akademiks th WHERE status ="Aktif" )');

        //Menampilkan semua data rombel  VIEW #3
        DB::unprepared('CREATE OR REPLACE VIEW data_rombel AS SELECT r.id ,r.SMP ,k.nama_kelas, t.alias,t.NIG, t.name, th.TahunAjaran,th.status,r.id_thnakademik, jumlah_siswa(r.id) as jumlah FROM rombels r INNER JOIN kelas k ON k.id=r.id_kelas LEFT JOIN teachers t ON t.NIG=r.id_wali INNER JOIN tahun_akademiks th ON th.id=r.id_thnakademik');

        //menampilkan daftar siswa di kelas/rombel  VIEW #4
        DB::unprepared('CREATE OR REPLACE VIEW data_rombel_siswa AS SELECT rs.id_rombel,r.SMP,k.nama_kelas,s.gender ,t.alias ,t.NIG ,s.name ,rs.id_siswa, s.NIS ,rs.id, r.id_thnakademik ,th.status,th.TahunAjaran,jumlah_siswa(rs.id_rombel) as jumlah,s.status as status_siswa,th.status as status_ajaran FROM rombel_siswas rs INNER JOIN students s ON s.NIS=rs.id_siswa INNER JOIN rombels r ON r.id=rs.id_rombel INNER JOIN tahun_akademiks th ON th.id=r.id_thnakademik INNER JOIN kelas k ON k.id=r.id_kelas LEFT JOIN teachers t ON t.NIG=r.id_wali');

        //Menampilkan Roster kelas View #5
        DB::unprepared('CREATE OR REPLACE VIEW roster_kelas AS SELECT rr.sesi1 ,rr.id_rombel, rr.sesi2 ,m.mapel, rr.id ,rr.Hari, t.name as nama_wali   FROM roster_rombels rr LEFT JOIN teachers t ON t.NIG=rr.id_guru INNER JOIN mapels m ON m.id=rr.id_mapel');

        //Menampilkan nilai mapel  VIEW #6
        DB::unprepared('CREATE OR REPLACE VIEW nilai_mapel_siswa AS SELECT ns.id_rsiswa,ns.id, m.mapel, ns.nilai,m.KKM FROM nilai_siswas ns INNER JOIN mapels m ON m.id=ns.id_mapel');

        //Menampilkan absensi siswa VIEW #7
        DB::unprepared('CREATE OR REPLACE VIEW absensisiswa AS SELECT abs.id,abs.id_rsiswa,rs.id_rombel, s.NIS, s.name ,abs.absen,abs.sakit,abs.izin FROM absensi_siswas abs INNER JOIN rombel_siswas rs ON rs.id=abs.id_rsiswa INNER JOIN students s ON s.NIS=rs.id_siswa ');

       

        //Menampilkan view semua roster
        DB::unprepared('CREATE OR REPLACE VIEW semua_jadwal AS SELECT rr.id,rr.id_rombel,rr.id_mapel,th.status,t.NIG,t.alias,k.nama_kelas ,r.SMP, m.mapel,rr.Hari,rr.sesi1,rr.sesi2,r.id_thnakademik,th.TahunAjaran,th.status as status_tahun,jumlah_siswa(rr.id_rombel) as jumlah FROM roster_rombels rr INNER JOIN rombels r ON r.id=rr.id_rombel INNER JOIN tahun_akademiks th ON th.id=r.id_thnakademik INNER JOIN kelas k ON k.id=r.id_kelas INNER JOIN mapels m ON m.id=rr.id_mapel LEFT JOIN teachers t ON t.NIG=rr.id_guru');
        
        //View yang memudahkan kita melakukan penginputan berdasarkan guru mapelny
        DB::unprepared('CREATE OR REPLACE VIEW input_nilai_mapel AS SELECT ns.id_rsiswa,ns.id,ns.id_mapel,s.NIS,s.name  as nama_siswa,rs.id_rombel, m.mapel,m.KKM, ns.nilai FROM nilai_siswas ns INNER JOIN rombel_siswas rs ON rs.id=ns.id_rsiswa INNER JOIN students s ON s.NIS=rs.id_siswa INNER JOIN mapels m ON m.id=ns.id_mapel');

        
        DB::unprepared('CREATE OR REPLACE VIEW view_daftar_absensi_guru AS SELECT dag.id,dag.id_thnakademik,t.NIG,t.name,th.TahunAjaran,dag.absen,dag.izin,dag.sakit  FROM daftar_absensi_gurus dag INNER JOIN tahun_akademiks th ON th.id=dag.id_thnakademik INNER JOIN teachers t ON t.NIG=dag.id_guru');
        
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
