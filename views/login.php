<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - NocheEscrita</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 font-sans text-gray-100 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-gradient-to-r from-purple-600 to-purple-800 py-6 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
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

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-6 py-12">
        <section class="max-w-lg mx-auto bg-gray-800 p-8 rounded-lg shadow-lg">
            <h2 class="text-3xl font-extrabold mb-6 text-purple-400 text-center">Iniciar sesión</h2>

            <form action="/blog/login" method="POST" class="space-y-6">
                <!-- Input for Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-300">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email" required class="w-full px-4 py-2 mt-2 rounded-lg bg-gray-700 text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>

                <!-- Input for Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-300">Contraseña</label>
                    <input type="password" name="password" id="password" placeholder="Contraseña" required class="w-full px-4 py-2 mt-2 rounded-lg bg-gray-700 text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>
                <div>
                    <a href="/blog/register" class="text-purple-400 hover:underline">¿No tienes una cuenta? Regístrate aquí</a>
                </div>
                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 bg-purple-500 hover:bg-purple-600 text-white font-bold rounded-lg shadow-lg transition-all">
                    Iniciar sesión
                </button>
            </form>

            <?php if (isset($error)) { echo "<p class='mt-4 text-center text-red-500'>$error</p>"; } ?>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 py-6">
        <div class="container mx-auto text-center text-gray-400">
            <p>&copy; 2024 NocheEscrita. Donde tus palabras brillan en la oscuridad.</p>
        </div>
    </footer>

</body>
</html>
