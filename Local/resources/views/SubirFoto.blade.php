@extends('layouts.master')
@section('content')
@if ( session()->has('message') )
    <div class="alert alert-danger fade in">{{ session()->get('message') }}</div>
@endif

<form class="form-horizontal" role="form" method="POST" action="{{asset('crearFoto')}}" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Titulo</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="fname" value="">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">descripcion</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="descripcion">
							</div>
						</div>
						<div>
						<label class="col-md-4 control-label">Selecione la imagen</label>
						<div class="col-md-6">
							<input id="input-1" name="foto" type="file" class="file">
						</div>
							
						</div>
						<br> <br>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
								   Subir foto
								</button>
							</div>
						</div>
		
@endsection