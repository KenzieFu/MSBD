@extends('admin.layout.template')
@section('adminContent')

<div class="m-3 flex justify-between">
    <h2 class="font-bold text-3xl">Daftar Siswa </h2>
    <div class="bg-green-400 flex  justify-center align-center p-2 rounded-lg ">
        <a href="{{ route('admin.cvRombel') }}" class="text-white text-lg  hover:no-underline hover:text-[18px] hover:opacity-50">Tambah Rombel</a>
    </div>
</div>

   <div class="container">
       <table  class="table table-stripped mydatatable text-[15px]">
        <thead class="bg-green-500">
            <tr class="text-white text-xl font-bold">
                <td>Id</td>
                <td>Nama Kelas</td>
                <td>SMP</td>
                <td>Wali Kelas</td>
                <td>Tahun Ajaran</td>
            </tr>
        </thead>
        <tbody>

            @foreach ($rombel as $r)
                <tr>
                    <td>{{ $r->id }}</td>
                    <td>{{ $r->kelas->nama_kelas }}</td>
                    <td>{{ $r->SMP}}</td>
                    <td>{{ $r->wali->NIG??"Pending"}}</td>
                    <td>{{ $r->tahun->TahunAjaran}}</td>
                </tr>
            @endforeach
        </tbody>
       </table>
    </div>

    
  

@endsection