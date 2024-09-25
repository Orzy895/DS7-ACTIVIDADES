<?php
class Automovil
{
    private $conn; // Conexión a la base de datos
    private $table_name = "automoviles"; // Nombre de la tabla

    // Propiedades de la clase
    public $id;
    public $placa;
    public $marca_id;
    public $modelo_id;
    public $anio;
    public $color;
    public $propietario_id;

    // Constructor que recibe la conexión a la base de datos
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Método para registrar un nuevo automóvil
    public function registrar()
    {
        // Query para insertar un nuevo automóvil
        $query = "INSERT INTO " . $this->table_name . " (placa, marca_id, modelo_id, anio, color, propietario_id) VALUES (:placa, :marca_id, :modelo_id, :anio, :color, :propietario_id)";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Limpiar los datos para evitar inyección SQL
        $this->placa = htmlspecialchars(strip_tags($this->placa));
        $this->marca_id = htmlspecialchars(strip_tags($this->marca_id));
        $this->modelo_id = htmlspecialchars(strip_tags($this->modelo_id));
        $this->anio = htmlspecialchars(strip_tags($this->anio));
        $this->color = htmlspecialchars(strip_tags($this->color));
        $this->propietario_id = htmlspecialchars(strip_tags($this->propietario_id));

        // Enlazar los parámetros
        $stmt->bindParam(":placa", $this->placa);
        $stmt->bindParam(":marca_id", $this->marca_id);
        $stmt->bindParam(":modelo_id", $this->modelo_id);
        $stmt->bindParam(":anio", $this->anio);
        $stmt->bindParam(":color", $this->color);
        $stmt->bindParam(":propietario_id", $this->propietario_id);

        // Ejecutar la declaración
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Obtener carros
    public function obtenerCarros()
    {
        $query  = "SELECT 
                    automoviles.placa, 
                    automoviles.anio, 
                    automoviles.color, 
                    propietarios.nombre AS propietario, 
                    marcas.nombre AS marca, 
                    modelos.nombre AS modelo
                FROM 
                    automoviles
                JOIN 
                    propietarios ON automoviles.propietario_id = propietarios.id
                JOIN 
                    marcas ON automoviles.marca_id = marcas.id
                JOIN 
                    modelos ON automoviles.modelo_id = modelos.id";

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
        $query  = "SELECT 
                    automoviles.placa, 
                    automoviles.anio, 
                    automoviles.color, 
                    propietarios.nombre AS propietario, 
                    marcas.nombre AS marca, 
                    modelos.nombre AS modelo
                FROM 
                    automoviles
                JOIN 
                    propietarios ON automoviles.propietario_id = propietarios.id
                JOIN 
                    marcas ON automoviles.marca_id = marcas.id
                JOIN 
                    modelos ON automoviles.modelo_id = modelos.id
                WHERE 
                    automoviles.placa = :placa";

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
