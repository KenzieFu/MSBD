@extends('admin.layout.template')
@section('adminContent')
<div class="m-3 flex justify-between">
  
    <h2 class="font-bold text-3xl">List Absensi Guru {{ $tahun->TahunAjaran }}</h2>
    @if($tahun->Pembelajaran =="Belum Selesai")
    <form method="POST" action="{{ route('admin.add-absensi-guru') }}">
        @csrf
        <input type="hidden" name="id_thnakademik" value={{ $tahun->id }}>
    <button class="text-white p-2 text-lg bg-green-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50">Isi List Guru</button></form>
    @endif
   
</div>


<div class="container">
    <form method="POST" action="{{ route('admin.update-absensi-guru') }}">
        @csrf
    <div class="m-2 flex justify-start">

        <button class="text-white p-2 text-lg bg-green-400 rounded-lg hover:no-underline hover:text-[18px] hover:opacity-50">Update Absensi<button>
    </div>
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
           <td><input type="hidden" name="id[]" value="{{ $row->id }}" >
            {{ $row->id }}
        </td>
           <td>{{ $row->NIG }}</td>
           <td>{{ $row->name }}</td>
           <td>
            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                
                <input value="{{ $row->absen }}" type="number" min="0" max="100" onKeyUp="if(this.value>99){this.value='99';}else if(this.value<0){this.value='0';} else if(this.value==0){this.value='0';}"
                name="absen[]">
                
                
            </div>
           </td>
           <td>
            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
              
                <input value="{{ $row->izin }}" type="number" min="0" max="100" onKeyUp="if(this.value>99){this.value='99';}else if(this.value<0){this.value='0';} else if(this.value==0){this.value='0';}"
                name="izin[]">
                
                
            </div>
            </td>
           <td> <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
            <input value="{{ $row->sakit }}" type="number" min="0" max="100" onKeyUp="if(this.value>99){this.value='99';}else if(this.value<0){this.value='0';} else if(this.value==0){this.value='0';}"
            name="sakit[]"></div></td>
        </tr>
   
        @endforeach
    
    </tbody>
   </table>
</form>
</div>


 


@endsection