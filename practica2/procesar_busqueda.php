<?php
// Incluir archivos de conexión y clase Automovil
include 'includes/Database.php';
include 'includes/Automovil.php';

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$db = $database->getConnection();

// Crear una instancia de la clase Automovil
$automovil = new Automovil($db);

// Obtener los datos del formulario
$automovil->placa = $_GET['placa'];

// Obtener datos de búsqueda
$resultado = $automovil->busquedaPlaca();
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
        <table>
            <tr>
                <th>Placa</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Color</th>
            </tr>
            <?php if ($resultado) : ?>
                <tr>
                    <td><?php echo $resultado['placa']; ?></td>
                    <td><?php echo $resultado['marca']; ?></td>
                    <td><?php echo $resultado['modelo']; ?></td>
                    <td><?php echo $resultado['anio']; ?></td>
                    <td><?php echo $resultado['color']; ?></td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="5">No se encontró un auto con dicha placa</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>

</html>