<?php
include '../includes/Database.php';
include '../includes/Modelo.php';
include '../includes/Marca.php';

$database = new Database();
$db = $database->getConnection();

$marcas = new Marca($db);
$listaMarcas = $marcas->obtenerMarcas();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Automóviles</title>
    <link rel="stylesheet" href="../css/registro.css">
</head>

<body>
    <form action="../processes/procesar_registro_propietario.php" method="post">

        <h2>Registrar Propietario</h2>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="telefono">Teléfono:</label>
        <input type="number" id="telefono" name="telefono" required><br>

        <label for="identificacion">Identificación:</label>
        <input type="text" id="identificacion" name="identificacion" required><br>

        <input type="submit" value="Registrar">
    </form>

</body>

</html>