@extends('../layouts.frontend')

@section('content')
    <h1>BBD MySQL - Edit Categorias</h1>
    <x-flash></x-flash>
    <form action="{{route('bd_categorias_edit_post',['id'=>$categoria->id])}}" method="POST" name="form">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" value="{{ $categoria->nombre }}">
        </div>
        <hr>
        {{csrf_field()}}
        <input type="submit" value="Enviar" class="btn btn-primary">
    </form>
    <br>
@endsection