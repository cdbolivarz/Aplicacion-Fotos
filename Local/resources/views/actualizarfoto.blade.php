@extends('layouts.master')
@section('content')
<form class="form-horizontal" role="form" method="POST" action="{{asset('actualizarFoto')}}" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Titulo</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="fname" value="" required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">descripcion</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="descripcion" required>
								<input type="hidden" name="idImage" value="{{$id}}" >
							</div>
						</div>
						</div>

						<br> <br>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
								   Actualizar
								</button>
							</div>
						</div>
@endsection