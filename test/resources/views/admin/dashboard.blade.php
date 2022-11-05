@extends('admin.layout.template')
@section('adminContent')
<div class="m-3">{{ auth()->guard('admin')->user()->name }}</div>
@endsection
    
