@extends('layouts.templateheader')
@section('content')
@if (session()->has('message') )
    <div class="alert alert-success">{{ session()->get('message') }}</div>
@endif
@endsection