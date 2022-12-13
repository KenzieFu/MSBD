@extends('admin.layout.template')
@section('adminContent')

    <div class="m-3 flex justify-between">
        <h2 class="font-bold text-3xl">Daftar Siswa </h2>
        <div class="bg-green-400 flex  justify-center align-center p-2 rounded-lg ">
            <a href="{{ route('admin.cSiswa') }}" class="text-white text-lg  hover:no-underline hover:text-[18px] hover:opacity-50">Tambah Siswa</a>
        </div>
    </div>
    
   <div class="container">
       <table  class="table table-stripped mydatatable text-[15px]">
        <thead class="bg-green-500">
            <tr class="text-white text-sm font-bold">
                <td>NIS</td>
                <td>Name</td>
                <td>Kelas</td>
                <td>Tahun Masuk</td>
                <td>Status</td>
                <td>Gender</td>
                <td>SMP</td>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
            
               
                <td>{{ $user->NIS  }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->nama_kelas }}</td>
                <td>{{ $user->TahunAjaran }}</td>
              
                <td>{{ $user->status }}</td>
                <td>{{ $user->gender}}</td>
                <td>{{ $user->SMP}}</td>
            </tr>
       
            @endforeach
        </tbody>
       </table>
    </div>
  

@endsection