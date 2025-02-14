@extends('../layouts.frontend')

@section('content')
    <h1>Ejemplo de Stack</h1>
    <a href="{{asset('images/yoda.png')}}" class="fancybox">
        <img src="{{asset('images/yoda.png')}}" width="100" height="100" />
    </a>

@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('fancybox/jquery.fancybox.css')}}" />
@endpush
@push('js')
    <script src="{{asset('fancybox/jquery.fancybox.js')}}"></script>
    <script>
        $(".fancybox").ready(function(){
            $(".fancybox").fancybox(
                {
                    openEffect: 'none',
                    closeEffect: 'none',
                    
                }
            );
        });
    </script>
@endpush