@extends('teacher.layout.template')
@section('teacherContent')


<div class="max-w m-3 p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
    <a href="#">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Kelas&nbsp;{{ $rombel->nama_kelas }}</h5>
    </a>
    <div class="mb-3 flex-col flex font-normal text-gray-700 dark:text-gray-400">
        <span>SMP          :{{ $rombel->SMP }}</span>
        <span>Jumlah Siswa :{{ $rombel->jumlah }}</span>
        <span>Tahun Ajaran  :{{ $rombel->TahunAjaran }}</span>
        <span>Wali Kelas  :{{ $rombel->name }}</span>
    </div>
   
    <div class="flex gap-x-3 ">
        <form  action={{ route('teacher.rombelsiswa') }}>
            @csrf
            <input type="hidden" name="id_rombel" value={{ $rombel->id }}>
      
    <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Daftar Siswa  
    </button>
        </form >
        <form  action={{ route('teacher.jadwal_kelas') }}>
            @csrf
            <input type="hidden" name="id_rombel" value={{ $rombel->id }}>
    <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Jadwal Mapel  
    </button>
        
        </form>
        <form  action={{ route('teacher.nilaisiswa') }}>
            @csrf
            <input type="hidden" name="id_rombel" value="{{ $rombel->id }}">
    <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Rekap Nilai  
    </button>
        </form>
        <form  action={{ route('teacher.absensiswa') }}>
            @csrf
            <input type="hidden" value="{{ $rombel->id }}" name="id_rombel">
            <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Rekap Absensi  
            </button>
        </form>
</div>
</div>

<div class=" max-w p-4 m-5 bg-white border rounded-lg shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
    <form method="POST"  action={{ route('teacher.updtAbsensi') }}>
        <input type="hidden" name="id_rombel" value={{ $rombel->id }}>
        @csrf
    <div class="flex items-center justify-between mb-4">
        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Absensi Siswa</h5>
        @if($rombel->status == "Aktif")
        <button type="submit" class="bg-green-400 flex  justify-center align-center p-2 rounded-lg text-white">Update Absensi</button>
        @endif
       
   </div>
   <div class="flow-root">
        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
            
          
            @foreach($absensi_siswa as $as)
            <li class="py-3 sm:py-4">
                <div class="flex items-center space-x-4">
                   
                    <div class="flex-1 min-w-0">
                        <p class="text-lg font-medium text-gray-900 truncate dark:text-white">
                            {{ $as->name }}
                        </p>
                        <p class="text-lg text-gray-500 truncate dark:text-gray-400">
                            {{ $as->NIS }}
                        </p>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        @if($rombel->status =="Aktif")
                            <input type="hidden" name="id[]" value={{ $as->id }} >
                            
                           <label for="absen">Absen :</label>
                           <input value="{{ $as->absen }}" type="number" min="0" max="100" onKeyUp="if(this.value>100){this.value='100';}else if(this.value<0){this.value='0';} else if(this.value==0){this.value='0';}"
                        name="absen[]">
                           <label for="absen">Sakit :</label>
                           <input value="{{ $as->sakit }}" type="number" min="0" max="100" onKeyUp="if(this.value>100){this.value='100';}else if(this.value<0){this.value='0';} else if(this.value==0){this.value='0';}"
                        name="sakit[]">
                           <label for="absen">Izin :</label>
                           <input value="{{ $as->izin }}" type="number" min="0" max="100" onKeyUp="if(this.value>100){this.value='10';}else if(this.value<0){this.value='0';} else if(this.value==0){this.value='0';}"
                        name="izin[]">
                        @else
                        <div>Absen : {{ $as->absen }} &nbsp; &nbsp;</div>
                        <div>Sakit : {{ $as->sakit }} &nbsp; &nbsp;</div>
                        <div>Izin : {{ $as->izin }} &nbsp; &nbsp;</div>
                       @endif
                      
                        
                    </div>
                </div>
                @endforeach
            
           
        </ul>
   </div>
</div>

@endsection