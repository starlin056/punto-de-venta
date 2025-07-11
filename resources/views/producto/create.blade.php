@extends('layouts.app')

@section('title','Crear Producto')

@push('css')
<style>
    #descripcion {
        resize: none;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Crear Producto</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('productos.index')}}">Productos</a></li>
        <li class="breadcrumb-item active">Crear producto</li>
    </ol>

    <div class="card">
        <form action="{{ route('productos.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body text-bg-light">

                <div class="row g-4">

                    <!---Nombre---->
                    <div class="col-12">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre')}}">
                        @error('nombre')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!---Descripción---->
                    <div class="col-12">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <textarea name="descripcion" id="descripcion" rows="3" class="form-control">{{old('descripcion')}}</textarea>
                        @error('descripcion')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                </div>

                <br>

                <div class="row g-4">

                    <div class="col-md-6">

                        <div class="row g-4">

                            <!---Imagen---->
                            <div class="col-12">
                                <label for="img_path" class="form-label">Imagen:</label>
                                <input type="file" name="img_path" id="img_path" class="form-control" accept="image/*">
                                @error('img_path')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <!----Codigo---->
                            <div class="col-12">
                                <label for="codigo" class="form-label">Código:</label>
                                <input type="text" name="codigo" id="codigo" class="form-control" value="{{old('codigo')}}">
                                @error('codigo')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <!---Marca---->
                            <div class="col-12">
                                <label for="marca_id" class="form-label">Marca:</label>
                                <select data-size="4"
                                    title="Seleccione una marca"
                                    data-live-search="true"
                                    name="marca_id"
                                    id="marca_id"
                                    class="form-control selectpicker show-tick">
                                    <option value="">No tiene marca</option>
                                    @foreach ($marcas as $item)
                                    <option value="{{$item->id}}" {{ old('marca_id') == $item->id ? 'selected' : '' }}>{{$item->nombre}}</option>
                                    @endforeach
                                </select>
                                @error('marca_id')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <!---Presentaciones---->
                            <div class="col-12">
                                <label for="presentacione_id" class="form-label">Presentación:</label>
                                <select data-size="4" title="Seleccione una presentación" data-live-search="true" name="presentacione_id" id="presentacione_id" class="form-control selectpicker show-tick">
                                    @foreach ($presentaciones as $item)
                                    <option value="{{$item->id}}" {{ old('presentacione_id') == $item->id ? 'selected' : '' }}>{{$item->nombre}}</option>
                                    @endforeach
                                </select>
                                @error('presentacione_id')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <!---Categorías---->
                            <div class="col-12">
                                <label for="categoria_id" class="form-label">Categoría:</label>
                                <select data-size="4"
                                    title="Seleccione la categoría"
                                    data-live-search="true"
                                    name="categoria_id"
                                    id="categoria_id"
                                    class="form-control selectpicker show-tick">
                                    <option value="">No tiene categoria</option>
                                    @foreach ($categorias as $item)
                                    <option value="{{$item->id}}" {{ old('categoria_id') == $item->id ? 'selected' : '' }}>
                                        {{$item->nombre}}
                                    </option>
                                    @endforeach
                                </select>
                                @error('categoria_id')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <p> Imagen del producto:</p>

                        <img id="img-default" 
                        class="img-fluid" 
                        src="{{ asset('assets/img/R.png') }}" 
                        alt="Imagen por defecto">

                        <img src="" alt="Ha cargado un archivo no compatible" 
                        id="img-preview"
                        class="img-fluid img-thumbnail" style="max-height: 350px; display: none;">

                    </div>

                </div>
            </div>

            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>


</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script>
    const inputImagen = document.getElementById('img_path'); 
    const imagenPreview = document.getElementById('img-preview');
    const imagenDefault = document.getElementById('img-default');

    inputImagen.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagenPreview.src = e.target.result; // Muestra la imagen seleccionada
                imagenPreview.style.display = 'block'; // Asegura que la imagen sea visible
                imagenDefault.style.display = 'none'; // Oculta la imagen por defecto
            };

            reader.readAsDataURL(this.files[0]); // Lee el archivo como URL
        }
    });
</script>

@endpush