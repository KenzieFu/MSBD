@extends('admin.layout.template')
@section('adminContent')

<div class="m-3 flex justify-between">
    <h2 class="font-bold text-3xl">Daftar Siswa </h2>
    <div class=" flex gap-x-2  justify-center align-center">
        <a href="{{ route('admin.tes') }}"
            class="text-white p-2 text-lg bg-green-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50">Report</a>
        <a href="{{ route('admin.cSiswa') }}"
            class="text-white p-2 text-lg bg-green-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50">Tambah
            Siswa</a>
    </div>
</div>

<div class="container">
    <table class="table table-stripped mydatatable text-[15px]">
        <thead class="bg-green-500">
            <tr class="text-white text-sm font-bold">
                <td>NIS</td>
                <td>Name</td>
                <td>Gender</td>
                <td>Tahun Masuk</td>
                <td>Cek Akun</td>
                <td>Status</td>

                <td>Aksi</td>

            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>


                <td>{{ $user->NIS }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->gender }}</td>
                <td>{{ $user->TahunAjaran }}</td>
                <td>
                    @if($user->Cek_Akun >0)
                    <form method="POST" action="{{ route('admin.deleteAkunSiswa') }}">
                        @csrf
                        <div>
                            <input type="hidden" name="NIS" value="{{ $user->NIS }}">
                            <span>Sudah Punya Akun</span>
                            <button class="rounded-lg bg-red-500 text-white p-1" type="submit">Delete Akun</button>
                        </div>
                    </form>
                    @else
                    <div>
                        <div>Belum Punya Akun</div>
                        <button data-toggle="modal" data-target="#TahunModal{{ $user->NIS }}"
                            class="rounded-lg bg-green-500 text-white p-1" type="submit">Buat Akun</button>
                    </div>
                    @endif
                </td>


                <form method="POST" action="{{ route('admin.usiswa') }}">
                    @csrf
                    <input type="hidden" name="NIS" value="{{ $user->NIS }}">
                    <td>
                        @if($user->status =="Aktif")
                        <button class="rounded-lg bg-green-500 text-white p-1" type="submit">{{ $user->status
                            }}</button>
                        @elseif($user->status =="Tidak Aktif")
                        <button class="rounded-lg bg-red-500 text-white p-1" type="submit">{{ $user->status }}</button>
                        @else
                        <span class="rounded-lg bg-blue-300 text-white p-1">{{ $user->status }}</span>
                        @endif

                </form>
                </td>

                <td class="flex flex-col gap-y-3">
                    <form action="{{ route('admin.info_siswa') }}">
                        @csrf
                        <input type="hidden" name="id_siswa" value="{{ $user->NIS }}">
                        <button
                            class="text-white p-2 text-lg bg-blue-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50">Details</button>
                    </form>
                    <form action="{{ route('admin.update_siswa') }}">
                        @csrf
                        <input type="hidden" name="id_siswa" value="{{ $user->NIS }}">
                        <button
                            class="text-white p-2 text-lg bg-green-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50">Update</button>
                    </form>
                    <form method="POST" action={{ route('admin.delete_siswa') }}>
                        @csrf
                        <input type="hidden" name="id_siswa" value="{{ $user->NIS }}">
                        <button
                            class="text-white p-2 text-lg bg-red-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50">Delete</button>
                    </form>

                </td>
            </tr>

          <!--Add Tahun akademik Modal-->
 <div class="modal fade" id="TahunModal{{ $user->NIS }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <div class="modal-dialog" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Buat Akun Untuk NIS {{ $user->NIS }}</h5>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
             </button>
         </div>
         <form method="POST" action="{{ route('admin.buatAkunSiswa') }}">
            @csrf
         <div class="modal-body flex flex-col gap-3">
            <input type="hidden" name="NIS" value="{{ $user->NIS }}">
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