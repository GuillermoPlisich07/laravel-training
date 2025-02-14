<h1>
    Hi form my blade view
</h1>
<hr>
<h3>Texto = {{$text}}</h3>
<hr>
<h3>Declare varible</h3>
@php
   // $contador = 1;
@endphp
<h4>{{$contador}}</h4>
<hr>
<h3>Condicional 1</h3>
    @if ($contador == 1)
        <h4>El contador es igual a 1</h4>
    @endif
<hr>
<h3>Condicional 2</h3>
    @if ($contador == 2)
        <h4>El contador es igual a 2</h4>
    @else
        <h4>El contador no es igual a 2</h4>
    @endif
<hr>
<h3>Condicional 3</h3>
    @if ($contador == 3)
        <h4>El contador es igual a 3</h4>
    @elseif ($contador == 2)
        <h4>El contador es igual a 2</h4>
    @else
        <h4>El contador no es igual a 2 ni a 3</h4>
    @endif
<hr>
<h3>Condicional 4</h3>
    @switch($contador)
        @case(1)
            <h4>El contador es igual a 1</h4>
            @break
        @case(2)
            <h4>El contador es igual a 2</h4>
            @break
        @default
            <h4>El contador no es igual a 1 ni a 2</h4>
    @endswitch
<hr>
<h3>Condicional 5</h3>
<h4>{{ ($contador==1) ? "Es 1 desde ternario" : "No es 1 desde ternario" }}</h4>
<hr>
<h3>Bucles 1</h3>
<ul>
    @for ($i = 1; $i < 10; $i++)
        <li>Elemento {{$i}}</li>
    @endfor
</ul>
<hr>
<h3>Bucles 2</h3>
<ul>
    @foreach ($paises as $pais)
        <li>
            {{$loop->index.' '.$pais['nombre'].' | '.$pais['dominio']}}
        </li>
    @endforeach
</ul>
<hr>
@include('home.incluido')
<hr>
<x-componente :mensaje="$text"/>
<hr>
<ul>
    <li>
        <a href="{{ route('home_hola') }}">Hola inicio</a>
    </li>
    <li>
        <a href="{{ route('home_parametros',["id"=>1,"slug"=>"mi-slug"]) }}">Parametros</a>
    </li>
</ul>
<hr>
<h3>Archivos estaticos</h3>
<img src="{{asset("images/ort.png")}}" alt="">