@extends('../layouts.frontend')

@section('content')
    <main class="container">
        <h1>Paypal</h1>
        <x-flash/>
        @if($estado=='ok')
            <div class="alert alert-success">
                <h2>Transacción exitosa</h2>
                <p>Gracias por su compra</p>
                <p>Id Compra: {{ $id }}</p>
            </div>
        @endif
        @if($estado=='error')
            <div class="alert alert-danger">
                <h2>Transacción {{ $id }} ya esta caducada</h2>
            </div>
        @endif
    </main>
@endsection