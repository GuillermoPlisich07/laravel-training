@extends('../layouts.frontend')

@section('content')
    <h1>Formulario - Simple</h1>
    <x-flash></x-flash>
    <form action="{{route('formulario_simple_post')}}" method="POST" name="form">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" {{old('nombre')}}>
        </div>
        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellido" {{old('apellido')}}>
        </div>
        <div>
            <label for="pais">Pais</label>
            <select name="pais" id="pais" class="form-control">
                <option value="0">Selecciones....</option>
                @foreach ( $paises as $pais)
                    <option value="{{$pais['id']}}">{{$pais['nombre']}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Email" {{old('email')}}>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripcion">{{old('descripcion')}}</textarea>
        </div>
        <hr>
            <div class="form-group">
                <label for="intereses">Intereses</label>
                <div class="form-check">
                    @foreach($intereses as $interes)
                        <input type="checkbox" name="interes_{{$loop->index}}" id="interes_{{$loop->index}}" class="form-check-input" value="{{$interes['id']}}">
                        <label for="interes_{{$loop->index}}" class="form-check-label">{{$interes['nombre']}}</label>
                        <br>
                    @endforeach
                </div>
            </div>
        <hr>
        {{csrf_field()}}
        <input type="submit" value="Enviar" class="btn btn-primary">
    </form>
    <br>
@endsection