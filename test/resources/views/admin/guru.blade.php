@extends('admin.layout.template')
@section('adminContent')
   <div class="container">
       <table  class="table table-stripped mydatatable text-[15px]">
        <thead class="bg-green-500">
            <tr class="text-white text-xl font-bold">
                <td>Id</td>
                <td>Name</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($teachers as $t)
            <tr>
                <td>{{ $t->id }}</td>
                <td>{{ $t->name }}</td>
            </tr>
            @endforeach
        </tbody>
       </table>
    </div>
  

@endsection