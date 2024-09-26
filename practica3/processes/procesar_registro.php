<?php
// Incluir archivos de conexión y clase Automovil
include '../includes/Database.php';
include '../includes/Automovil.php';
include '../includes/Propietario.php';

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$db = $database->getConnection();

// Crear una instancia de la clase Automovil
$automovil = new Automovil($db);

//Si marca y modelo estan vacios
if (empty($_POST['marca']) || empty($_POST['modelo']) || empty($_POST['modelo'])) {
    echo "Seleccione una marca, modelo y tipo de vehiculo para poder registar el automovil";
    exit();
}

// Obtener los datos del formulario
$automovil->placa = $_POST['placa'];
$automovil->marca_id = $_POST['marca'];
$automovil->modelo_id = $_POST['modelo'];
$automovil->anio = $_POST['anio'];
$automovil->color = $_POST['color'];
$automovil->tipo = $_POST['tipo'];

//Revisar si el propietario existe
$propietario = new Propietario($db);
$propietario->identificacion = $_POST['propietario'];
if ($propietario->existeIdentificacion()) {
    $automovil->propietario_id = $propietario->id;

    // Registrar el automóvil
    if ($automovil->registrar()) {
        echo "Automóvil registrado exitosamente.";
    } else {
        echo "Error al registrar el automóvil.";
    }
} else {
    echo "El propietario no existe.";
}
