<?php
class Modelo
{
    private $conn;
    private $table_name = "modelos";

    public $id;
    public $nombre;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener carros
    public function obtenerModelos($marca_id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE marca_id = :marca_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':marca_id', $marca_id);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return null;
    }
}
