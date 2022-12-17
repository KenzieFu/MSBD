@extends('admin.layout.template')
@section('adminContent')
<div class="m-3">{{ auth()->guard('auth')->user()->name }}</div>

@endsection
    
