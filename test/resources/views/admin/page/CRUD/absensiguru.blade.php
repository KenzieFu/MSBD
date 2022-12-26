@extends('admin.layout.template')
@section('adminContent')
<div class="m-3 flex justify-between">
  
    <h2 class="font-bold text-3xl">List Absensi Guru {{ $tahun->TahunAjaran }}</h2>
   
   
</div>
<div class="container">
   <table  class="table table-stripped mydatatable text-[15px]">
    <thead class="bg-green-500">
        <tr class="text-white text-xl font-bold">
            <td>Id</td>
            <td>NIG</td>
            <td>Guru</td>
            <td>Absen</td>
            <td>Izin</td>
            <td>Sakit</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $row)
        <tr>
           <td>{{ $row->id }}</td>
           <td>{{ $row->NIG }}</td>
           <td>{{ $row->name }}</td>
           <td>{{ $row->absen }}</td>
           <td>{{ $row->izin }}</td>
           <td>{{ $row->sakit }}</td>
        </tr>
   
        @endforeach
    </tbody>
   </table>
</div>


 <!--Add Tahun akademik Modal-->
 <div class="modal fade" id="TahunModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <div class="modal-dialog" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Tambah Tahun Ajaran</h5>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
             </button>
         </div>
         <form method="POST" action="{{ route('admin.cthnak') }}">
            @csrf
         <div class="modal-body flex flex-col gap-3">
            <div >
                <label class="mr-[40px]" for="kuri">Kurikulum</label>
                <input required class="rounded-lg "name="kurikulum" type="text" id="kuri">
            </div>
            <div >
                <label for="thn_ajaran">Tahun Ajaran</label>
                <input required class="rounded-lg mx-3" type="text" name="thn_ajaran" id="thn_ajaran">
            </div>
         </div>
             <div class="modal-footer">
             <button class="btn btn-secondary bg-red-500 text-white " type="button" data-dismiss="modal">Cancel</button>
             
                
                 <button class="btn btn-primary bg-green-500 text-white" type="submit">Submit</button>
             
         </div>
     </form>
     </div>
 </div>
</div>


@endsection