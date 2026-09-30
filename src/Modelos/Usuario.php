<?php
declare(strict_types = 1);

namespace App\Modelos;

class Usuario {
    public function __construct(
        public readonly string $carnet,
        public readonly string $nombre
    ) {
        
    }
}