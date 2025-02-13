@extends('../layouts.frontend')

@section('content')
    <h1>Formulario - Upload</h1>
    <x-flash></x-flash>
    <form action="{{route('formulario_upload_post')}}" method="POST" name="form" enctype="multipart/form-data">
        
        <div class="form-group">
            <label for="foto">Archivo: </label>
            <input type="file" name="foto" id="foto" class="form-control"/>
        </div>
        
        <hr>
        {{csrf_field()}}
        <input type="submit" value="Enviar" class="btn btn-primary">
    </form>
    <br>
    
@endsection