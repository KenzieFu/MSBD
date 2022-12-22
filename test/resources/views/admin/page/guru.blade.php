@extends('admin.layout.template')
@section('adminContent')

    <div class="m-3 flex justify-between">
        <h2 class="font-bold text-3xl">Daftar Guru</h2>
        <div class=" flex gap-x-2  justify-center align-center">
            <a href="{{ route('admin.tes3') }}" class="text-white p-2 text-lg bg-green-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50">Report</a>
            <a href="{{ route('admin.cGuru') }}" class="text-white p-2 text-lg bg-green-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50">Tambah Guru</a>
            
        </div>
    </div>

   <div class="container">
       <table  class="table table-stripped mydatatable text-[15px]">
        <thead class="bg-green-500">
            <tr class="text-white text-xl font-bold">
                <td>NIG</td>
                <td>Alias</td>
                <td>Name</td>
                <td>Status</td>
                <td>Tahun Masuk</td>
                <td>Jenis Kelamin</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($teachers as $t)
            <tr>
               
                <td>{{ $t->NIG}}</td>
                <td>{{ $t->alias}}</td>
                <td>{{ $t->name }}</td>
                <form method="POST" action="{{ route('admin.uguru') }}">
                    @csrf
                    <input type="hidden" name="id_guru" value="{{ $t->NIG }}">
                    <td>
                    @if($t->status =="Aktif")
                <button class="rounded-lg bg-green-500 text-white p-1" type="submit">{{ $t->status }}</button>     
                    @else
                 <button class="rounded-lg bg-red-500 text-white p-1" type="submit">{{ $t->status }}</button>
                     @endif
                </td>   
                </form>

                <td>{{ $t->Tahun_Masuk }}</td>
                <td>{{ $t->gender }}</td>
                <td class="flex flex-col gap-y-3">
                    <form action="{{ route('admin.info_guru') }}">
                        @csrf
                        <input type="hidden" name="id_guru" value="{{ $t->NIG }}">
                    <button class="text-white p-2 text-lg bg-blue-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50">Details</button>
                    </form>
                    <form action="{{ route('admin.update_guru') }}">
                        @csrf
                        <input type="hidden" name="id_guru" value="{{ $t->NIG }}">
                    <button class="text-white p-2 text-lg bg-green-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50">Update</button>
                    </form>
                    <form method="POST" action={{ route('admin.delete_guru') }}>
                        @csrf
                        <input type="hidden" name="id_guru" value="{{ $t->NIG }}">
                    <button class="text-white p-2 text-lg bg-red-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50">Delete</button>
                    </form>
                
                </td>
                
            </tr>
            @endforeach
        </tbody>
       </table>
    </div>
  

@endsection