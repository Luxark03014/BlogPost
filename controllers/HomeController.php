<?php

namespace controllers;


class HomeController
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function index()
    {
        $query = "SELECT users.name, messages.message, messages.created_at 
                  FROM messages 
                  JOIN users ON messages.user_id = users.id 
                  ORDER BY messages.created_at DESC LIMIT 20";
        $stmt = $this->db->query($query);
        $messages = $stmt->fetchAll(\PDO::FETCH_ASSOC);


        require_once __DIR__ . '/../views/home.php';
    }
}
