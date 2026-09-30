<?php
declare(strict_types=1);

namespace App\Modelos;

class Libro extends Material{
    public function diasPrestamo(): int{
        return 15;
    }
}