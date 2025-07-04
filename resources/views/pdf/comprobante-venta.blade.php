<!-- resources/views/comprobante_pdf.blade.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Venta</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
        }

        .header {
            background: #4f46e5;
            color: #fff;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            display: flex;
            justify-content: space-between;
        }

        .header h1 {
            margin: 0;
            font-size: 1.4em;
            text-transform: uppercase;
        }

        .header .doc {
            text-align: right;
        }

        .section {
            margin: 20px 0;
        }

        .section h3 {
            font-size: 0.9em;
            color: #555;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .grid-2 {
            display: flex;
            justify-content: space-between;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 0.85em;
        }

        th {
            background: #eee;
            text-transform: uppercase;
        }

        tr:nth-child(even) td {
            background: #f9f9f9;
        }

        .totals-box {
            border: 1px solid #ddd;
            background: #f3f4f6;
            padding: 12px;
            border-radius: 6px;
            width: 300px;
            float: right;
            margin-top: 20px;
        }

        .totals-box .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
            font-size: 0.9em;
        }

        .totals-box .row.total {
            font-weight: bold;
            font-size: 1em;
        }

        .footer {
            clear: both;
            text-align: center;
            font-size: 0.75em;
            color: #4f46e5;
            margin-top: 150px;
        }
         /** colores y tamano de informacion de factura cliente empresa ect */
        .info-box {
            border: 1px solid #ddd;
            background:rgb(206, 217, 239);
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 0.85em;
        }

        .info-box h3 {
            font-size: 0.9em;
            font-weight: bold;
            color: #555;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .info-box p {
            margin: 4px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div>
                <h1>{{ strtoupper($empresa->nombre) }}</h1>
                <div>RNC: {{ $empresa->rnc }}</div>
            </div>
            <div class="doc">
                <div style="font-size:1.2em; font-weight:bold;">{{ strtoupper($venta->comprobante->nombre) }}</div>
                <div># {{ $venta->numero_comprobante }}</div>
            </div>
        </div>

        
        <!-- Sección de Información en cuadros -->
        <div class="section">

            <!-- Empresa -->
            <div class="info-box">
                <h3>Información de la Empresa</h3>
                <p><strong>Dirección:</strong> {{ strtoupper($empresa->direccion) }} - {{ strtoupper($empresa->ubicacion) }}</p>
                <p><strong>Tel:</strong> {{ $empresa->telefono ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $empresa->correo ?? 'N/A' }}</p>
            </div>

            <!-- Documento -->
            <div class="info-box">
                <h3>Detalles del Documento</h3>
                <p><strong>Fecha:</strong> {{ date("d/m/Y", strtotime($venta->fecha_hora)) }}</p>
                <p><strong>Hora:</strong> {{ date("H:i", strtotime($venta->fecha_hora)) }}</p>
                <p><strong>Cajero:</strong> {{ $venta->user->empleado->razon_social ?? $venta->user->name }}</p>
            </div>

            <!-- Cliente -->
            <div class="info-box">
                <h3>Información del Cliente</h3>
                <p><strong>Nombre:</strong> {{ strtoupper($venta->cliente->persona->razon_social) }}</p>
                <p><strong>{{ strtoupper($venta->cliente->persona->documento->nombre) }}:</strong> {{ $venta->cliente->persona->numero_documento }}</p>
                <p><strong>Dirección:</strong> {{ strtoupper($venta->cliente->persona->direccion) }}</p>
            </div>

        </div>



        <!-- Productos -->
        <div class="section">
            <table>
                <thead>
                    <tr>
                        <th>Cant.</th>
                        <th>Unidad</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($venta->productos as $detalle)
                    <tr>
                        <td>{{ $detalle->pivot->cantidad }}</td>
                        <td>{{ $detalle->presentacione->sigla }}</td>
                        <td>{{ $detalle->nombre }}</td>
                        <td>{{ number_format($detalle->pivot->precio_venta,2) }} {{ $empresa->moneda->simbolo }}</td>
                        <td>{{ number_format($detalle->pivot->cantidad * $detalle->pivot->precio_venta,2) }} {{ $empresa->moneda->simbolo }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Totales en cuadro -->
        <div class="totals-box">
            <div class="row"><span>Subtotal:</span><span>{{ number_format($venta->subtotal,2) }} {{ $empresa->moneda->simbolo }}</span></div>
            <div class="row"><span>{{ $empresa->abreviatura_impuesto }}:</span><span>{{ number_format($venta->impuesto,2) }} {{ $empresa->moneda->simbolo }}</span></div>
            <div class="row total"><span>Total:</span><span>{{ number_format($venta->total,2) }} {{ $empresa->moneda->simbolo }}</span></div>
        </div>

        <!-- Footer -->
        <div class="footer">
            NO SE ACEPTAN CAMBIOS NI DEVOLUCIONES DESPUÉS DE 24 HORAS<br>
            Este documento es representación de un comprobante electrónico
        </div>
    </div>
</body>

</html>