@extends('../layouts.frontend')

@section('content')
<h1>Helper</h1>
<hr>
{{ Str::slug("mi munieca me hablo") }}
<hr>
<h3>Desde controller: {{ $version }}</h3>
<hr>
<h3>Embebido en blade: {{ \App\Helpers\Helpers::getVersion() }}</h3>
<hr>
<h3>Parametro, desde controller: {{ $saludo }}</h3>
<hr>
<h3>Parametro, Embebido en blade: {{ \App\Helpers\Helpers::getNombre('Guillermo') }}</h3>
@endsection