<?php

namespace controllers;

use models\Comment;
use PDO;


class CommentController
{
    private $db;
    private $comment;

    public function __construct($db)
    {

        $this->db = $db;

        $this->comment = new Comment($this->db);
    }


    public function showComments($postId)
    {
        $stmt = $this->comment->readByPost($postId);

        $comments = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $comments[] = $row;
        }

        return $comments;
    }


    public function createComment($commentText, $authorId, $postId)
    {
      
        $stmt = $this->db->prepare("INSERT INTO comments (text, author_id, post_id) VALUES (?, ?, ?)");
        $stmt->bindValue(1, $commentText, PDO::PARAM_STR);  // Para el texto del comentario
        $stmt->bindValue(2, $authorId, PDO::PARAM_INT);     // Para el ID del autor
        $stmt->bindValue(3, $postId, PDO::PARAM_INT);       // Para el ID del post


        return $stmt->execute(); 
    }
   
    public function showComment($id)
    {
        $this->comment->readOne($id);
        return $this->comment;
    }

    // Eliminar un comentario
    public function deleteComment($id)
    {
        $this->comment->id = $id;
        if ($this->comment->delete()) {
            return true;
        }
        return false;
    }

    // Editar un comentario
    public function editComment($id, $newText)
    {
        $this->comment->id = $id;
        $this->comment->text = $newText;

        if ($this->comment->update()) {
            return true;
        }
        return false;
    }
    // Método para crear un comentario desde un formulario
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtener los datos del formulario
            $commentText = $_POST['comment']; // El texto del comentario
            $postId = $_POST['post_id']; // El ID del post al que pertenece el comentario
            $authorId = $_SESSION['user_id']; // El ID del usuario (asumido que el usuario está logueado)

            // Validar los datos
            if (empty($commentText) || empty($postId)) {
                // Enviar un mensaje de error si falta alguno de los campos
                $_SESSION['error_message'] = "El comentario y el ID del post son obligatorios.";
                header("Location: /blog/notes/{$postId}");
                exit();
            }

            // Intentar crear el comentario
            if ($this->createComment($commentText, $authorId, $postId)) {
                // Redirigir al post donde se mostró el comentario
                $_SESSION['success_message'] = "Comentario publicado exitosamente.";
                header("Location: /blog/notes/{$postId}");
                exit();
            } else {
                // Si algo salió mal, mostrar un mensaje de error
                $_SESSION['error_message'] = "Hubo un error al publicar el comentario.";
                header("Location: /blog/notes/{$postId}");
                exit();
            }
        }
    }
}
