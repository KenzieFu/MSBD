@extends('admin.layout.template')
@section('adminContent')

    <div class="m-3 flex justify-between">
        <h2 class="font-bold text-3xl">Daftar Siswa </h2>
        <div class=" flex gap-x-2  justify-center align-center">
            <a href="{{ route('admin.tes') }}" class="text-white p-2 text-lg bg-green-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50">Report</a>
            <a href="{{ route('admin.cSiswa') }}" class="text-white p-2 text-lg bg-green-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50">Tambah Siswa</a>
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
                <td>Aksi</td>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
            
               
                <td>{{ $user->NIS  }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->nama_kelas }}</td>
                <td>{{ $user->Tahun_Masuk }}</td>
              
               
                    <form method="POST" action="{{ route('admin.usiswa') }}">
                    @csrf
                    <input type="hidden" name="NIS" value="{{ $user->NIS }}">
                    <td>
                    @if($user->status =="Aktif")
                <button class="rounded-lg bg-green-500 text-white p-1" type="submit">{{ $user->status }}</button>     
                    @elseif($user->status =="Tidak Aktif")
                 <button class="rounded-lg bg-red-500 text-white p-1" type="submit">{{ $user->status }}</button>
                 @else
                        <span class="rounded-lg bg-blue-300 text-white p-1" >{{ $user->status }}</span>
                     @endif
                 
                </form></td>
                <td>{{ $user->gender}}</td>
                <td>{{ $user->SMP}}</td>
                <td class="flex flex-col gap-y-3">
                    <form action="{{ route('admin.info_siswa') }}">
                        @csrf
                        <input type="hidden" name="id_siswa" value="{{ $user->NIS }}">
                    <button class="text-white p-2 text-lg bg-blue-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50">Details</button>
                    </form>
                    <form action="{{ route('admin.update_siswa') }}">
                        @csrf
                        <input type="hidden" name="id_siswa" value="{{ $user->NIS }}">
                    <button class="text-white p-2 text-lg bg-green-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50">Update</button>
                    </form>
                    <form method="POST" action={{ route('admin.delete_siswa') }}>
                        @csrf
                        <input type="hidden" name="id_siswa" value="{{ $user->NIS }}">
                    <button class="text-white p-2 text-lg bg-red-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50">Delete</button>
                    </form>
                
                </td>
            </tr>
       
            @endforeach
        </tbody>
       </table>
    </div>
  

@endsection