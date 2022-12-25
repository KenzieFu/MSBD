@extends('admin.layout.template')
@section('adminContent')
<div class="m-3 flex justify-between">
    <h2 class="font-bold text-3xl">Daftar Pengumuman </h2>
    <div class=" flex gap-x-2  justify-center align-center">
       
        <a href="{{ route('admin.cSiswa') }}" class="text-white p-2 text-lg bg-green-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50" data-toggle="modal" data-target="#CreateAnnModal">Tambah Pengumuman</a>
    </div>
</div>

   <div class="container">
       <table  class="table table-stripped mydatatable text-[15px]">
        <thead class="bg-green-500">
            <tr class="text-white text-xl font-bold">
                <td>Id</td>
                <td>Isi Pengumuman</td>
                <td>Created At</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengumuman as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->isi_pengumuman }}</td>
                <td>{{ $p->created_at }}</td>
                <td>
                    <form method="POST" action={{ route('admin.deletePengumuman') }}>
                        @csrf
                     <input type="hidden" name="id_pengumuman" value="{{ $p->id }}">
                    <button class="text-white p-2 text-lg bg-red-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
       </table>
    </div>

    <div class="modal fade" id="CreateAnnModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
        <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Tambah Pengumuman</h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <form method="POST" action="{{ route('admin.createAnn') }}">
                @csrf
              
             <div class="modal-body flex flex-col gap-3">
                
                <div>Isi</div>
                <div >
                  
                    <textarea name="isi_pengumuman" id="kuri" cols="45" rows="10"></textarea>
                   
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