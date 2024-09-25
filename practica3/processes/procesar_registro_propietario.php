<?php
// Incluir archivos de conexión y clase propietario
include '../includes/Database.php';
include '../includes/Propietario.php';

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$db = $database->getConnection();

// Crear una instancia de la clase propietario
$propietario = new Propietario($db);

// Obtener los datos del formulario
$propietario->nombre = $_POST['nombre'];
$propietario->telefono = $_POST['telefono'];
$propietario->identificacion = $_POST['identificacion'];

// Registrar el propietario
if ($propietario->registrar()) {
    echo "Propietario registrado exitosamente.";
} else {
    echo "Error al registrar el propietairo.";
}
?>
