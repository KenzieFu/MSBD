@extends('admin.layout.template')
@section('adminContent')


<div class="max-w m-3 p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
   
    <div class="mb-5">
        <h1 class="text-3xl">Create Guru</h1>
    </div>
    <div class="flex  justify-end ml-5 ">
    <form method="POST" action="{{ route('admin.cGuru') }}">
        @csrf
        <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create</button>
    </div>
    <table style="border-collapse: collapse;" class="w-[80%]  mb-3">
        <tr  style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Nama</td>
            <td>&nbsp;:&nbsp;</td>
            <td> <input required type="text" name="name" ></td>
        </tr>
        
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Alias</td>
            <td>&nbsp;:&nbsp;</td>
            <td>
                <input required   type="text" name="alias"  >
            </td>
           
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>NUPTK</td>
            <td>&nbsp;:&nbsp;</td>
            <td>
                <input required  type="text" name="NUPTK"  >
            </td>
           
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Agama</td>
            <td>&nbsp;:&nbsp;</td>
            <td>
                <select required name="agama" >
                    <option  value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option  value="Buddha">Buddha</option>
                    <option  value="Kong Hu Chu">Kong Hu Chu</option>
                    <option  value="Hindu">Hindu</option>
                </select>
            </td>
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Status Kepegawaian</td>
            <td>&nbsp;:&nbsp;</td>
            <td>
                <select required name="status_kepegawaian" >
                    <option  value="Guru Honor Sekolah">Guru Honor Sekolah</option>
                    <option value="GTY/PTY">GTY/PTY</option>
                  
                </select>
            </td>
        </tr>
       
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Gender</td>
            <td>&nbsp;:&nbsp;</td>
            <td>
                <select required name="gender" >
                    <option  value="L">L</option>
                    <option  value="P">P</option>
                </select>
            </td>
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Tanggal Lahir</td>
            <td>&nbsp;:&nbsp;</td>
            <td>
                <input required   type="date" name="Tanggal_Lahir"  >
            </td>
        </tr>
     
       
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Tempat Lahir</td>
            <td>&nbsp;:&nbsp;</td>
            <td> 
                <select required name="Tempat_Lahir" >
                    @foreach($kota as $k)
                    <option  value={{ $k->id }}>{{ $k->Kota }}</option>
                    @endforeach
            </select>
        </td>
        </tr>
   
       

        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Alamat</td>
            <td>&nbsp;:&nbsp;</td>
            <td><textarea name="alamat"  cols="60" rows="10" min></textarea></td>
        </tr>
       
    </table>
    </form>

    <div class="flex gap-x-3">
    <form action="{{ route('admin.tGuru') }}">
        @csrf
        <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Back</button>
    </form>

    </div>
</form>
</div>




@endsection