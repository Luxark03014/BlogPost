<?php

namespace models;

class User
{
    private $conn;
    // Propiedades del usuario (id, username, email, etc.)
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // Métodos CRUD para el usuario (create, read, update, delete)
}
