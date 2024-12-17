<?php

namespace models;

class User
{
    private $conn;
  
    public function __construct($db)
    {
        $this->conn = $db;
    }
    
}
