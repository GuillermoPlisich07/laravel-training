@extends('../layouts.frontend')

@section('content')
<h1>BDD MySQL - Productos {{ $productos->total()}}</h1>
<x-flash/>
<p class="d-flex justify-content-end">
    <a href="{{ route('bd_productos_add') }}" class="btn btn-success"><i class="fas fa-check"></i>Crear</a>
</p>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Categoria</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Descripcion</th>
                <th>Fecha</th>
                <th>Fotos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($productos))
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td><a href="{{ route('bd_productos_categorias', ['id'=>$producto->categoria_id]) }}">{{ $producto->categorias->nombre }}</a></td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ number_format($producto->precio, 0,'','.') }}</td>
                        <td>{{ substr($producto->descripcion, 0, 50) }}...</td>
                        <td>{{ $producto->stock }}</td>
                        <td>{{ date('d-M-y', strtotime($producto->fecha)) }}</td>
                        <td>
                            <a href="{{ route('bd_productos_fotos', ['id'=>$producto->id]) }}"><i class="fas fa-camera"></i></a>
                        </td>
                        <td>
                            <a href="{{ route('bd_productos_edit',['id'=>$producto->id]) }}"><i class="fas fa-edit"></i></a>
                            <a href="javascript:void(0);" onclick="confirmaAlert('Quiere eliminar este registro?', '{{ route('bd_productos_delete',['id'=>$producto->id])}}')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
{{ $productos->links() }}
@endsection