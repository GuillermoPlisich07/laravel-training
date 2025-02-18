@extends('../layouts.frontend')

@section('content')
    <h1>BBD MySQL - Edit Productos</h1>
    <x-flash></x-flash>
    <form action="{{route('bd_productos_edit_post',['id'=>$producto->id])}}" method="POST" name="form">
        <div class="form-group">
            <label for="categoria_id">Categoria</label>
            <select name="categoria_id" id="categoria_id" class="form-control">
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ ($producto->categoria_id == $categoria->id ) ? "selected":""}} >{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $producto->nombre }}" placeholder="Nombre">
        </div>
        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="text" name="precio" id="precio" class="form-control" value="{{ $producto->precio }}" placeholder="Precio">
        <div class="form-group">
            <label for="stock">Stock</label>
            <select name="stock" id="stock" value="{{ $producto->nombre }}" class="form-control">
                @for ($i = 0; $i <= 100; $i++)
                    <option value="{{$i}}" {{ ($producto->stock == $i) ? "selected":""}}>{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <textarea name="descripcion" id="descripcion" class="form-control">{{ $producto->descripcion }}</textarea>
        </div>
        <hr>
        {{csrf_field()}}
        <input type="submit" value="Enviar" class="btn btn-primary">
    </form>
    <br>
@endsection