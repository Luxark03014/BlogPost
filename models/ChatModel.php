<?php

namespace models;

use PDO;

class ChatModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getMessages() {
        $stmt = $this->pdo->query("SELECT * FROM messages ORDER BY timestamp DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addMessage($username, $message) {
        $stmt = $this->pdo->prepare("INSERT INTO messages (username, message) VALUES (?, ?)");
        return $stmt->execute([$username, $message]);
    }
}
?>
