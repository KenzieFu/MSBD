@extends('layouts.template')
@section('siswaContent')
<div class="m-3">Hi {{ Auth::user()->name }}</div>


@php
$diff_in_minutes=0;
if($ann !=null)
{
   $start = Carbon\Carbon::parse( $ann->created_at );
   $end= \Carbon\Carbon::parse( now());
   $diff_in_minutes = $end->diffInMinutes($start);
}
@endphp

@if($ann && $diff_in_minutes <2)

<div class="max-w m-3 p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Pengumuman</h5>
    <div class="mb-3 flex-col flex font-normal text-gray-700 dark:text-gray-400">
      {{ $ann->isi_pengumuman }}
    </div>
    <div>{{ $ann->created_at }}</div>
</div>

@endif

@endsection
    