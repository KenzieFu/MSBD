@extends('admin.layout.template')
@section('adminContent')
<div class="container">
    <div class="m-3 flex justify-between">
        <h2 class="font-bold text-3xl">Daftar Kelas</h2>
        <div class=" flex gap-x-2  justify-center align-center">
            <a href="{{ route('admin.tes1') }}" class="text-white p-2 text-lg bg-green-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50">Report</a>
            
        </div>
    </div>
    <table  class="table table-stripped mydatatable text-[15px]">
     <thead class="bg-green-500">
         <tr class="text-white text-xl font-bold">
             <td>Id</td>
             <td>Nama_Kelas</td>
         </tr>
     </thead>
     <tbody>
         @foreach ($class as $t)
         <tr>
             <td>{{ $t->id }}</td>
             <td>{{ $t->nama_kelas }}</td>
         </tr>
         @endforeach
     </tbody>
    </table>
 </div>

@endsection