@extends('admin.layout.template')
@section('adminContent')


<div class="max-w m-3 p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
   
    <div class="mb-5">
        <h1 class="text-3xl">Update Guru</h1>
    </div>
    <div class="flex  justify-end ml-5 ">
    <form method="POST" action="{{ route('admin.updt_guru') }}">
        @csrf
        <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Update</button>
    </div>
    <table style="border-collapse: collapse;" class="w-[80%]  mb-3">
        <input type="hidden" name="NIG" value="{{ $guru->NIG }}">
        <tr  style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Nama</td>
            <td>&nbsp;:&nbsp;</td>
            <td> <input required type="text" name="name" value="{{ $guru->name }}"></td>
        </tr>
        
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Alias</td>
            <td>&nbsp;:&nbsp;</td>
            <td>
                <input required   type="text" name="alias"  value="{{ $guru->alias }}">
            </td>
           
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>NUPTK</td>
            <td>&nbsp;:&nbsp;</td>
            <td>
                <input required  type="text" name="NUPTK" value="{{ $guru->NUPTK }}"  >
            </td>
           
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Agama</td>
            <td>&nbsp;:&nbsp;</td>
            <td>
                <select required name="agama" >
                    <option @php if($guru->agama =="Islam") echo "selected" @endphp  value="Islam">Islam</option>
                    <option @php if($guru->agama =="Kristen") echo "selected" @endphp value="Kristen">Kristen</option>
                    <option @php if($guru->agama =="Buddha") echo "selected" @endphp value="Buddha">Buddha</option>
                    <option @php if($guru->agama =="Kong Hu Chu") echo "selected" @endphp  value="Kong Hu Chu">Kong Hu Chu</option>
                    <option @php if($guru->agama =="Hindu") echo "selected" @endphp  value="Hindu">Hindu</option>
                </select>
            </td>
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Status Kepegawaian</td>
            <td>&nbsp;:&nbsp;</td>
            <td>
                <select required name="status_kepegawaian" >
                    <option @php if($guru->status_kepegawaian =="Guru Honor Sekolah") echo "selected" @endphp value="Guru Honor Sekolah">Guru Honor Sekolah</option>
                    <option @php if($guru->status_kepegawaian =="GTY/PTY") echo "selected" @endphp value="GTY/PTY">GTY/PTY</option>
                  
                </select>
            </td>
        </tr>
       
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Gender</td>
            <td>&nbsp;:&nbsp;</td>
            <td>
                <select required name="gender" >
                    <option @php if($guru->gender =="L") echo "selected" @endphp value="L">L</option>
                    <option @php if($guru->status_kepegawaian =="P") echo "selected" @endphp value="P">P</option>
                </select>
            </td>
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Tanggal Lahir</td>
            <td>&nbsp;:&nbsp;</td>
            <td>
                <input required   type="date" name="Tanggal_Lahir" value="{{ $guru->Tanggal_Lahir }}" >
            </td>
        </tr>
     
       
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Tempat Lahir</td>
            <td>&nbsp;:&nbsp;</td>
            <td> 
                <select required name="Tempat_Lahir" >
                    @foreach($kota as $k)
                    <option @php if($guru->Tempat_Lahir == $k->id) echo "selected" @endphp  value={{ $k->id }}>{{ $k->Kota }}</option>
                    @endforeach
            </select>
        </td>
        </tr>
   
       

        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Alamat</td>
            <td>&nbsp;:&nbsp;</td>
            <td><textarea name="alamat"  cols="60" rows="10" min>{{ $guru->alamat }}</textarea></td>
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