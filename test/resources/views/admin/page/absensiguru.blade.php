@extends('admin.layout.template')
@section('adminContent')
<div class="m-3 flex justify-between">
    <h2 class="font-bold text-3xl">Daftar Tahun Absensi Guru</h2>
    <div class="bg-green-400 flex  justify-center align-center p-2 rounded-lg ">

      
        
       {{--  <a href="{{ route('admin.cSiswa') }}" class="text-white text-lg  hover:no-underline hover:text-[18px] hover:opacity-50">Tambah</a> --}}
    </div>
</div>
<div class="container">
   <table  class="table table-stripped mydatatable text-[15px]">
    <thead class="bg-green-500">
        <tr class="text-white text-xl font-bold">
            <td>Id</td>
            <td>TahunAjaran</td>
            <td>Status Ajaran</td>
            <td>Action</td>
 
           
       
        
        </tr>
    </thead>
    <tbody>
        @foreach ($thn as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->TahunAjaran }}</td>  
            <td>{{ $row->status }}</td>  
            <td> 
                <form action="{{ route('admin.list-absensi-guru') }}">
                <input type="hidden" name="id_thnakademik" value="{{ $row->id }}">
                <button class="text-white p-2 text-lg bg-green-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50">Lihat Absensi</button>
                </form>
            </td>
        </tr>
   
        @endforeach
    </tbody>
   </table>
</div>





@endsection