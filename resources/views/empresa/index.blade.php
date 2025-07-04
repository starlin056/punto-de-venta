@extends('layouts.app')

@section('title', 'Empresa')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')

<!-- parte de ventana de confirmacion -->
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: "{{ session('success') }}",
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif

<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Mi Empresa</h1>

    <x-breadcrumb.template>
        <x-breadcrumb.item :href="route('panel')" content="Inicio" />
        <x-breadcrumb.item active="true" content="Mi empresa" />
    </x-breadcrumb.template>
  
    <x-forms.template :action="route('empresa.update', ['empresa' => $empresa])" method="post" patch="true">
        <div class="row g-4">

            <div class="col-md-6">
                <input type="text" name="nombre" class="form-control" value="{{ $empresa->nombre ?? '' }}" placeholder="Nombre">
            </div>

            <div class="col-md-6">
                <input type="text" name="propietario" class="form-control" value="{{ $empresa->propietario ?? '' }}" placeholder="Propietario">
            </div>

            <div class="col-md-6">
                <input type="text" name="rnc" class="form-control" value="{{ $empresa->rnc ?? '' }}" placeholder="RNC">
            </div>

            <div class="col-md-6">
                <input type="text" name="direccion" class="form-control" value="{{ $empresa->direccion ?? '' }}" placeholder="Dirección">
            </div>

            <div class="col-md-6">
                <input type="number" name="porcentaje_impuesto" class="form-control" value="{{ $empresa->porcentaje_impuesto ?? '' }}" 
                    placeholder="Porcentaje del impuesto (%)">
            </div>

            <div class="col-md-6">
                <input type="text" name="abreviatura_impuesto" class="form-control" value="{{ $empresa->abreviatura_impuesto ?? '' }}" 
                    placeholder="Abreviatura del impuesto">
            </div>

            <div class="col-md-4">
                <input type="email" name="correo" class="form-control" value="{{ $empresa->correo ?? '' }}" placeholder="Correo">
            </div>

            <div class="col-md-4">
                <input type="text" name="telefono" class="form-control" value="{{ $empresa->telefono ?? '' }}" placeholder="Teléfono">
            </div>

            <div class="col-md-4">
                <input type="text" name="ubicacion" class="form-control" value="{{ $empresa->ubicacion ?? '' }}" placeholder="Ubicación">
            </div>

            <div class="col-12">
                <label for="moneda_id" class="form-label">Moneda Seleccionada:</label>
                <select name="moneda_id" id="moneda_id" class="form-select"> 
                    @foreach ($moneda as $moneda)
                        <option value="{{ $moneda->id }}"
                            {{ ($empresa->moneda_id ?? old('moneda_id')) == $moneda->id ? 'selected' : '' }}>
                            {{ $moneda->nombre_completo }}
                        </option>
                    @endforeach
                </select>
                @error('moneda_id')
                    <small class="text-danger">{{ '* ' . $message }}</small>
                @enderror
            </div>
        </div>

        <x-slot name="footer">
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </x-slot>
    </x-forms.template>
</div>
@endsection

@push('js')
@endpush
