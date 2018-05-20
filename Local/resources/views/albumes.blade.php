@extends('layouts.master')
@section('content')
	@if (count($albums) == 0)
		<div class="alert alert-danger">
				<p>No tienes álbumes de fotografías. Crea uno.</p>
			</div>
	@else
		<ul class="list-group">
		<h1>Mis Albumes</h1>
  			<li class="list-group-item">
			@foreach($albums as $album)
    			<a href="{{ asset('albumSeleccionado/'.$album->id.'/'.$album->idUser)}}" class="btn btn-lg btn-primary"> {{ $album->name }}  <span class="glyphicon glyphicon-folder-open"></span></a>
			@endforeach
			</li>
		</ul>
	@endif
	<center><a href="{{asset('crearAlbum')}}" class="btn btn-primary" role="button">Crear Album</a></center>
@endsection