@extends('admin.layout.template')
@section('adminContent')

    <div class="border  shadow-lg  mx-40 p-2 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 ">
    <div class="flex justify-center items-center">
        <h1 class="text-2xl text-white">Registrasi Siswa</h1>
    </div>
    <div class="m-5 text-xl text-black font-bold">
        <div class="flex items-center ">
            
        <input class=" flex items-center justify-center placeholder:text-lg placeholder:text-slate-400 text-lg mx-2 w-96 rounded-lg outline-none focus:ring-lime-300 focus:ring-2 focus:border-lime-300 focus:ring-offset-0"    type="email" placeholder="Email" id="email">
        </div>
        
    </div>
</div>

@endsection