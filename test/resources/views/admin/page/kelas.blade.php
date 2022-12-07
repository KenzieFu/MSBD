@extends('admin.layout.template')
@section('adminContent')
<div class="container">
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