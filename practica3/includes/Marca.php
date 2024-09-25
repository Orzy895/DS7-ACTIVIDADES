<?php
class Marca
{
    private $conn; // Conexión a la base de datos
    private $table_name = "marcas"; // Nombre de la tabla

    // Propiedades de la clase
    public $id;
    public $nombre;
    public $marca;

    // Constructor que recibe la conexión a la base de datos
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener carros
    public function obtenerMarcas()
    {
        $query  = "SELECT * FROM " . $this->table_name;

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Ejecutar la declaración
        $stmt->execute();

        // Verificar si hay datos
        if ($stmt->rowCount() > 0) {
            // Obtener datos
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return null;
    }
}