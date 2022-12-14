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
            @foreach ($admins as $adm)
            <tr>
                <td>{{ $adm->id }}</td>
                <td>{{ $adm->name }}</td>
            </tr>
            @endforeach
        </tbody>
       </table>
    </div>
  

@endsection