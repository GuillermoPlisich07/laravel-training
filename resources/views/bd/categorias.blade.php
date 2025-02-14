@extends('../layouts.frontend')

@section('content')
<h1>BDD MySQL - Categorias</h1>
<x-flash/>
<p class="d-flex justify-content-end">
    <a href="" class="btn btn-success"><i class="fas fa-check"></i>Crear</a>
</p>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->nombre }}</td>
                    <td>
                        <a href=""><i class="fas fa-edit"></i></a>
                        <a href=""><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection