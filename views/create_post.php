<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Post</title>
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

    <main class="flex-grow container mx-auto px-6 py-12">
        <div class="max-w-2xl mx-auto bg-gray-800 p-8 rounded-lg shadow-lg">
            <h2 class="text-3xl font-extrabold mb-6 text-purple-400">Crear un Nuevo Post</h2>

            <!-- Mensaje de error si no se completan todos los campos -->
            <?php if (isset($error)): ?>
                <p class="text-red-500 mb-4"><?php echo $error; ?></p>
            <?php endif; ?>

            <form action="/blog/notes/create" method="POST" class="space-y-6">
                <div class="space-y-2">
                    <label for="title" class="block text-sm font-medium text-gray-300">Título</label>
                    <input type="text" id="title" name="title" required
                           class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>

                <div class="space-y-2">
                    <label for="content" class="block text-sm font-medium text-gray-300">Contenido</label>
                    <textarea id="content" name="content" required rows="6"
                              class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-purple-500"></textarea>
                </div>

                

                <div class="flex items-center justify-between pt-4">
                    <button type="submit" class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                        Crear Post
                    </button>
                </div>
            </form>
        </div>
    </main>

    <footer class="bg-gray-800 py-6">
        <div class="container mx-auto text-center text-gray-400">
            <p>&copy; 2024 NocheEscrita. Donde tus palabras brillan en la oscuridad.</p>
        </div>
    </footer>
</body>
</html>
