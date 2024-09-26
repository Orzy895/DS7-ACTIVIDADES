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
    <form action="../processes/procesar_registro.php" method="post">

        <h2>Registrar Automóvil</h2>

        <label for="placa">Placa:</label>
        <input type="text" id="placa" name="placa" required><br>

        <label for="marca">Marca:</label>
        <select name="marca" id="marca" onchange="fetchModelos(this.value)">
            <option value="">Seleccione una marca</option>
            <?php foreach ($listaMarcas as $marca): ?>
                <option value="<?php echo htmlspecialchars($marca['id']); ?>">
                    <?php echo htmlspecialchars($marca['nombre']); ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="modelo">Modelo:</label>
        <select name="modelo" id="modelo">
            <option value="">Seleccione un modelo</option>
        </select>

        <label for="tipo">Tipo de automóvil:</label>
        <select name="tipo" id="tipo">
            <option value="">Seleccione un tipo de automóvil</option>
            <option value="Sedan">Sedán</option>
            <option value="Pickup">Pickup</option>
            <option value="Coupe">Coupé</option>
        </select>

        <label for="anio">Año:</label>
        <input type="number" id="anio" name="anio" required><br>

        <label for="color">Color:</label>
        <input type="text" id="color" name="color" required><br>

        <label for="propietario">Propietario (Identificación):</label>
        <input type="text" id="propietairo" name="propietario" required><br>

        <input type="submit" value="Registrar">
    </form>

    <script>
        function fetchModelos(marcaId) {
            if (marcaId === "") {
                document.getElementById("modelo").innerHTML = "<option value=''>Seleccione un modelo</option>";
                return;
            }

            // Create an XMLHttpRequest object
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "../processes/procesar_modelo.php?marca_id=" + marcaId, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var modelos = JSON.parse(xhr.responseText);
                    var modeloSelect = document.getElementById("modelo");
                    modeloSelect.innerHTML = "<option value=''>Seleccione un modelo</option>";

                    modelos.forEach(function(modelo) {
                        var option = document.createElement("option");
                        option.value = modelo.id;
                        option.textContent = modelo.nombre;
                        modeloSelect.appendChild(option);
                    });
                }
            };
            xhr.send();
        }
    </script>

</body>

</html>