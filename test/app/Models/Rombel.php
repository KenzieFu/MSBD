<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;

class Rombel extends Model
{
    use HasFactory;

    public function wali()
    {
        return $this->belongsTo(Teacher::class,'id_wali');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class,'id_kelas');
    }

    public function tahun(){
        return $this->belongsTo(TahunAkademik::class,'id_thnakademik');
    }


}
