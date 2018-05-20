@extends('layouts.master')
@section('content')
@if (count($albums) == 0)
		<div class="alert alert-danger">
				<p>No tiene álbumes de fotografías</p>
			</div>
	@else
		<ul class="list-group">
  			<li class="list-group-item">
			@foreach($albums as $album)
    			<a href="{{ asset('albumSelect/'.$album->id.'/'.$album->idUser)}}" class="btn btn-lg btn-primary"> {{ $album->name }}  <span class="glyphicon glyphicon-folder-open">
    			</span></a>
			@endforeach
			</li>
		</ul>
	@endif

@endsection