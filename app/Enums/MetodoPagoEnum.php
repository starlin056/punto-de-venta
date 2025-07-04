<?php

namespace App\Enums;


enum MetodoPagoEnum: string
{
    case EFECTIVO = 'EFECTIVO';
    case TARJETA = 'TARJETA';
    case TRANSFERENCIA = 'TRANSFERENCIA';
}
