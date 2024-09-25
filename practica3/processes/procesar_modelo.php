<?php
include '../includes/Database.php';
include '../includes/Modelo.php';

$database = new Database();
$db = $database->getConnection();

$marca_id = isset($_GET['marca_id']) ? $_GET['marca_id'] : null;

$modelos = new Modelo($db);
$modelosList = $modelos->obtenerModelos($marca_id);

if ($modelosList) {
    echo json_encode($modelosList);
} else {
    echo json_encode([]);
}
?>
