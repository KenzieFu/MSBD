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
