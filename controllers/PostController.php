<?php

namespace controllers;

use config\Database;
use models\Post;
use PDO;



class PostController
{
    private $model;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();

        $this->model = new Post($db);
    }
    // Métodos para manejar acciones de publicaciones


    public function index()
    {
        $result = $this->model->read();
        if ($result->rowCount() > 0) {
            $postArr = [];
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $postItem = [
                    'id' => $id,
                    'title' => $title,
                    'content' => $content,
                    'publish_date' => $publish_date,
                    'author_name' => $author_name,  // Aquí estamos pasando el nombre del autor
                ];
                $postArr[] = $postItem;
            }
    
            // Pasar $postArr a la vista para mostrar los posts
            require_once __DIR__ . '/../views/post.php';
        } else {
            echo "No hay posts disponibles.";
        }
    }
    



    public function create()
{
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        // Obtener todos los usuarios para el select
        $query = "SELECT id, name FROM users";
        $stmt = $this->model->getDb()->query($query);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once __DIR__ . '/../views/create_post.php';
    } 
    // Si la solicitud es POST, procesamos los datos
    elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recoger los datos del formulario
        $title = $_POST['title'];
        $content = $_POST['content'];
        $author_id = $_POST['author_id'];

        // Validar los datos (opcional)
        if (empty($title) || empty($content) || empty($author_id)) {
            echo "Todos los campos son obligatorios.";
            return;
        }

        // Llamar al método create del modelo para guardar el nuevo post
        $this->model->create($title, $content, $author_id);

        // Redirigir a la página principal de los posts
        require_once __DIR__ . '/../views/post.php';
        exit();
    }
}

public function edit($id)
{
    // Obtener el post del modelo
    $post = $this->model->readOne($id);

    // Verificar si el post fue encontrado
    if ($post) {
        // Si la solicitud es POST, actualizamos el post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recoger los datos del formulario
            $title = $_POST['title'];
            $content = $_POST['content'];
            $author_id = $_POST['author_id'];

            // Validar los datos
            if (empty($title) || empty($content) || empty($author_id)) {
                echo "Todos los campos son obligatorios.";
                return;
            }

            // Llamar al método update del modelo para actualizar el post
            $this->model->update($id, $title, $content, $author_id);

            // Redirigir después de la actualización
            header('Location: /blog/notes'); // O la ruta de tu elección
            exit();
        }

        // Obtener los usuarios si es admin
        $users = [];
        if ($_SESSION['role'] === 'admin') {
            $query = "SELECT id, name FROM users";
            $stmt = $this->model->getDb()->prepare($query);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Mostrar el formulario de edición con el post y los usuarios
        require_once __DIR__ . '/../views/edit_post.php';
    } else {
        // Si no se encuentra el post, mostrar un mensaje de error
        echo "Post no encontrado";
    }
}


public function delete()
    {
        if (isset($_POST['post_id'])) {
            $postId = $_POST['post_id'];

          
            $this->model->delete($postId);

           
            header('Location: /blog/notes');
            exit();
        } else {
            echo "No se ha proporcionado un ID de post válido.";
        }
    }

    public function update($id)
{
 
    if (isset($_POST['title'], $_POST['content'], $_POST['author_id'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $author_id = $_POST['author_id'];

        // Validación
        if (empty($title) || empty($content) || empty($author_id)) {
            echo "Todos los campos son obligatorios.";
            return;
        }

        // Llamada al método de actualización del modelo
        $this->model->update($id, $title, $content, $author_id);

        // Redirigir a la página de posts después de la actualización
        header('Location: /blog/notes');
        exit();
    } else {
        echo "Datos del formulario inválidos.";
    }
}

public function viewPost($postId) {
    // Obtener el post desde el model
    $post = $this->model->readOne($postId);

    if ($post) {
      
        $commentController = new CommentController($this->model->getDb());
        $comments = $commentController->showComments($postId);
        // Si el post existe, cargar la vista y pasar los datos del post
        require_once __DIR__ . '/../views/post_view.php';
    } else {
        // Si no se encuentra el post, mostrar un mensaje de error
        echo "Post no encontrado";
    }
}




public function save()
{
    if (isset($_POST['title'], $_POST['content'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];

        // Asegurarse de que el usuario esté logueado y obtener su ID de la sesión
        if (isset($_SESSION['user_id'])) {
            $author_id = $_SESSION['user_id']; // El author_id será igual al user_id del usuario logueado

            // Llamar al método 'create' del modelo para guardar el post
            $this->model->create($title, $content, $author_id);

            // Redirigir después de guardar el post
            header('Location: /blog/notes');
            exit();
        } else {
            echo "No estás logueado. Necesitas iniciar sesión para crear un post.";
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
}
}
