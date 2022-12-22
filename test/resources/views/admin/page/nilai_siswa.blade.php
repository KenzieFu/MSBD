@extends('admin.layout.template')
@section('adminContent')
<div class="max-w m-3 p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
    <a href="#">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Kelas&nbsp;{{ $rombel->nama_kelas }}</h5>
    </a>
    <div class="mb-3 flex-col flex font-normal text-gray-700 dark:text-gray-400">
        <span>SMP          :{{ $rombel->SMP }}</span>
        <span>Jumlah Siswa :{{ $rombel->jumlah }}</span>
        <span>Tahun Ajaran  :{{ $rombel->TahunAjaran }}</span>
        <span>Wali Kelas  :{{ $rombel->name??"Pending" }}</span>
    </div>
   
    <div class="flex gap-x-3 ">
        <form  action={{ route('admin.detailsrombel',$rombel->id) }}>
            @csrf
      
    <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Daftar Siswa  
    </button>
        </form >
        <form  action={{ route('admin.vroster',$rombel->id) }}>
            @csrf
           
    <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Jadwal Mapel  
    </button>
        
        </form>
        <form  action={{ route('admin.nilaisiswa') }}>
            @csrf
            <input type="hidden" name="id_rombel" value="{{ $rombel->id }}">
    <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Rekap Nilai  
    </button>
        </form>
        <form  action={{ route('admin.absensisiswa') }}>
            @csrf
            <input type="hidden" value="{{ $rombel->id }}" name="id_rombel">
            <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Rekap Absensi  
            </button>
        </form>
</div>
</div>

<div class=" max-w p-4 m-5 bg-white border rounded-lg shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
    <div class="flex items-center justify-between mb-4">
        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Daftar Siswa</h5>
       
   </div>
   <div class="flow-root">
        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
            
          
            @foreach($daftar_siswa as $ds)
            <li class="py-3 sm:py-4">
                <div class="flex items-center space-x-4">
                   
                    <div class="flex-1 min-w-0">
                        <p class="text-lg font-medium text-gray-900 truncate dark:text-white">
                            {{ $ds->name }}
                        </p>
                        <p class="text-lg text-gray-500 truncate dark:text-gray-400">
                            {{ $ds->NIS }}
                        </p>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        <form action={{ route('admin.updateNilai') }}>
                            @csrf
                            <input type="hidden" name="id_rsiswa" value={{ $ds->id }} >
                            <input type="hidden" name="id_rombel" value={{ $rombel->id }}>
                            <input type="hidden" name="NIS" value={{ $ds->NIS }}>
                        <button class="rounded-lg bg-green-500 text-white p-1">Nilai Siswa</button>
                        </form>
                        
                    </div>
                </div>
                @endforeach
            
           
        </ul>
   </div>
</div>
    
@endsection