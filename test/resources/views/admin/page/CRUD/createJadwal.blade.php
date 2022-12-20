@extends('admin.layout.template')
@section('adminContent')

    <div class="m-2 p-2">Kelas&nbsp;{{ $rombel->nama_kelas }}&nbsp;,SMP&nbsp;{{ $rombel->SMP }}&nbsp;,Tahun Ajaran :{{ $rombel->TahunAjaran }}, 1 Sesi = 40 menit</div>
    <div class="border  shadow-lg  mx-40 p-2 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 ">
    <div class="flex justify-center items-center">
        <h1 class="text-2xl text-white">Tambah Jadwal</h1>
    </div>
    <div class="m-5 text-xl text-black font-bold">
        <form method="POST" action="{{ route('admin.cJadwal') }}" >
            @csrf
        <div class="flex flex-col gap-3 items-center ">
            
            <input type="hidden" name="id_rombel" value="{{ $rombel->id }}">
       
        <div class="flex  justify-around gap-5  -ml-[220px] items-end left-0">
            <label class="flex items-center   text-white" for="mapel">Mapel</label>
            <select required class=" h-10 " name="id_mapel" id="mapel">
                @foreach($mapel as $mp)
                <option value="{{ $mp->id }}">{{ $mp->mapel }}</option>
                @endforeach
            </select>

        </div>
        <div class="flex  justify-around gap-5  -ml-[220px] items-end left-0">
            <label class="flex items-center   text-white" for="hari">Hari</label>
            <select required class=" h-10 " name="hari" id="hari">
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Kamis">Jumat</option>
                <option value="Kamis">Sabtu</option>
            </select>

        </div>

        
        
        <div class="flex  justify-around gap-5  -ml-[220px] items-end left-0">
            <label class="flex items-center   text-white" for="guru">Wali</label>
            <select required class=" h-10 " name="id_guru" id="guru">
                @foreach($teacher as $t)
                <option value="{{ $t->NIG }}">{{ $t->alias }}</option>
                @endforeach
            </select>

        </div>
        <div class="flex  justify-around gap-5  -ml-[220px] items-end left-0">
            <label class="flex items-center   text-white" for="sesi1">Sesi 1</label>
        <input required type="time" id="sesi1" name="sesi1">
        </div>
        <div  class="flex  justify-around gap-5  -ml-[220px] items-end left-0">
            <label class="flex items-center   text-white" for="sesi1">Sesi 2</label>
        <input required type="time" id="sesi2" name="sesi2">
        </div>
     
     

        <div class="mt-5">
            <button type="submit" class="bg-green-400 flex  justify-center align-center p-2 rounded-lg text-white">Tambahkan</button>
        </div>
        
        </div>
    </form>
    </div>
</div>

@endsection