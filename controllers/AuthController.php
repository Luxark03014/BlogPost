<?php

namespace controllers;

use config\Database;
use PDO;

class AuthController {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    // Método de registro
    public function register($email, $name, $password, $role) {
      
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            return "El email ya está registrado.";
        }

        // Si el email no existe, proceder con el registro
        $stmt = $this->conn->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)");
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $passwordHash);
        $stmt->bindParam(':role', $role);

        if ($stmt->execute()) {
            return "Usuario registrado correctamente.";
        } else {
            return "Error al registrar el usuario.";
        }
    }

    // Método de login
    public function login($email, $password) {
        // Buscar el usuario por el email
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Guardar en la sesión el ID, el rol y el nombre de usuario
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['name'] = $user['name'];
            return true;
        }
        return false;
    }

    // Logout
    public function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Solo se inicia la sesión si no está activa
        }
        
        session_unset();  // Elimina todas las variables de sesión
        session_destroy(); // Destruye la sesión
    
        require_once __DIR__ . '/../views/home.php';
        exit();
    }
    
}
?>
