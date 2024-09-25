<?php
class Propietario
{
    private $conn;
    private $table_name = "propietarios";

    public $id;
    public $nombre;
    public $telefono;
    public $identificacion;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Método para registrar un nuevo propietario
    public function registrar()
    {
        // Query para insertar un nuevo propietario
        $query = "INSERT INTO " . $this->table_name . " (nombre, telefono, identificacion) VALUES (:nombre, :telefono, :identificacion)";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Limpiar los datos para evitar inyección SQL
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->identificacion = htmlspecialchars(strip_tags($this->identificacion));

        // Enlazar los parámetros
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":identificacion", $this->identificacion);

        // Ejecutar la declaración
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function existeIdentificacion()
    {
        $query = "SELECT id FROM " . $this->table_name . " WHERE identificacion = :identificacion LIMIT 0,1";

        $stmt = $this->conn->prepare($query);

        $this->identificacion = htmlspecialchars(strip_tags($this->identificacion));

        $stmt->bindParam(":identificacion", $this->identificacion);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            return $this->id;
        }

        return false;
    }

}
