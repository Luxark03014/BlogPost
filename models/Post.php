<?php
namespace models;

require_once 'config/Database.php';

use PDO;



class Post
{
    private $conn;
    private $table_name = 'posts'; 

    public $id;
    public $title;
    public $content;
    public $publish_date;
    public $author_id;


    
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // Métodos CRUD para los posts
    public function getDb(){
        return $this->conn;
    }

    
    public function read(){
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY publish_date 
        DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;

    }

    public function create($title, $content, $author_id){
        $query = "INSERT INTO " . $this->table_name . " (title, content, author_id) 
        VALUES (:title, :content, :author_id)";
        $stmt = $this->conn->prepare($query);
        // Bindear para que no haya inyección de SQL (en vez de poner '?')
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':author_id', $author_id);
        $stmt->execute();
        return $stmt;
    }

    public function update($id, $title, $content, $author_id){
        $query = "UPDATE " . $this->table_name . " SET title = :title, content = :content, author_id = :author_id WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':author_id', $author_id);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt;

    }

    public function readOne($id)
{
    // Prepara la consulta
    $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1";
    
    // Prepara la sentencia
    $stmt = $this->conn->prepare($query);
    
    // Vincula el parámetro
    $stmt->bindParam(':id', $id);
    
    // Ejecuta la consulta
    $stmt->execute();
    
    // Recupera el resultado como un array asociativo
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Devuelve el resultado
    return $post;
}

    public function delete($id){
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt;
    }

    
}
