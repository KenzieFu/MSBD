@extends('teacher.layout.template')
@section('teacherContent')

<div class="m-3 flex justify-between">
    <h2 class="font-bold text-3xl">Jadwal Guru </h2>
    <div class="bg-green-400 flex  justify-center align-center p-2 rounded-lg ">
        
    </div>
</div>

   <div class="container">
       <table  class="table table-stripped mydatatable text-[15px]">
        <thead class="bg-green-500">
            <tr class="text-white text-xl font-bold">
                <td>Id</td>
                <td>Guru Mapel</td>
                <td>Nama Kelas</td>
                <td>SMP</td>
                <td>Mapel</td>
              
                <td>Tahun Ajaran</td>
                <td>Action</td>
                
   
            </tr>
        </thead>
        <tbody>
            @php
                $i=1;
                @endphp

            @foreach ($jadwal as $r)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $r->alias }}</td>
                    <td>{{ $r->nama_kelas}}</td>
                    <td>{{ $r->SMP}}</td>
                    <td>{{ $r->mapel}}</td>
                    <td>{{ $r->TahunAjaran}}</td>
                    <td>
                        <form action="{{ route('teacher.inputnilai') }}">
                            @csrf
                            <input type="hidden" name="id_rombel" value={{ $r->id_rombel }}>
                            <input type="hidden" name="id_mapel" value={{ $r->id_mapel }}>
                            <button class="text-white text-lg bg-green-500  hover:no-underline hover:text-[18px] hover:opacity-50 p-1 rounded-lg">Input Nilai</button>
                        </form>
                        
                    </td>

      
                   @php $i++ @endphp
                </tr>
            @endforeach
        </tbody>
       </table>
    </div>

@endsection