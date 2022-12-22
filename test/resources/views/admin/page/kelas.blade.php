@extends('admin.layout.template')
@section('adminContent')
<div class="container">
    <div class="m-3 flex justify-between">
        <h2 class="font-bold text-3xl">Daftar Kelas</h2>
        <div class=" flex gap-x-2  justify-center align-center">
            <a href="{{ route('admin.tes1') }}" class="text-white p-2 text-lg bg-green-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50">Report</a>
            <a  class="text-white p-2 text-lg bg-green-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50" data-toggle="modal" data-target="#CreateKelasModal">Tambah Kelas</a>
            
        </div>
    </div>
    <table  class="table table-stripped mydatatable text-[15px]">
     <thead class="bg-green-500">
         <tr class="text-white text-xl font-bold">
             <td>Id</td>
             <td>Nama_Kelas</td>
             <td>Aksi</td>
         </tr>
     </thead>
     <tbody>
       
         @foreach ($class as $t)
       
         <tr>
             <td>{{ $t->id }}</td>
             <td>{{ $t->nama_kelas }}</td>
             <td>
               
                <button class="text-white p-2 text-lg bg-green-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50 mb-2" data-toggle="modal" data-target="#TahunModal{{ $t->id }}">Update</button>
               
                <form method="POST" action={{ route('admin.delete_kelas') }}>
                    @csrf
                    <input type="hidden" name="id_kelas" value="{{ $t->id }}">
                <button class="text-white p-2 text-lg bg-red-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50">Delete</button>
                </form>
             </td>
         </tr>

         <!--Add Kelas Modal-->
 <div class="modal fade" id="TahunModal{{ $t->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
    <div class="modal-dialog" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Update Kelas (id={{ $t->id }})</h5>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
             </button>
         </div>
         <form method="POST" action="{{ route('admin.updt_kelas') }}">
            @csrf
            <input type="hidden" name="id_kelas" value="{{ $t->id }}">
         <div class="modal-body flex flex-col gap-3">

            <div >
                <label class="mr-[40px]" for="kuri">Nama Kelas</label>
                <input type="text" name="nama_kelas" value="{{ $t->nama_kelas }}">
               
            </div>
            
         </div>
             <div class="modal-footer">
             <button class="btn btn-secondary bg-red-500 text-white " type="button" data-dismiss="modal">Cancel</button>
             
                
                 <button class="btn btn-primary bg-green-500 text-white" type="submit">Update</button>
             
         </div>
     </form>
     </div>
 </div>
</div>


         @endforeach
     </tbody>
    </table>
 </div>

          <!--Add Tahun Kelas Modal-->
          <div class="modal fade" id="CreateKelasModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
            <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
                     <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">×</span>
                     </button>
                 </div>
                 <form method="POST" action="{{ route('admin.createKelas') }}">
                    @csrf
                  
                 <div class="modal-body flex flex-col gap-3">
        
                    <div >
                        <label class="mr-[40px]" for="kuri">Nama Kelas</label>
                        <input type="text" name="nama_kelas">
                       
                    </div>
                    
                 </div>
                     <div class="modal-footer">
                     <button class="btn btn-secondary bg-red-500 text-white " type="button" data-dismiss="modal">Cancel</button>
                     
                        
                         <button class="btn btn-primary bg-green-500 text-white" type="submit">Create</button>
                     
                 </div>
             </form>
             </div>
         </div>

@endsection