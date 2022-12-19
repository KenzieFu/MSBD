@extends('layouts.template')
@section('siswaContent')


<div class="m-3 flex justify-between">
    <h2 lass="font-bold text-3xl">Daftar Rombel </h2>
 
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

            @foreach ($rombelsiswa as $r)
                <tr>
                    <td>{{ $r->id_rombel }}</td>
                    <td>{{ $r->nama_kelas }}</td>
                    <td>{{ $r->SMP}}</td>
                    <td>{{ $r->NIG??"Pending"}}</td>
                    <td>{{ $r->TahunAjaran}}</td>
                    <td>{{ $r->jumlah}}</td> 
                    <td class="flex gap-x-3">
                        
                        <form action={{ route('rombelsiswa') }}>
                            
                            <input type="hidden" value="{{ $r->id_rombel }} " name="id_rombel">
                        <button class="rounded-lg bg-green-500 text-white p-1" href="">Details</button>
                         </form>
                       
                        
                    </td> 
                </tr>
            @endforeach
        </tbody>
       </table>
    </div>


@endsection