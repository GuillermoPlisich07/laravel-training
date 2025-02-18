@extends('../layouts.frontend')

@section('content')
    <h1>BBD MySQL - Add Categorias</h1>
    <x-flash></x-flash>
    <form action="{{route('bd_categorias_add_post')}}" method="POST" name="form">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" {{old('nombre')}}>
        </div>
        <hr>
        {{csrf_field()}}
        <input type="submit" value="Enviar" class="btn btn-primary">
    </form>
    <br>
@endsection