@extends('layouts.master')
@section('content')
@if ( session()->has('message') )
    <div class="alert alert-danger fade in">{{ session()->get('message') }}</div>
@endif
<form class="form-horizontal" role="form" method="POST" action="{{asset('crearAlbum')}}" >
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Nombre</label>
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
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
								   Crear
								</button>
							</div>
						</div>
</form>
@endsection