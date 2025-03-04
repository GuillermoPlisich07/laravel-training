@extends('../layouts.frontend')

@section('content')
    <main class="container">
        <h1>Paypal</h1>
        <x-flash/>
        <ul>
            <li><strong>Producto</strong>: Mesa de computadora</li>
            <li><strong>Valor</strong>: USD10</li>
            <li><strong>Cantidad</strong>: 1</li>
            <li><strong>Orden de compra</strong>: {{ "orden_".$orden->id }}</li>
        </ul>
        <a class="btn btn-warning" href="{{ $response->json()['links'][1]['href'] }}"><i class="fab fa-paypal"></i>Pagar</a>
    </main>
@endsection