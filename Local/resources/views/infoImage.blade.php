@extends('layouts.master')
@section('content')
  
  <div class="conteiner">
  <div class="row-fluid">



   <!-- Imagem -->

   <div class="col-md-3 col-md-offset-3">

    <img class="img-responsive" alt="" src="{{ $image->photo }}" />
    <h1>{{ $image->title }}
     <small>{{ $image->description }}</small></h1>
    </div>



    <!-- Comentarios -->
    <div class="col-md-4">

    <div class="list-group">
  <a href="#" class="list-group-item active">
    <h4 class="list-group-item-heading">Comentarios</h4>
    <p class="list-group-item-text">Dejar comentario</p>
  </a>
  @foreach($comments as $comment)
      <a href="#" class="list-group-item">
        <h4 class="list-group-item-heading" style="font-weight: bold">{{ $comment->author }}</h4>
        <p class="list-group-item-text">{{ $comment->description }}</p>
      </a>
  @endforeach
  <form method="POST" action="Comentario" class="list-group-item">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <h4 class="list-group-item-heading">Comentar</h4>
    <textarea class="list-group-item-text form-control" rows="5" name="comentario" required></textarea>
    <br>
    <input type="submit"  class="btn btn-success" onclick="recargar()" value="Comentar">
  </form>
</div>
</div>

<script type="text/javascript">
  function recargar(){
    location.reload();
  }
</script>
  </div>

  </div>

@endsection