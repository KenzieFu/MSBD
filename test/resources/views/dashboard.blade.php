@extends('layouts.template')
@section('siswaContent')
<div class="m-3">{{ Auth::user()->name }}</div>

@endsection
    