@extends('layouts.master')
@section('content')
@if ( session()->has('message') )
    <div class="alert alert-danger fade in">{{ session()->get('message') }}</div>
@endif
<a href="{{asset('urlfoto')}}" class="btn btn-primary" style="position: fixed;margin-left: 3%;margin-top: 5%" role="button">Subir foto</a>
<br>
<form method="GET" action="{{ asset('cambiarPosiciones') }}">
<input type="hidden" id="valores" name="vectorCambios">
<input type="submit" class="btn btn-success" id="guardar" style="position: fixed;margin-left: 3%;margin-top: 8%;visibility: hidden;" role="button" value="Guardar cambios" >
</form>
<style type="text/css">
.boton{
  background:none;
  border:none;
}

.boton:hover{
  border:1px solid #6E7DEA;
}
</style>
@if (count($images) == 0)
		<div class="alert alert-danger">
				<p>No tienes fotografías, Crea una.</p>
			</div>
	@else
		<div class="container">
    <h1>Mis fotos</h1>
			<div class="row">
				<div class='list-group gallery'>
        @php
         $i = 0;
         $size = count($images);
        @endphp
				@foreach($images as $image)
        @php
         $i = $i + 1;
         @endphp

           			<div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                		<form class="form-horizontal" role="form" method="GET" action="{{ asset('infoFoto') }}">
                		<button type="submit" class="boton" >
                		<img class="img-responsive" alt="" src="../../{{ $image->photo }}" />
                    		<div class='text-right'>
                        		<small class='text-muted'>{{ $image->title }}</small>
                    		</div> <!-- text-right / end -->
                    	</button>
                    		<input type="hidden" name="idImage" value="{{ $image->id }}" >
                        <button type="submit" name="eliminar" value="eliminar" class="btn btn-danger ">Eliminar
                    
                    </button>
                    @if($idUser == $image->prop ) 
                    <button type="submit" name="actualizar" value="actualizar" class="btn btn-warning">Actualizar</button>
                    @endif
                    <div class="input-group input-group-lg">
                    <span class="input-group-addon posicion" id="posicion" id="sizing-addon1">{{ $i }}</span>
                    
                     <input type="number" onchange="intercambio(this,document.getElementsByClassName('posicion')[{{ $i-1 }}])" title="Intercambie la posición de la imagen con una ya existente" class="form-control campo" placeholder="Posicion nueva" aria-describedby="sizing-addon1">
                     </div>
               			</form>
           			</div> <!-- col-6 / end -->

            	@endforeach

        		</div> <!-- list-group / end -->
			</div> <!-- row / end -->

		</div> <!-- container / end -->
<script type="text/javascript">
var listaCambios = new Array({{ $size }});
  function intercambio(campo,campant){
    
    if(campo.value > {{ $size }}){
      campo.value = "";
      return -1;
    }
    
    var listaPosiciones = document.getElementsByClassName('posicion');
    var listaCampos = document.getElementsByClassName('campo');
    document.getElementById('guardar').style.visibility = 'visible';

 
    var index;
    
    for (index = 0, len = listaPosiciones.length; index < len; ++index) {
      

        if(listaPosiciones[index].innerHTML.trim() == campo.value.toString().trim()){

              listaPosiciones[index].innerHTML = campant.innerHTML.trim();
              campant.innerHTML = campo.value.toString().trim();
              campo.value = "";
              break;
        }
}
      
       for (index = 0, len = listaPosiciones.length; index < len; ++index) {
            listaCampos[index].style.visibility='hidden';
            listaCambios[index]=listaPosiciones[index].innerHTML;
        }
        document.getElementById("valores").value = listaCambios.toString();

    
  }
</script>

@endif
@endsection