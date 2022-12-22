@extends('admin.layout.template')
@section('adminContent')

    <div class="border  shadow-lg  mx-40 p-2 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 ">
    <div class="flex justify-center items-center">
        <h1 class="text-2xl text-white">Registrasi Guru</h1>
    </div>
    <div class="m-5 text-xl text-black font-bold">
        <form action="{{ route('admin.cGuru') }}" method="POST">
            @csrf
        <div class="flex flex-col gap-3 items-center ">
            
        <input required class=" flex items-center justify-center placeholder:text-lg placeholder:text-slate-400 text-lg mx-2 w-96 rounded-lg outline-none focus:ring-lime-300 focus:ring-2 focus:border-lime-300 focus:ring-offset-0" name="email"    type="email" placeholder="Email">

        <input required class=" flex items-center justify-center placeholder:text-lg placeholder:text-slate-400 text-lg mx-2 w-96 rounded-lg outline-none focus:ring-lime-300 focus:ring-2 focus:border-lime-300 focus:ring-offset-0" name="name"    type="text" placeholder="Nama" >
        
        <input required class=" flex items-center justify-center placeholder:text-lg placeholder:text-slate-400 text-lg mx-2 w-96 rounded-lg outline-none focus:ring-lime-300 focus:ring-2 focus:border-lime-300 focus:ring-offset-0" name="alias"    type="text" placeholder="Alias" >
        
        
        <input required class=" flex items-center justify-center placeholder:text-lg placeholder:text-slate-400 text-lg mx-2 w-96 rounded-lg outline-none focus:ring-lime-300 focus:ring-2 focus:border-lime-300 focus:ring-offset-0" name="Kota_Lahir"    type="text" placeholder="Kota Kelahiran" >
        
        <textarea required class=" flex items-center justify-center placeholder:text-lg placeholder:text-slate-400 text-lg mx-2 w-96 rounded-lg outline-none focus:ring-lime-300 focus:ring-2 focus:border-lime-300 focus:ring-offset-0" name="alamat" cols="30" rows="2" placeholder="Alamat"></textarea>

        <div class="flex  justify-around gap-5  -ml-[220px] items-end left-0">
            <label class="flex items-center   text-white" for="gender">Gender</label>
            <select required class=" h-10 " name="gender" id="gender">
                <option value="L">L</option>
                <option value="P">P</option>
            </select>

        </div>
       

        <div class="mt-5">
            <button type="submit" class="bg-green-400 flex  justify-center align-center p-2 rounded-lg text-white">Tambahkan</button>
        </div>
        
        </div>
    </form>
    </div>
</div>

@endsection