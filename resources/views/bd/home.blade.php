@extends('../layouts.frontend')

@section('content')
<h1>BDD MySQL</h1>
<ul>
    <li>
        <a href="{{ route('bd_categorias') }}">Categorias</a>
    </li>
    <li>
        <a href="{{ route('bd_productos') }}">Productos</a>
    </li>
    <li>
        <a href="{{ route('bd_productos_paginacion') }}">Productos-Paginacion</a>
    </li>
    <li>
        <a href="{{ route('bd_productos_buscador') }}">Productos-Buscador</a>
    </li>
</ul>
@endsection