<!DOCTYPE html> 
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Venta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            background: #ffffff;
            padding: 20px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background: #007bff;
            color: #ffffff;
            padding: 15px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            border-radius: 10px 10px 0 0;
        }
        .email-body {
            padding: 20px;
            font-size: 16px;
            color: #333333;
        }
        .email-footer {
            background: #f1f1f1;
            padding: 10px;
            text-align: center;
            font-size: 14px;
            color: #777777;
            border-radius: 0 0 10px 10px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            ¡Hola {{$venta->cliente->persona->razon_social}}!
        </div>
        <div class="email-body">
            <p>Te enviamos el comprobante de tu compra.</p>
            <p>Esperamos que tengas un excelente día.</p>
        </div>
        <div class="email-footer">
            <p>No responder a este correo.</p>
            <p>&copy; 2025 Pedro Ureña. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
