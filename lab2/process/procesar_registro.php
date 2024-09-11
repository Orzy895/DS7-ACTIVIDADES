<?php
// Incluir archivos de conexión y clase Automovil
include '../includes/Database.php';
include '../includes/Automovil.php';

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$db = $database->getConnection();

// Crear una instancia de la clase Automovil
$automovil = new Automovil($db);

// Obtener los datos del formulario
$automovil->placa = $_POST['placa'];
$automovil->marca = $_POST['marca'];
$automovil->modelo = $_POST['modelo'];
$automovil->anio = $_POST['anio'];
$automovil->color = $_POST['color'];
$automovil->motor = $_POST['motor'];
$automovil->chasis = $_POST['chasis'];

// Registrar el automóvil
if ($automovil->registrar()) {
    echo "<p>Registro realizado exitosamente</p>";
    echo "<script>
            setTimeout(function(){
                window.location.href = '../registrar_automovil.php'
             }, 5000)
        </script>";
    
} else {
    echo "Error al registrar el automóvil.";
}
?>
