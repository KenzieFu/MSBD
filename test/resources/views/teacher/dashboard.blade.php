@extends('teacher.layout.template')
@section('teacherContent')
<div class="m-3">{{ auth()->guard('teacher')->user()->name }}</div>

@endsection
    