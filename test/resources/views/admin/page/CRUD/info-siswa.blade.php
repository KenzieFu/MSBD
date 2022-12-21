@extends('admin.layout.template')
@section('adminContent')

<div class="max-w m-3 p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
    <div class="mb-5">
        <h1 class="text-3xl">Details Siswa</h1>
    </div>
    <table style="border-collapse: collapse;" class="w-[80%]  mb-3">
        <tr  style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Nama Siswa</td>
            <td>&nbsp;:&nbsp;</td>
            <td> {{ $siswa->name }}</td>
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>NIS</td>
            <td>&nbsp;:&nbsp;</td>
            <td> {{ $siswa->NIS }}</td>
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Gender</td>
            <td>&nbsp;:&nbsp;</td>
            <td> {{ $siswa->gender }}</td>
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>SMP</td>
            <td>&nbsp;:&nbsp;</td>
            <td> {{ $siswa->SMP }}</td>
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Kelas</td>
            <td>&nbsp;:&nbsp;</td>
            <td> {{ $siswa->nama_kelas }}</td>
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Kota Lahir</td>
            <td>&nbsp;:&nbsp;</td>
            <td> {{ $siswa->Kota_Lahir }}</td>
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Alamat</td>
            <td>&nbsp;:&nbsp;</td>
            <td> {{ $siswa->alamat }}</td>
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Tahun Masuk</td>
            <td>&nbsp;:&nbsp;</td>
            <td> {{ $siswa->TahunAjaran }}</td>
        </tr>
        <tr style="border-bottom: 1px solid #ccc; line-height: 1.8em;" class="w-[100%]">
            <td>Status</td>
            <td>&nbsp;:&nbsp;</td>
            <td> {{ $siswa->status }}</td>
        </tr>
    </table>

    <form action="{{ route('admin.tSiswa') }}">
        @csrf
        <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Back</button>
    </form>
</div>

@endsection