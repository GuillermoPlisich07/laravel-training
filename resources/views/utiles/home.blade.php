@extends('../layouts.frontend')

@section('content')
<h1>Utiles</h1>
<ul>
    <li>
        <a href="{{ route('utiles_pdf') }}">Reporte PDF</a>
    </li>
    <li>
        <a href="{{ route('utiles_excel') }}">Reporte Excel</a>
    </li>
    <li>
        <a href="{{ route('utiles_client_rest') }}">Cliente Rest con guzzlehttp</a>
    </li>
    <li>
        <a href="{{ route('utiles_client_soap') }}">Client SOAP</a>
    </li>
</ul>
@endsection