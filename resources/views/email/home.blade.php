@extends('../layouts.frontend')

@section('content')
<h1>Email</h1>
<x-flash/>
<a href="{{ route('email_enviar') }}">Enviar</a>
@endsection