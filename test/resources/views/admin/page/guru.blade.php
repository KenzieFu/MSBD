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
                <td>Akun</td>
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
                <td>
                    @if($t->Cek_Akun >0)
                    <form method="POST" action="{{ route('admin.deleteAkunGuru') }}">
                        @csrf
                        <div>
                            <input type="hidden" name="NIG" value="{{ $t->NIG }}">
                            <span>Sudah Punya Akun</span>
                            <button class="rounded-lg bg-red-500 text-white p-1" type="submit">Delete Akun</button>
                        </div>
                    </form>
                    @else
                    <div>
                        <div>Belum Punya Akun</div>
                        <button data-toggle="modal" data-target="#TahunModal{{ $t->NIG }}"
                            class="rounded-lg bg-green-500 text-white p-1" type="submit">Buat Akun</button>
                    </div>
                    @endif

                </td>
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

             <!--Add Tahun akademik Modal-->
 <div class="modal fade" id="TahunModal{{ $t->NIG }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buat Akun Untuk NIG {{ $t->NIG }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.buatAkunGuru') }}">
               @csrf
            <div class="modal-body flex flex-col gap-3">
               <input type="hidden" name="NIG" value="{{ $t->NIG }}">
               <div >
                   <label class="mr-[40px]" for="kuri">Email</label>
                   <input required class="rounded-lg "name="email" type="email" id="kuri">
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
            @endforeach
        </tbody>
       </table>
    </div>
  

@endsection