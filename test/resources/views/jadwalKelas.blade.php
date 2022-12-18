@extends('layouts.template')
@section('siswaContent')

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
        <form  action={{ route('daftarsiswa') }}>
            @csrf
            <input type="hidden" name="id_rombel" value={{ $rombel->id }}>
            <input type="hidden" name="id_thnakademik" value={{ $rombel->id_thnakademik }}>
    <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Daftar Siswa  
    </button>
        </form>
        <form  action={{ route('nilaisiswa') }}>
            @csrf
            <input type="hidden" value={{ $rombel->id }} name="id_rombel">
    <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Jadwal Mapel  
    </button>
        </form>

        <form  action={{ route('nilaisiswa') }}>
            @csrf
            <input type="hidden" value={{ $rombel->id }} name="id_rombel">
    <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Nilai Anda 
    </button>
        </form>
        <form  action={{ route('absensiswa') }}>
            @csrf
            <input type="hidden" value="{{ $rombel->id }}" name="id_rombel">
    <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Absensi Anda  
    </button>
        </form>
</div>
</div>

<div class=" max-w p-4 m-5 bg-white border rounded-lg shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
    <div class="flex items-center justify-between mb-4">
        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Jadwal Mapel Kelas (Satu Sesi = 40 menit)</h5>
        
   </div>
   
            
            <div class="container">
                <table  class="table table-stripped mydatatable text-[15px]">
                 <thead class="bg-green-500">
                     <tr class="text-white text-xl font-bold">
                         <td>Id</td>
                         <td>Nama_Mapel</td>
                         <td>Hari</td>
                         <td>Guru Mapel</td>
                         <td>Sesi 1</td>
                         <td>Sesi 2</td>
                         
                     </tr>
                 </thead>                                    
                 <tbody>                                                         
                     @foreach ($roster as $r)                                     
                     <tr>
                         <td>{{ $r->id}}</td>
                         <td>{{ $r->mapel}}</td>
                         <td>{{ $r->Hari}}</td>
                         <td>{{ $r->nama_wali}}</td>
                         <td>{{ $r->sesi1}}</td>
                         <td>{{ $r->sesi2}}</td>
                        
                        
                     </tr>
                     @endforeach
                 </tbody>
                </table>
             </div>
         
            
           
    
</div>


@endsection