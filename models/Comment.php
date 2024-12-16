<?php
namespace models;

use PDO;

class Comment
{
    private $conn;
    private $table_name = "comments";

    // Propiedades del comentario
    public $id;
    public $text;
    public $publish_date;
    public $author_id;
    public $post_id;

    // Constructor con conexión a la base de datos
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Leer todos los comentarios de un post específico
    public function readByPost($postId)
    {
        // Consulta SQL para obtener comentarios de un post específico
        $query = "SELECT c.*, u.name AS author_name
        FROM " . $this->table_name . " c
        JOIN users u ON c.author_id = u.id
        WHERE c.post_id = :post_id
        ORDER BY c.publish_date DESC";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Enlazar el parámetro
        $stmt->bindParam(':post_id', $postId);

        // Ejecutar la consulta
        $stmt->execute();

        return $stmt;
    }

    // Crear un nuevo comentario
    public function create()
    {
        // Consulta SQL para insertar un nuevo comentario
        $query = "INSERT INTO " . $this->table_name . " (text, author_id, post_id) VALUES (:text, :author_id, :post_id)";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Enlazar los parámetros
        $stmt->bindParam(':text', $this->text);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':post_id', $this->post_id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Leer un comentario por su ID
    public function readOne($id)
    {
        // Consulta SQL para obtener un comentario específico
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Enlazar el parámetro
        $stmt->bindParam(':id', $id);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el primer resultado
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Asignar valores a las propiedades del comentario
        if ($row) {
            $this->id = $row['id'];
            $this->text = $row['text'];
            $this->publish_date = $row['publish_date'];
            $this->author_id = $row['author_id'];
            $this->post_id = $row['post_id'];
        }
    }

    // Borrar un comentario por su ID
    public function delete()
    {
        // Consulta SQL para eliminar un comentario
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Enlazar el parámetro
        $stmt->bindParam(':id', $this->id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Actualizar un comentario
    public function update()
    {
        // Consulta SQL para actualizar un comentario
        $query = "UPDATE " . $this->table_name . " SET text = :text WHERE id = :id";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Enlazar los parámetros
        $stmt->bindParam(':text', $this->text);
        $stmt->bindParam(':id', $this->id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
