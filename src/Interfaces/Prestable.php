<?php
declare(strict_types=1);

namespace App\Interfaces;

use App\Modelos\Usuario;
use App\Modelos\Prestamo;

interface Prestable {
    public function prestar(Usuario $u): Prestamo;
}