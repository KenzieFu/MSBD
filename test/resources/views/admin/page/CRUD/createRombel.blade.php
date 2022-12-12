@extends('admin.layout.template')
@section('adminContent')

    <div class="border  shadow-lg  mx-40 p-2 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 ">
    <div class="flex justify-center items-center">
        <h1 class="text-2xl text-white">Tambah Rombel</h1>
    </div>
    <div class="m-5 text-xl text-black font-bold">
        <form action="{{ route('admin.cRombel') }}" method="POST">
            @csrf
        <div class="flex flex-col gap-3 items-center ">
            
       

        <div class="flex  justify-around gap-5  -ml-[220px] items-end left-0">
            <label class="flex items-center   text-white" for="wali">Wali Kelas</label>
            @if($wali == null)
                
                    <div>Guru Tidak Ada Yang Tersisa</div>
                
                @else
            <select  class=" h-10 " name="wali" id="wali">
                
                
                @foreach($wali as $w)
                <option value={{ $w->id }}>{{ $w->name }}</option>
                @endforeach
            </select>
            @endif

        </div>
        <div class="flex  justify-around gap-5  -ml-[220px] items-end left-0">
            <label class="flex items-center   text-white" for="SMP">SMP</label>
            <select required class=" h-10 " name="SMP" id="SMP">
                <option value='1'>1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>

        </div>
        <div class="flex  justify-around gap-5  -ml-[220px] items-end left-0">
            <label class="flex items-center   text-white  ml-4" for="gender">Kelas</label>
            <select required class=" h-10  " name="kelas" id="Kelas">
                @foreach ($daftarkelas as $kelas)
                <option value={{ $kelas->id }}>{{ $kelas->nama_kelas }}</option>
                @endforeach
            </select>

        </div>

        <div class="mt-5">
            <button type="submit" class="bg-green-400 flex  justify-center align-center p-2 rounded-lg text-white">Tambahkan</button>
        </div>
        
        </div>
    </form>
    </div>
</div>

@endsection