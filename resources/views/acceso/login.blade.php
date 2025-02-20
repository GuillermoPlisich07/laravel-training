@extends('../layouts.frontend')

@section('content')
    <h1>Login</h1>
    <x-flash/>
    <form name="form" action="{{ route('acceso_login_post') }}" method="POST">

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <hr>
        {{ csrf_field() }}
        <input type="submit" value="Enviar" class="btn btn-primary">
    </form>


@endsection