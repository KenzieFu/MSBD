@extends('admin.layout.template')
@section('adminContent')

    <div class="m-2 p-2">Kelas&nbsp;{{ $roster->nama_kelas }}&nbsp;,SMP&nbsp;{{ $roster->SMP }}&nbsp;,Tahun Ajaran :{{ $roster->TahunAjaran }}, 1 Sesi = 40 menit</div>
    <div class="m-3">
        <form  action={{ route('admin.vroster',$roster->id_rombel) }}>
            @csrf
        <button type="submit" class="bg-blue-400 flex  justify-center align-center p-2 rounded-lg text-white">Back</button>
    </form>
    </div>
    <div class="border  shadow-lg  mx-40 p-2 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 ">
    <div class="flex justify-center items-center">
        <h1 class="text-2xl text-white">Update Jadwal</h1>
    </div>
    <div class="m-5 text-xl text-black font-bold">
        <form method="POST" action="{{ route('admin.updateJadwal') }}" >
            @csrf
        <div class="flex flex-col gap-3 items-center ">
            <input type="hidden" name="id_rombel" value="{{ $roster->id_rombel }}">
            
            <input type="hidden" name="id_roster" value="{{ $roster->id }}">
       
        <div class="flex  justify-around gap-5  -ml-[220px] items-end left-0">
            <label class="flex items-center   text-white" for="mapel">Mapel</label>
            <select required class=" h-10 " name="id_mapel" id="mapel">
                @foreach($mapel as $mp)
                <option @php if($roster->id_mapel ==$mp->id) echo "selected" @endphp value="{{ $mp->id }}">{{ $mp->mapel }}</option>
                @endforeach
            </select>

        </div>
        <div class="flex  justify-around gap-5  -ml-[220px] items-end left-0">
            <label class="flex items-center   text-white" for="hari">Hari</label>
            <select required class=" h-10 " name="hari" id="hari">
                <option @php if($roster->Hari =="Senin") echo "selected" @endphp value="Senin">Senin</option>
                <option @php if($roster->Hari =="Selasa") echo "selected" @endphp value="Selasa">Selasa</option>
                <option @php if($roster->Hari =="Rabu") echo "selected" @endphp value="Rabu">Rabu</option>
                <option @php if($roster->Hari =="Kamis") echo "selected" @endphp value="Kamis">Kamis</option>
                <option @php if($roster->Hari =="Jumat") echo "selected" @endphp value="Kamis">Jumat</option>
                <option @php if($roster->Hari =="Sabtu") echo "selected" @endphp value="Kamis">Sabtu</option>
            </select>

        </div>
   

        
        
        <div class="flex  justify-around gap-5  -ml-[220px] items-end left-0">
            <label class="flex items-center   text-white" for="guru">Wali</label>
            <select required class=" h-10 " name="id_guru" id="guru">
                @foreach($teacher as $t)
                <option @php if($roster->NIG ==$t->NIG) echo "selected" @endphp value="{{ $t->NIG }}">{{ $t->alias }}</option>
                @endforeach
            </select>

        </div>
        <div class="flex  justify-around gap-5  -ml-[220px] items-end left-0">
            <label class="flex items-center   text-white" for="sesi1">Sesi 1</label>
        <input value="{{ $roster->sesi1 }}" required type="time" id="sesi1" name="sesi1">
        </div>
        <div  class="flex  justify-around gap-5  -ml-[220px] items-end left-0">
            <label class="flex items-center   text-white" for="sesi1">Sesi 2</label>
        <input required value="{{ $roster->sesi2 }}" type="time" id="sesi2" name="sesi2">
        </div>
     
     

        <div class="mt-5">
            <button type="submit" class="bg-green-400 flex  justify-center align-center p-2 rounded-lg text-white">Update</button>
        </div>
        
        </div>
    </form>
    </div>
</div>

@endsection