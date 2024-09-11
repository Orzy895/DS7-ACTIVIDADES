<?php

// Incluir archivos de conexión y clase Automovil
include 'includes/Database.php';
include 'includes/Automovil.php';

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$db = $database->getConnection();

// Crear una instancia de la clase Automovil
$automovil = new Automovil($db);
$resultado = $automovil->obtenerCarros()
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda de auto</title>
    <link rel="stylesheet" href="./css/busqueda-table.css">
</head>

<body>

    <div>
        <h2>Introduzca la placa a buscar</h2>

        <form action="./process/procesar_busqueda.php" method="get">
            <input type="text" id="placa" name="placa" required><br>

            <input type="submit" value="Buscar">
        </form>
    </div>

    <div>
        <table>
            <tr>
                <th>Placa</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Color</th>
                <th>Motor</th>
                <th>Chásis</th>
            </tr>
            <?php if ($resultado): ?>
                <?php foreach ($resultado as $result): ?>
                    <tr>
                        <td><?php echo $result['placa']; ?></td>
                        <td><?php echo $result['marca']; ?></td>
                        <td><?php echo $result['modelo']; ?></td>
                        <td><?php echo $result['anio']; ?></td>
                        <td><?php echo $result['color']; ?></td>
                        <td><?php echo $result['motor']; ?></td>
                        <td><?php echo $result['chasis']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No se encontraron autos en la base de datos.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>

</body>

</html>