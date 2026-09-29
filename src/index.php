<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Producto</title>
</head>
<body>

<?php

$producto = [
[
    "Nombre" => "Laptop Gamer",
    "Precio" => 1250.50,
    "Categoria" => "ASUS",
    "Stock" => 15
],
[
        "Nombre"    => "Teclado Mecánico",
        "Precio"    => 85.00,
        "Categoria" => "Periféricos",
        "Stock"     => 30
    ],
    [
        "Nombre"    => "Monitor 4K",
        "Precio"    => 320.00,
        "Categoria" => "Pantallas",
        "Stock"     => 8
    ]
];

echo "<table border='1' style='border-collapse: collapse'>";

echo "<thead>";
echo "<tr>";
echo "<th>Nombre</th>";
echo "<th>Precio</th>";
echo "<th>Marca</th>";
echo "<th>Stock</th>";
echo "</tr>";
echo "</thead>";

echo "<tbody>";

$totalInventario = 0;
foreach($producto as $item){
    $totalInventario += $item['Precio'] * $item['Stock'];
    if ($item['Stock'] < 10){
        $stockTexto = "<td style= 'color: red;'>{$item['Stock']} (Bajo Stock)</td>";
    } else {
        $stockTexto = "<td>{$item['Stock']}</td>";
    }
    echo "<tr>";
    echo "<td>{$item['Nombre']}</td>";
    echo "<td>\${$item['Precio']}</td>";
    echo "<td>{$item['Categoria']}</td>";
    echo $stockTexto;
    echo "</tr>";
}
echo "<tr>";
echo "<td colspan='3'> Total Inventario</td>";
echo "<td>\$" . number_format($totalInventario, 2) . "</td>";
echo "</tr>";
echo "</tbody>";
echo "</table>";
?>

</body>
</html>