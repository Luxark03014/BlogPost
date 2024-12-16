<?php

require_once 'vendor/autoload.php';

use controllers\PostController;
use controllers\HomeController;
use controllers\AuthController;
use controllers\CommentController;
use config\Database;

session_start();

function isAuthenticated()
{
    return isset($_SESSION['user_id']);
}

function hasRole($role)
{
    return $_SESSION['role'] === $role;
}   

// Crear la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Instanciar los controladores y pasar la conexión a la base de datos
$controller = new PostController($db);
$home = new HomeController($db);
$authController = new AuthController($db);
$commentController = new CommentController($db);

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request = str_replace("/blog", "", $request);

switch ($request) {
    case '/':
        $home->index();
        break;

    case '/notes':
        $controller->index();
        break;

    case '/notes/create':
        if (!isAuthenticated() || !in_array($_SESSION['role'], ['admin', 'escritor'])) {
            header('Location: /blog/');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $controller->create(); // Mostrar el formulario de crear post
        } else {
            $controller->save();  // Guardar el nuevo post
        }
        break;

    case '/notes/edit':
        if (!isAuthenticated() || !in_array($_SESSION['role'], ['admin', 'escritor'])) {
            header('Location: /blog/login');
            exit();
        }
        // Verificar si el parámetro `post_id` está presente en la URL
        if (isset($_GET['post_id'])) {
            $postId = $_GET['post_id']; // Obtener el ID del post desde el parámetro de consulta
        
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                // Mostrar el formulario de edición con el ID del post
                $controller->edit($postId);
            } else {
                // Si es POST, actualizar el post
                $controller->update($postId);
            }
        }
        break;

    case '/notes/delete':
        if (!isAuthenticated() || !hasRole('admin')) {
            header("Location: /blog/login");
            exit();
        }
        $controller->delete();
        break;

    case '/login':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Mostrar formulario de login
            require_once 'views/login.php';
        } else {
            // Procesar login
            $email = $_POST['email'];
            $password = $_POST['password'];
            if ($authController->login($email, $password)) {
                header('Location: /blog/');  // Redirigir a la página de dashboard
            } else {
                $error = 'Credenciales incorrectas';
                require_once 'views/login.php';  // Volver a mostrar formulario con mensaje de error
            }
        }
        break;

    case (preg_match('/^\/notes\/(\d+)$/', $request, $matches) ? true : false):
        $postId = $matches[1];  // Obtener el ID del post de la URL
        $controller->viewPost($postId);  // Llamar a un método para mostrar el post
        break;

    case '/comment/create':
        if (!isAuthenticated()) {
            header('Location: /blog/login'); // Redirigir si no está autenticado
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $commentText = $_POST['comment'];
            $postId = $_POST['post_id'];
            $authorId = $_SESSION['user_id'];

            // Llamar al método para crear el comentario
            if ($commentController->createComment($commentText, $authorId, $postId)) {
                $_SESSION['success_message'] = "Comentario publicado exitosamente.";
                header("Location: /blog/notes/{$postId}"); 
                exit();
            } else {
                $_SESSION['error_message'] = "Hubo un error al publicar el comentario.";
                header("Location: /blog/notes/{$postId}"); 
                exit();
            }
        }
        break;

    case '/register':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Mostrar formulario de registro
            require_once 'views/register.php';
        } else {
            // Procesar registro
            $email = $_POST['email'];
            $name = $_POST['name'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            $message = $authController->register($email, $name, $password, $role);
            echo $message;  // Mostrar mensaje de éxito o error
        }
        break;

    case '/logout':
        $authController->logout();  // Procesar logout
        break;

    default:
        echo 'Página no encontrada';
        break;
}
