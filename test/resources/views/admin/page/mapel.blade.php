@extends('admin.layout.template')
@section('adminContent')

<div class="m-3 flex justify-between">
    <h2 class="font-bold text-3xl">Daftar Mapel</h2>
    {{-- <div class="bg-green-400 flex  justify-center align-center p-2 rounded-lg ">
        <a href="{{ route('admin.cSiswa') }}" class="text-white text-lg  hover:no-underline hover:text-[18px] hover:opacity-50">Tambah Siswa</a>
    </div> --}}
</div>

   <div class="container">
       <table  class="table table-stripped mydatatable text-[15px]">
        <thead class="bg-green-500">
            <tr class="text-white text-xl font-bold">
                <td>Id</td>
                <td>Nama_Mapel</td>
            </tr>
        </thead>                                    
        <tbody>                                                         
            @foreach ($mapel as $m)                                     
            <tr>
                <td>{{ $m->id}}</td>
                <td>{{ $m->mapel}}</td>
               
            </tr>
            @endforeach
        </tbody>
       </table>
    </div>
  

@endsection