@extends('../layouts.frontend')

@section('content')
    <main class="container">
        <h1>Paypal</h1>
        <x-flash/>
        <div class="alert alert-warning">
            <h2>Se cancelo la orden</h2>
            <p>Id: {{ $id }}</p>
        </div>
    </main>
@endsection