@extends('teacher.layout.template')
@section('teacherContent')


<div class="max-w m-3 p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
    <a href="#">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Kelas&nbsp;{{ $jadwal->nama_kelas }}</h5>
    </a>
    <div class="mb-3 flex-col flex font-normal text-gray-700 dark:text-gray-400">
        <span>Mapel          :{{ $jadwal->mapel }}</span>
        
        <span>SMP          :{{ $jadwal->SMP }}</span>
        <span>Jumlah Siswa :{{ $jadwal->jumlah }}</span>
        <span>Tahun Ajaran  :{{ $jadwal->TahunAjaran }}</span>
        <span>Wali Kelas  :{{ $jadwal->alias }}</span>
    </div>
   
    <div class="flex gap-x-3 ">
       
        <a href="{{ route('teacher.mapelguru') }}" class="text-white text-lg bg-green-500 hover:no-underline hover:text-[18px] hover:opacity-50 p-2 rounded-lg">Back</a>
    
    </div>
</div>

<div class=" max-w p-4 m-5 bg-white border rounded-lg shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">

    <form action="{{ route('teacher.updtnilai') }}">
    <div class="flex items-center justify-between mb-4">
        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">{{ $jadwal->mapel }}</h5>
       
        <button class="text-white text-lg bg-green-500 hover:no-underline hover:text-[18px] hover:opacity-50 p-2 rounded-lg">Update Nilai</button>
       
   </div>
   <div class="flow-root">
    
        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
            
          
            @foreach($daftar_siswa as $ds)
            <li class="py-3 sm:py-4">
                <div class="flex items-center space-x-4">
                   
                    <div class="flex-1 min-w-0">
                      
                        <p class="text-lg font-medium text-gray-900 truncate dark:text-white">
                            {{ $ds->nama_siswa}} 
                        </p>
                     

                        <p class="text-lg text-gray-500 truncate dark:text-gray-400">
                            {{ $ds->NIS }}
                        </p>
                    </div>
                    <input type="hidden" name="id[]" value={{ $ds->id }}>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        <input type="number" name="nilai[]" value={{ $ds->nilai }} min="0" max="100" onKeyUp="if(this.value>100){this.value='100';}else if(this.value<0){this.value='0';} else if(this.value==0){this.value='0';}">
                    </div>
                </div>
                @endforeach
            
           
        </ul>
   </div>
</form>
</div>

@endsection