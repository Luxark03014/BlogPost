<?php

    class AuthMiddleware {
        public static function checkAuth() {
            if (!isset($_SESSION['user_id'])) {
                header('Location: /login');
                exit();
            }
        }

        public static function checkRole($role) {
            if ($_SESSION['role'] !== $role) {
                header('Location: /');
                exit();
            }
        }

    }