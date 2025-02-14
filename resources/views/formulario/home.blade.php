@extends('../layouts.frontend')

@section('content')
    <h1>Formulario</h1>
    <ul>
        <li>
            <a href="{{route('formulario_simple')}}">Simple</a>
        </li>
        <li>
            <a href="{{route('formulario_flash')}}">Flash</a>
        </li>
        <li>
            <a href="{{route('formulario_upload')}}">Upload</a>
        </li>
    </ul>
@endsection