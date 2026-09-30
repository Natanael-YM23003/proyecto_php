<?php
declare(strict_types=1);


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Requerimos el autoloader de Composer desde la raíz (subiendo un nivel desde public/)
require_once __DIR__ . '/../vendor/autoload.php';

use App\Modelos\Libro;
use App\Modelos\Revista;
use App\Modelos\Usuario;
use App\Excepciones\MaterialNoDisponibleException;

echo "=== SISTEMA DE BIBLIOTECA FMO ===<br><br>";

// 1. Crear Usuarios
$usuario1 = new Usuario("U001", "Francisco Yanes");
$usuario2 = new Usuario("U002", "María López");

// 2. Crear Materiales
$libro = new Libro("LIB-101", "Clean Architecture", 2017);
$revista = new Revista("REV-202", "National Geographic", 2024);

echo "1. Estado inicial del libro '{$libro->titulo}': " . ($libro->isDisponible() ? "Disponible" : "Prestado") . "<br>";
echo "   Días de préstamo asignados para este libro: " . $libro->diasPrestamo() . " días.<br><br>";

// 3. Realizar un Préstamo Exitoso
echo "2. Procesando préstamo de '{$libro->titulo}' para {$usuario1->nombre}...<br>";
$prestamoLibro = $libro->prestar($usuario1);

echo "   - Préstamo registrado con éxito.<br>";
echo "   - Estado del préstamo: " . $prestamoLibro->estado->value . "<br>";
echo "   - Fecha límite de devolución: " . $prestamoLibro->fechaDevolucionPrevista->format('Y-m-d H:i:s') . "<br>";
echo "   - Disponibilidad del libro ahora: " . ($libro->isDisponible() ? "Disponible" : "Prestado") . "<br><br>";

// 4. Intentar prestar el mismo libro (Debe saltar la Excepción)
echo "3. Intentando prestar el mismo libro a {$usuario2->nombre}...<br>";
try {
    $libro->prestar($usuario2);
} catch (MaterialNoDisponibleException $e) {
    echo "   ❌ EXCEPCIÓN ATRAPADA: " . $e->getMessage() . "<br><br>";
}

// 5. Devolución del material
echo "4. Procesando devolución del libro...<br>";
$multa = $prestamoLibro->devolver();

echo "   - Estado del préstamo ahora: " . $prestamoLibro->estado->value . "<br>";
echo "   - Multa calculada: $" . number_format($multa, 2) . "<br>";
echo "   - Estado del libro en catálogo: " . ($libro->isDisponible() ? "Disponible" : "Prestado") . "<br><br>";

// 6. Probar devolver con retraso simulado (10 días tarde)
echo "5. Simulando devolución con retraso de 10 días...<br>";
$prestamoRevista = $revista->prestar($usuario2);

$fechaTardia = $prestamoRevista->fechaDevolucionPrevista->modify("+10 days");
$multaMora = $prestamoRevista->devolver($fechaTardia);

echo "   - Días prestados para revistas: " . $revista->diasPrestamo() . " días.<br>";
echo "   - Multa por 10 días de demora ($5/día): $" . number_format($multaMora, 2) . "<br>";