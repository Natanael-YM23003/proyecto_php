<?php
declare(strict_types = 1);

namespace App\Enums;

enum EstadoPrestamo: string
{
    case Activo = 'ACTIVO';
    case Devuelto = 'DEVUELTO';
    case Vencido = 'VENCIDO';
}
