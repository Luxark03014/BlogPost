<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?> - NocheEscrita</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 font-sans text-gray-100 min-h-screen flex flex-col">
    <header class="bg-gradient-to-r from-purple-600 to-purple-800 py-6 shadow-md">
        <div class="container mx-auto flex justify-between items-center px-6">
            <h1 class="text-3xl font-extrabold text-white">NocheEscrita</h1>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="/blog/" class="hover:text-purple-300 transition-colors">Inicio</a></li>
                    <li><a href="/blog/notes" class="hover:text-purple-300 transition-colors">Explorar</a></li>
                    <li><a href="/blog/notes/create" class="hover:text-purple-300 transition-colors">Crear</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="flex-grow w-[60%] container mx-auto px-6 py-12">
        <article class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <h2 class="text-4xl font-extrabold text-purple-400 mb-4"><?php echo htmlspecialchars($post['title']); ?></h2>
                <p class="text-gray-300 mb-6 break-words whitespace-pre-wrap "><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                <div class="flex justify-between items-center text-sm text-gray-400">
                    <span>Publicado: <?php echo date('d M Y', strtotime($post['publish_date'])); ?></span>
                    <span>Por: Autor #<?php echo $post['author_id']; ?></span>
                </div>
            </div>
        </article>


        <section class="mt-12 bg-gray-800 rounded-lg shadow-lg p-6">
            <h3 class="text-3xl font-extrabold text-purple-400 mb-4">Comentarios</h3>

            <?php
            $comments = $commentController->showComments($postId);

            if (!empty($comments)) {
                foreach ($comments as $comment) {
                    echo '<div class="mb-6">';
                    echo '    <div class="flex items-center mb-2">';
                    echo '        <span class="font-bold text-gray-300">' . htmlspecialchars($comment['author_name']) . '</span>';
                    echo '        <span class="text-sm text-gray-400 ml-4">' . htmlspecialchars($comment['publish_date']) . '</span>';
                    echo '    </div>';
                    echo '    <p class="text-gray-300">' . htmlspecialchars($comment['text']) . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p class="text-gray-400">No hay comentarios aún. ¡Sé el primero en comentar!</p>';
            }
            ?>

            <div class="mt-8">
                <h4 class="text-xl font-bold text-gray-300 mb-4">Deja tu comentario</h4>
                <form  method="POST" action="/blog/comment/create" class="bg-gray-700 p-4 rounded-lg shadow-lg">
                    <textarea name="comment" class="w-full p-3 bg-gray-800 text-gray-300 rounded-lg mb-4" placeholder="Escribe tu comentario..." rows="4" required></textarea>
                    <input type="hidden" name="post_id" value="<?= $post['id']; ?>" />
                    <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition-colors">Publicar Comentario</button>
                </form>
            </div>

        </section>

    </main>

    <footer class="bg-gray-800 py-6">
        <div class="container mx-auto text-center text-gray-400">
            <p>&copy; 2024 NocheEscrita. Donde tus palabras brillan en la oscuridad.</p>
        </div>
    </footer>
</body>

</html>