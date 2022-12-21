@extends('admin.layout.template')
@section('adminContent')

<div class="max-w m-3 p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
    <div class="mb-5">
        <h1 class="text-3xl">Update Guru</h1>
    </div>

    <div class="flex  justify-end ml-5 ">
        <form method="POST" action="{{ route('admin.updt_guru') }}">
            @csrf
            <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Save</button>
        </div>
   
   
    <table style="border-collapse: collapse;" class="w-[80%]  mb-3">
        <tr  style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Nama guru</td>
            <td>&nbsp;:&nbsp;</td>
            <td> <input required type="text" name="name" value="{{ $guru->name }}" ></td>
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>NIG</td>
            <td>&nbsp;:&nbsp;</td>
            <td>  <input disabled required type="text"  value="{{ $guru->NIG }}" >
            <input hidden type="text" name="NIG" value="{{ $guru->NIG }}" ></td>
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Alias</td>
            <td>&nbsp;:&nbsp;</td>
            <td>  <input required type="text" name="alias" value="{{ $guru->alias }}" ></td>
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Gender</td>
            <td>&nbsp;:&nbsp;</td>
            <td>  <select required name="gender" >
                <option @php if($guru->gender =="L") echo "selected" @endphp value="L">L</option>
                <option @php if($guru->gender =="P") echo "selected" @endphp value="P">P</option>
            </select></td>
        </tr>
     
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Kota Lahir</td>
            <td>&nbsp;:&nbsp;</td>
            <td><input required type="text" name="Kota_Lahir" value="{{ $guru->Kota_Lahir }}" ></td>
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Alamat</td>
            <td>&nbsp;:&nbsp;</td>
            <td><textarea required type="text" name="alamat" cols="60" rows="10" >{{ $guru->alamat }}</textarea></td>
        </tr>
       
    </table>
</form>
    <form action="{{ route('admin.tGuru') }}">
        @csrf
        <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Back</button>
    </form>
</div>

@endsection