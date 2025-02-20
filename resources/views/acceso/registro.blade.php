@extends('../layouts.frontend')

@section('content')
    <h1>Registros</h1>
    <x-flash/>
    <form name="form" action="{{ route('acceso_registro_post') }}" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="telefono">Telefono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono') }}">
        </div>
        <div class="form-group">
            <label for="direccion">Direccion</label>
            <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion') }}">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="password2">Password Confirmar</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>
        <hr>
        {{ csrf_field() }}
        <input type="submit" value="Enviar" class="btn btn-primary">
    </form>


@endsection