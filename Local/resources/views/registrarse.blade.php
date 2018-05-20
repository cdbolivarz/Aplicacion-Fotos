@extends('layouts.master')

@section('content')
@if ( session()->has('message') )
    <div class="alert alert-danger fade in">{{ session()->get('message') }}</div>
@endif
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Registrarse</div>
				<div class="panel-body">

					<form class="form-horizontal" role="form" method="POST" action="{{asset('register')}}" >
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Nombre</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="fname" value="" minlength="6" required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Contraseña</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="passwd" minlength="6" required>
								<small id="passwordHelpInline" class="text-muted"> Debe tener entre 6 - 16 dígitos, letras mayúscuas, minúsculas y al menos un número  </small>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Nickname</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="nickn" value="" minlength="6" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Avatar</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="avatar" value="" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Tipo Usuario</label>
							<div class="col-md-6">
							<div class="radio">
								<label><input type="radio" name="radio" id="U" value="U" required>Regular</label>
							</div>
							<div class="radio">
								<label><input type="radio" name="radio" id="P" value="P" required>Premium</label>
							</div>

							</div>
						</div>
						
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Registrarse
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
