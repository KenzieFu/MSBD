@extends('admin.layout.template')
@section('adminContent')
   <div class="container">
       <table  class="table table-stripped mydatatable text-[15px]">
        <thead class="bg-green-500">
            <tr class="text-white text-xl font-bold">
                <td>NIG</td>
                <td>Alias</td>
                <td>Name</td>
                <td>Tahun Masuk</td>
                <td>Jenis Kelamin</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($teachers as $t)
            <tr>
               
                <td>{{ $t->NIG}}</td>
                <td>{{ $t->alias}}</td>
                <td>{{ $t->name }}</td>

                <td>{{ $t->Tahun_Masuk }}</td>
                <td>{{ $t->gender }}</td>
            </tr>
            @endforeach
        </tbody>
       </table>
    </div>
  

@endsection