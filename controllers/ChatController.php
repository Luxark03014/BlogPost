<?php
namespace controllers;

use models\ChatModel;

class ChatController {
    private $chatModel;

    public function __construct($pdo) {
        $this->chatModel = new ChatModel($pdo);
    }

    public function fetchMessages() {
        return $this->chatModel->getMessages();
    }

    public function sendMessage($username, $message) {
        if (!empty($username) && !empty($message)) {
            return $this->chatModel->addMessage($username, $message);
        }
        return false;
    }
}
?>
