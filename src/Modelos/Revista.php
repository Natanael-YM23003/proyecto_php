<?php
declare(strict_types=1);

namespace App\Modelos;

class Revista extends Material { 
    public function diasPrestamo(): int{
        return 3;
    }
}
