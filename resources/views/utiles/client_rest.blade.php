@extends('../layouts.frontend')

@section('content')
<h1>Client Rest</h1>
    <ul>
        @foreach($posts as $post)
            <li><strong>{{ $post['title'] }}</strong>: {{ $post['body'] }}</li>
        @endforeach
    </ul>

@endsection