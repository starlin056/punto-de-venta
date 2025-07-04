<?php

namespace App\Enums;

enum TipoTransaccionEnum: string
{ 
    case compra = 'COMPRA';
    case venta = 'VENTA';
    case Ajuste = 'AJUSTE';
    case Apertura = 'APERTURA';


}