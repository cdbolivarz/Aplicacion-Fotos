@extends('layouts.master')
@section('content')
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
				<p>No tiene fotografías</p>
			</div>
	@else
		<div class="container">
			<div class="row">
				<div class='list-group gallery'>
				@foreach($images as $image)

           			<div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                		<form class="form-horizontal" role="form" method="GET" action="{{ asset('infoFoto') }}">
                		<button type="submit" class="boton" >
                		<img class="img-responsive" alt="" src="../../{{ $image->photo }}" />
                    		<div class='text-right'>
                        		<small class='text-muted'>{{ $image->title }}</small>
                    		</div> <!-- text-right / end -->
                    	</button>
                    	<input type="hidden" name="idImage" value="{{ $image->id }}" >
                      <button type="submit" name="etiquetar" value="etiquetar" class="btn btn-warning">Etiquetar 
                    </button>
                    @if($type == 'A')
                     <button type="submit" name="eliminar" value="eliminar" class="btn btn-danger">eliminar Imagen
                    </button>
                    @endif
               			</form>
           			</div> 

            	@endforeach

        		</div> <!-- list-group / end -->
			</div> <!-- row / end -->
		</div> <!-- container / end -->
@endif
@endsection