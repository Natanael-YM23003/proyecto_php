<?php
declare(strict_types=1);

namespace App\Modelos;

use App\Excepciones\MaterialNoDisponibleException;
use App\Interfaces\Prestable;

abstract class Material implements Prestable{
    protected bool $disponible = true;

    public function __construct(
        public readonly string $codigo,
        public readonly string $titulo,
        public readonly int $ano
    ) {}

abstract public function diasPrestamo(): int;

public function isDisponible(): bool
{
    return $this->disponible;
}

public function prestar(Usuario $u): Prestamo{

    if(!$this->disponible) {
        throw new MaterialNoDisponibleException("El material '{$this->titulo}' no esta disponible para prestamo");
    }


    $this->disponible = false;

    return new Prestamo($this, $u);
}

public function liberar(): void 
{
    $this->disponible = true;
}
}