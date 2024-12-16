<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NocheEscrita - Tu refugio nocturno de expresión</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 font-sans text-gray-100 min-h-screen flex flex-col">
    <header class="bg-gradient-to-r from-purple-600 to-purple-800 py-6 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-extrabold text-white">NocheEscrita</h1>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="/" class="hover:text-purple-300 transition-colors">Inicio</a></li>
                    <li><a href="/blog/notes" class="hover:text-purple-300 transition-colors">Explorar</a></li>
                    <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'escritor')): ?>
        <!-- Si el usuario es administrador o escritor, mostrar el enlace "Crear" -->
        <li><a href="/blog/notes/create" class="hover:text-purple-300 transition-colors">Crear</a></li>
    <?php endif; ?>
                    <?php if (isset($_SESSION['user_id'])): ?>
                       
                        <li><a href="/blog/logout" class="hover:text-purple-300 transition-colors">Cerrar sesión</a></li>
                    <?php else: ?>
                      
                        <li><a href="/blog/login" class="hover:text-purple-300 transition-colors">Iniciar sesión</a></li>
                    <?php endif; ?>

                </ul>
            </nav>
        </div>
    </header>

    <main class="flex-grow container mx-auto px-6 py-12">
        <section class="text-center">
            <h2 class="text-5xl font-extrabold mb-6 text-purple-400">Da vida a tus pensamientos nocturnos</h2>
            <p class="text-xl leading-relaxed mb-8 text-gray-300">
                Bienvenido a NocheEscrita, tu plataforma para crear y compartir ideas, historias y emociones con una comunidad única. Aquí, tus palabras encuentran un lugar donde brillar.
            </p>
            <a href="/blog/notes/create" class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition-all">
                Comienza ahora
            </a>
        </section>

        <section class="mt-16 grid grid-cols-1 md:grid-cols-2 gap-8">
            <article class="bg-gray-800 p-8 rounded-lg shadow-lg">
                <h3 class="text-2xl font-semibold text-purple-400 mb-4">Fácil de usar</h3>
                <p class="text-gray-300 leading-relaxed">
                    Diseñada para simplificar tu experiencia. Crea, edita y publica tus posts en minutos con una interfaz intuitiva y elegante.
                </p>
            </article>
            <article class="bg-gray-800 p-8 rounded-lg shadow-lg">
                <h3 class="text-2xl font-semibold text-purple-400 mb-4">Conexiones significativas</h3>
                <p class="text-gray-300 leading-relaxed">
                    Conoce a otros creadores, intercambia ideas y construye una red basada en tus pasiones e intereses.
                </p>
            </article>
            <article class="bg-gray-800 p-8 rounded-lg shadow-lg">
                <h3 class="text-2xl font-semibold text-purple-400 mb-4">Totalmente personalizable</h3>
                <p class="text-gray-300 leading-relaxed">
                    Personaliza tus publicaciones y tu perfil para reflejar tu estilo único. Deja que tu personalidad brille.
                </p>
            </article>
            <article class="bg-gray-800 p-8 rounded-lg shadow-lg">
                <h3 class="text-2xl font-semibold text-purple-400 mb-4">Crece con tu audiencia</h3>
                <p class="text-gray-300 leading-relaxed">
                    Publica contenido que inspire y conecta con lectores de todo el mundo. Tus palabras pueden llegar lejos.
                </p>
            </article>
        </section>
    </main>

    <footer class="bg-gray-800 py-6">
        <div class="container mx-auto text-center text-gray-400">
            <p>&copy; 2024 NocheEscrita. Donde tus palabras brillan en la oscuridad.</p>
        </div>
    </footer>
</body>

</html>