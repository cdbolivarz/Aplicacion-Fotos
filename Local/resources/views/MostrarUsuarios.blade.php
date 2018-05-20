@extends('layouts.master')
@section('content')
@if (count($users) == 0)
		<div class="alert alert-danger">
				<p>NO hay usuarios</p>
			</div>
	@else
	<ul class="list-group">
	<h1> Todos los Usuarios</h1>
  			
			@foreach($users as $user)
			@if($user->id != $idUser)
			<li class="list-group-item">
    			<a href="{{ asset('UsuarioSeleccionado/'.$user->id)}}" class="btn btn-primary btn-lg active"> {{ $user->name }}  <span class="glyphicon glyphicon-user" ></span></a>
    			@if($type == 'A')
    			<form action="{{asset('borrarUsuario')}}" method="GET"	>
    			<input type="hidden" name="id" value="{{ $user->id }}" >
    				<button type="submit" name="eliminar" value="eliminar" class="btn btn-danger ">Eliminar Usuario
                    
                  </button>
    			</form>
    			
    			@endif
    			</li>
    			@endif
			@endforeach
			
		</ul>
    @endif
@endsection