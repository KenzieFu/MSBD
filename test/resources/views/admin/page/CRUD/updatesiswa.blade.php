@extends('admin.layout.template')
@section('adminContent')

<div class="max-w m-3 p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
   
    <div class="mb-5">
        <h1 class="text-3xl">Update Siswa</h1>
    </div>
    <div class="flex  justify-end ml-5 ">
    <form method="POST" action="{{ route('admin.updt_siswa') }}">
        @csrf
        <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Save</button>
    </div>
    <table style="border-collapse: collapse;" class="w-[80%]  mb-3">
        <tr  style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Nama Siswa</td>
            <td>&nbsp;:&nbsp;</td>
            <td> <input required type="text" name="name" value="{{ $siswa->name }}" ></td>
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>NIS</td>
            <td>&nbsp;:&nbsp;</td>
            
            <td><input   type="hidden" name="NIS" value="{{ $siswa->NIS }}" >
                <input required disabled  type="text" name="NIS" value="{{ $siswa->NIS }}" >
            </td>
           
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Gender</td>
            <td>&nbsp;:&nbsp;</td>
            <td>
                <select required name="gender" >
                    <option @php if($siswa->gender =="L") echo "selected" @endphp value="L">L</option>
                    <option @php if($siswa->gender =="P") echo "selected" @endphp value="P">P</option>
                </select>
            </td>
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>SMP</td>
            <td>&nbsp;:&nbsp;</td>
            <td>
                <select required name="SMP" >
                <option @php if($siswa->SMP =="1") echo "selected" @endphp value="1">1</option>
                <option @php if($siswa->SMP =="2") echo "selected" @endphp value="2">2</option>
                <option @php if($siswa->SMP =="3") echo "selected" @endphp value="3">3</option>
            </select>
        </td>
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Kelas</td>
            <td>&nbsp;:&nbsp;</td>
            <td> 
                <select required name="id_kelas" >
                    @foreach($kelas as $k)
                    <option @php if($siswa->id_kelas ==$k->id) echo "selected" @endphp value={{ $k->id }}>{{ $k->nama_kelas }}</option>
                    @endforeach
            </select>
        </td>
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Kota Lahir</td>
            <td>&nbsp;:&nbsp;</td>
            <td> <input  name="Kota_Lahir"  type="text" value="{{ $siswa->Kota_Lahir }}" ></td>
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Alamat</td>
            <td>&nbsp;:&nbsp;</td>
            <td><textarea name="alamat"  cols="60" rows="10" min>{{ $siswa->alamat }}</textarea></td>
        </tr>
       
    </table>
    </form>

    <div class="flex gap-x-3">
    <form action="{{ route('admin.tSiswa') }}">
        @csrf
        <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Back</button>
    </form>

    </div>
</form>
</div>

@endsection