<?php
declare(strict_types=1);

namespace App\Modelos;

use App\Enums\EstadoPrestamo;
class Prestamo { 
    public EstadoPrestamo $estado;
    public readonly \DateTimeImmutable $fechaInicio;
    public readonly \DateTimeImmutable $fechaDevolucionPrevista;
    public ?\DateTimeImmutable $fechaDevolucionReal = null;

    public function __construct(
        public readonly Material $material,
        public readonly Usuario $usuario
    ) {
        $this->estado = EstadoPrestamo::Activo;
        $this->fechaInicio = new \DateTimeImmutable();

        $dias = $this->material->diasPrestamo();
        $this->fechaDevolucionPrevista = $this->fechaInicio->modify("+{$dias} days");
    }

    public function devolver (\DateTimeImmutable $fechaDevolucion = new \DateTimeImmutable()): float {
        $this->fechaDevolucionReal = $fechaDevolucion;
        $this->estado = EstadoPrestamo::Devuelto;

        $this->material->liberar();

        if ($fechaDevolucion <= $this->fechaDevolucionPrevista) {
            return 0.0;
        }

        $diasRetraso = $this->fechaDevolucionPrevista->diff($fechaDevolucion)->days;

        return $diasRetraso * 5.00;
    }
}