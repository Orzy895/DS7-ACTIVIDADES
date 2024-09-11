<?php
class Automovil
{
    private $conn; // Conexión a la base de datos
    private $table_name = "automoviles"; // Nombre de la tabla

    // Propiedades de la clase
    public $id;
    public $placa;
    public $marca;
    public $modelo;
    public $anio;
    public $color;

    // Constructor que recibe la conexión a la base de datos
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Método para registrar un nuevo automóvil
    public function registrar()
    {
        // Query para insertar un nuevo automóvil
        $query = "INSERT INTO " . $this->table_name . " (placa, marca, modelo, anio, color) VALUES (:placa, :marca, :modelo, :anio, :color)";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Limpiar los datos para evitar inyección SQL
        $this->placa = htmlspecialchars(strip_tags($this->placa));
        $this->marca = htmlspecialchars(strip_tags($this->marca));
        $this->modelo = htmlspecialchars(strip_tags($this->modelo));
        $this->anio = htmlspecialchars(strip_tags($this->anio));
        $this->color = htmlspecialchars(strip_tags($this->color));

        // Enlazar los parámetros
        $stmt->bindParam(":placa", $this->placa);
        $stmt->bindParam(":marca", $this->marca);
        $stmt->bindParam(":modelo", $this->modelo);
        $stmt->bindParam(":anio", $this->anio);
        $stmt->bindParam(":color", $this->color);

        // Ejecutar la declaración
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Obtener carros
    public function obtenerCarros()
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

    // Buscar auto por placa
    public function busquedaPlaca()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE placa = :placa";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Limpiar datos para evitar inyección SQL
        $this->placa = htmlspecialchars(strip_tags($this->placa));

        // Enlazar parámetros
        $stmt->bindParam(":placa", $this->placa);

        // Ejecutar la declaración
        $stmt->execute();

        // Verificar si hay datos
        if ($stmt->rowCount() > 0) {
            // Obtener datos
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return null;
    }
}
