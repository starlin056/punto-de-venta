@extends('layouts.app')

@section('title','Crear empleado')

@push('css')
<style>
  .card-custom {
    border: none;
    border-radius: 0.5rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
  }
  .img-preview-container {
    width: 100%;
    max-width: 250px;
    height: 250px;
    margin: auto;
    background: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 0.5rem;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .img-preview-container img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
  }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
  <h1 class="mt-4 text-center">Crear Empleado</h1>

  <x-breadcrumb.template>
    <x-breadcrumb.item :href="route('panel')" content="Inicio" />
    <x-breadcrumb.item :href="route('empleados.index')" content="Empleados" />
    <x-breadcrumb.item active="true" content="Crear Empleado" />
  </x-breadcrumb.template>

  {{-- Mensaje de éxito --}}
  @if(session('success'))
    <script>
      Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false
      });
    </script>
  @endif

  {{-- Errores de validación --}}
  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="card card-custom mt-4">
    <form action="{{ route('empleados.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="row g-0">
      @csrf

      <div class="col-lg-7 p-4">
        <h5 class="mb-4">Datos del empleado</h5>

        <div class="mb-3 form-floating">
          <input
            type="text"
            id="razon_social"
            name="razon_social"
            class="form-control"
            placeholder="Nombre y Apellidos"
            value="{{ old('razon_social') }}"
            required
          >
          <label for="razon_social">Nombre y Apellidos</label>
        </div>

        <div class="mb-3 form-floating">
          <input
            type="text"
            id="cargo"
            name="cargo"
            class="form-control"
            placeholder="Cargo"
            value="{{ old('cargo') }}"
            required
          >
          <label for="cargo">Cargo</label>
        </div>

        <div class="mb-4">
          <label for="img" class="form-label">Seleccionar imagen</label>
          <input
            class="form-control"
            type="file"
            id="img"
            name="img"
            accept="image/*"
          >
        </div>
      </div>

      <div class="col-lg-5 p-4 border-start d-flex flex-column align-items-center justify-content-center">
        <h6 class="mb-3">Vista previa</h6>
        <div class="img-preview-container mb-3">
          <img
            id="img-preview"
            src="{{ asset('assets/img/R.png') }}"
            alt="Vista previa"
          >
        </div>
        <button type="submit" class="btn btn-primary w-100">Guardar</button>
        <a href="{{ route('empleados.index') }}" class="btn btn-outline-secondary w-100 mt-2">
          Cancelar
        </a>
      </div>
    </form>
  </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  const inputImg = document.getElementById('img');
  const preview   = document.getElementById('img-preview');

  inputImg.addEventListener('change', () => {
    if (inputImg.files && inputImg.files[0]) {
      const reader = new FileReader();
      reader.onload = e => { preview.src = e.target.result; };
      reader.readAsDataURL(inputImg.files[0]);
    } else {
      preview.src = "{{ asset('assets/img/R.png') }}";
    }
  });
</script>
@endpush
