@extends('admin.layout.template')
@section('adminContent')

<div class="m-3 flex justify-between">
    <h2 class="font-bold text-3xl">Daftar Mapel</h2>
    <div class=" flex gap-x-2  justify-center align-center">
        <a href="{{ route('admin.tes2') }}" class="text-white p-2 text-lg bg-green-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50">Report</a>
        <a data-toggle="modal" data-target="#CreateMapelModal"  class="text-white p-2 text-lg bg-green-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50">Tambah Mapel</a>
    </div>
</div>

   <div class="container">
       <table  class="table table-stripped mydatatable text-[15px]">
        <thead class="bg-green-500">
            <tr class="text-white text-xl font-bold">
                <td>Id</td>
                <td>Nama Mapel</td>
                <td>Status</td>
                <td>KKM</td>
                <td>Aksi</td>
            </tr>
        </thead>                                    
        <tbody>                                                         
            @foreach ($mapel as $m)                                     
            <tr>
                <td>{{ $m->id}}</td>
                <td>{{ $m->mapel}}</td>
                <td>
                    <form method="POST" action="{{ route('admin.aktivasiMapel') }}">
                        @csrf
                        <input type="hidden" name="id_mapel" value="{{ $m->id }}">
                       
                    @if($m->status =="Aktif")
                    <button class="rounded-lg bg-green-500 text-white p-1" type="submit">{{ $m->status }}</button>     
                    @else
                     <button class="rounded-lg bg-red-500 text-white p-1" type="submit">{{ $m->status }}</button>
                     @endif
                    </form>
                </td>
                <td>{{ $m->KKM}}</td>
                <td>
                    <button class="text-white p-2 text-lg bg-green-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50 mb-2" data-toggle="modal" data-target="#TahunModal{{ $m->id }}">Update</button>
               
                <form method="POST" action={{ route('admin.deleteMapel') }}>
                    @csrf
                    <input type="hidden" name="id_mapel" value="{{ $m->id }}">
                <button class="text-white p-2 text-lg bg-red-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50">Delete</button>
                </form>
                </td>
               
            </tr>

            <div class="modal fade" id="TahunModal{{ $m->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
                <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Update Mapel (id={{ $m->id }})</h5>
                         <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">×</span>
                         </button>
                     </div>
                     <form method="POST" action="{{ route('admin.updtMapel') }}">
                        @csrf
                        <input type="hidden" name="id_mapel" value="{{ $m->id }}">
                     <div class="modal-body flex flex-col gap-3">
            
                        <div >
                            <label class="mr-[40px]" for="kuri">Nama Mapel</label>
                            <input type="text" name="mapel" value="{{ $m->mapel }}">
                           
                        </div>
                        <div >
                            <label class="mr-[40px]" for="kuri">KKM<span class="text-white">auidiues</span></label>
                            <input value="{{ $m->KKM }}" type="number" min="0" max="100" onKeyUp="if(this.value>100){this.value='100';}else if(this.value<0){this.value='0';} else if(this.value==0){this.value='0';}"
                            name="KKM">
                           
                        </div>
                        
                     </div>
                         <div class="modal-footer">
                         <button class="btn btn-secondary bg-red-500 text-white " type="button" data-dismiss="modal">Cancel</button>
                         
                            
                             <button class="btn btn-primary bg-green-500 text-white" type="submit">Update</button>
                         
                     </div>
                 </form>
                 </div>
             </div>


            @endforeach
        </tbody>
       </table>
    </div>


    <div class="modal fade" id="CreateMapelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
        <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Tambah Mapel</h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <form method="POST" action="{{ route('admin.createMapel') }}">
                @csrf
              
             <div class="modal-body flex flex-col gap-3">
    
                <div >
                    <label class="mr-[40px]" for="kuri">Nama Mapel</label>
                    <input type="text" name="mapel">
                   
                </div>

                <div >
                    <label class="mr-[40px]" for="kuri">KKM<span class="text-white">auidiues</span></label>
                    <input value=65 type="number" min="0" max="100" onKeyUp="if(this.value>100){this.value='100';}else if(this.value<0){this.value='0';} else if(this.value==0){this.value='0';}"
                    name="KKM">
                   
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