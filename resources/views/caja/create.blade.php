@extends('layouts.app')

@section('title','Crear caja')

@push('css')
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
    <h1 class="mt-4 text-center">Aperturar Caja</h1>

    <x-breadcrumb.template>
        <x-breadcrumb.item :href="route('panel')" content="Inicio" />
        <x-breadcrumb.item :href="route('cajas.index')" content="cajas" />
        <x-breadcrumb.item active='true' content=" Aperturar Caja " />
    </x-breadcrumb.template>


    <x-forms.template :action="route('cajas.store')" method='post'>
        <div class="row g-4">

            <div class="col-12">
                <x-forms.input id="saldo_inicial" required='true' type='number'
                labelText='saldo inicial' />
            </div>


        </div>

        <x-slot name='footer'>
            <button type="submit" class="btn btn-primary">Aperturar caja</button>
        </x-slot>
    </x-forms.template>

    </div>
    @endsection

    @push('js')
    @endpush