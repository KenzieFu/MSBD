@extends('layouts.template')
@section('siswaContent')

{{-- <div class="max-w m-3 p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
    
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Profile</h5>
    
    <div class="mb-3 flex-col flex font-normal text-gray-700 dark:text-gray-400">
        <span>Nama          :{{ auth()->user()->name }}</span>
        <span>NIS :{{ auth()->user()->NIS }}</span>
        <span>SMP  :{{ auth()->user()->SMP }}</span>
        <span>Tempat Lahir  :{{ auth()->user()->Kota_Lahir }}</span>
        <span>Alamat  :{{ auth()->user()->alamat }}</span>
        <span>Gender  :{{ auth()->user()->gender }}</span>
        <span>Status  :{{ auth()->user()->status }}</span>
    </div>
    <div class="flex gap-x-3 ">
        <form  action="{{ route('dashboard') }}">
            @csrf
      
    <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Back  
    </button>
        </form >

        <form  action="{{ route('dashboard') }}">
            @csrf
      
    <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Update  
    </button>
        </form >
    </div>

</div> --}}


<div class="border-b-2 block md:flex m-3">
    
    <div class="w-full md:w-2/5 p-4 sm:p-6 lg:p-8 bg-white shadow-md">
      <div class="flex justify-between">
        
        <span class="text-xl font-semibold block">Profile Siswa</span>
        <form method="POST" action="{{ route('updtprofile') }}">
            @csrf
        <button type="submit" class="-mt-2 text-md font-bold text-white bg-gray-700 rounded-full px-5 py-2 hover:bg-gray-800">Edit</button>
      </div>
      <div >
      <span class="text-gray-600 block">SMP :{{ auth()->user()->SMP }}</span>
      <span class="text-gray-600 block">Status :{{ auth()->user()->status }}</span>
      <span class="text-gray-600 block">Gender :{{ auth()->user()->gender }}</span>
    </div>
      <div class="w-full p-8 mx-2 flex justify-center">
        <img id="showImage" class="max-w-xs w-32 items-center border" src="img/student.png" alt="">                          
        </div>
    </div>
    
    <div class="w-full md:w-3/5 p-8 bg-white lg:ml-4 shadow-md">
      <div class="rounded  shadow p-6">
        <div class="pb-6">
          <label for="name" class="font-semibold text-gray-700 block pb-1">Name</label>
          <div class="flex">
            <input required id="name" class="border-1  rounded-r px-4 py-2 w-full" name="name" type="text" value={{ auth()->user()->name }} />
          </div>
        </div>
        <div class="pb-6">
          <label for="NIS" class="font-semibold text-gray-700 block pb-1">NIS</label>
          <div class="flex">
            <input disabled id="NIS" class="border-1  rounded-r px-4 py-2 w-full" type="text" name="NIS" value={{ auth()->user()->NIS }} />
          </div>
        </div>
        <div class="pb-6">
          <label for="kota" class="font-semibold text-gray-700 block pb-1">Kota Lahir</label>
          <div class="flex">
            <input required  id="kota" class="border-1  rounded-r px-4 py-2 w-full" name="Kota_Lahir" type="text" value="{{ auth()->user()->Kota_Lahir }}" />
          </div>
        </div>
        <div class="pb-4">
          <label for="alamat" class="font-semibold text-gray-700 block pb-1">Alamat</label>
          <textarea required id="alamat" name="alamat" class="border-1  rounded-r px-4 py-2 w-full" type="text" value="example@example.com"  >{{auth()->user()->alamat}}</textarea>
          
        </div>
      </div>
    </form>
    </div>

  </div>

</div>

@endsection