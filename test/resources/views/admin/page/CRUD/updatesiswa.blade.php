@extends('admin.layout.template')
@section('adminContent')


<div class="max-w m-3 p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
   
    <div class="mb-5">
        <h1 class="text-3xl">Update Siswa </h1>
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
            <td>NISN</td>
            <td>&nbsp;:&nbsp;</td>
            <td>
                <input required   type="text" name="NISN" value="{{ $siswa->NISN }}" >
            </td>
           
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>NIPD</td>
            <td>&nbsp;:&nbsp;</td>
            <td>
                <input required   type="text" name="NIPD" value="{{ $siswa->NIPD }}" >
            </td>
           
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>NIK</td>
            <td>&nbsp;:&nbsp;</td>
            <td>
                <input required  type="text" name="NIK" value="{{ $siswa->NIK }}" >
            </td>
           
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Agama</td>
            <td>&nbsp;:&nbsp;</td>
            <td>
                <select required name="agama" >
                    <option @php if($siswa->agama =="Islam") echo "selected" @endphp value="Islam">Islam</option>
                    <option @php if($siswa->agama =="Kristen") echo "selected" @endphp value="Kristen">Kristen</option>
                    <option @php if($siswa->agama =="Buddha") echo "selected" @endphp value="Buddha">Buddha</option>
                    <option @php if($siswa->agama =="Kong Hu Chu") echo "selected" @endphp value="Kong Hu Chu">Kong Hu Chu</option>
                    <option @php if($siswa->agama =="Hindu") echo "selected" @endphp value="Hindu">Hindu</option>
                </select>
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
            <td>Tanggal Lahir</td>
            <td>&nbsp;:&nbsp;</td>
            <td>
                <input required   type="date" name="Tanggal_Lahir" value="{{ $siswa->Tanggal_Lahir }}" >
            </td>
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Jenis Tinggal</td>
            <td>&nbsp;:&nbsp;</td>
            <td>
                <select required name="Jenis_Tinggal" >
                    <option @php if($siswa->Jenis_Tinggal =="Bersama Orang Tua") echo "selected" @endphp value="Bersama Orang Tua">Bersama Orang Tua</option>
                    <option @php if($siswa->Jenis_Tinggal =="Sendiri") echo "selected" @endphp value="P">Sendiri</option>
                </select>
            </td>
        </tr>
       
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Tempat Lahir</td>
            <td>&nbsp;:&nbsp;</td>
            <td> 
                <select required name="Tempat_Lahir" >
                    @foreach($kota as $k)
                    <option @php if($siswa->Tempat_Lahir ==$k->id) echo "selected" @endphp value={{ $k->id }}>{{ $k->Kota }}</option>
                    @endforeach
            </select>
        </td>
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Kecamatan</td>
            <td>&nbsp;:&nbsp;</td>
            <td> 
                <select onchange="success()" required id="kecamatans" name="id_kecamatan" >
                    <option value=""></option>
                    @foreach($kecamatan as $kec)
                    <option @php if($siswa->id_kecamatan ==$kec->id) echo "selected" @endphp value={{ $kec->id }}>{{ $kec->Kecamatan }}</option>
                    @endforeach
            </select>
        </td>
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Kelurahan</td>
            <td>&nbsp;:&nbsp;</td>
            <td> 
                <select id="kelurahan"  required name="id_kelurahan" >
                    @foreach($kelurahan as $kel) 
             
                  
                    <option @php if($siswa->id_kelurahan ==$kel->id) echo "selected" @endphp value={{ $kel->id }}>{{ $kel->Kelurahan }}</option>
                   
                    @endforeach
            </select>
        </td>
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