@extends('admin.layout.template')
@section('adminContent')

<div class="m-3 flex justify-between">
    <h2 class="font-bold text-3xl">Daftar Rombel </h2>
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
                <td>Jumlah Murid</td>
                <td>Details</td>
            </tr>
        </thead>
        <tbody>

            @foreach ($rombel as $r)
                <tr>
                    <td>{{ $r->id }}</td>
                    <td>{{ $r->nama_kelas }}</td>
                    <td>{{ $r->SMP}}</td>
                    <td>{{ $r->alias??"Pending"}}</td>
                    <td>{{ $r->TahunAjaran}}</td>
                    <td>{{ $r->jumlah}}</td> 
                    <td class="flex gap-x-3">
                        <form action={{ route('admin.detailsrombel',$r->id) }}>
                         
                           
                        <button class="rounded-lg bg-green-500 text-white p-1" href="">Details</button>
                         </form>
                         <form method="POST" action="{{ route('admin.deleteRombel') }}">
                            @csrf
                            <input type="hidden" name="id_rombel" value="{{ $r->id }}">
                        <button class="rounded-lg bg-red-500 text-white p-1" type="submit">Delete</button>
                        </form>
                        
                    </td> 
                </tr>
            @endforeach
        </tbody>
       </table>
    </div>

    
  

@endsection