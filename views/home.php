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
                    <li><a href="/blog/" class="hover:text-purple-300 transition-colors">Inicio</a></li>
                    <li><a href="/blog/notes" class="hover:text-purple-300 transition-colors">Explorar</a></li>
                    <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'escritor')): ?>
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
            Bienvenidos a mi rincón de lo macabro, donde las sombras cobran vida y los susurros de lo desconocido nunca dejan de resonar. Aquí encontrarás relatos que te helarán la sangre y te harán mirar dos veces a tu alrededor. Adéntrate en este espacio si te atreves a descubrir lo que acecha en la oscuridad.
            </p>
            <a href="/blog/notes/create" class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition-all">
                Comienza ahora
            </a>
        </section>

        <!-- Chat Global -->
        <div class="chat-container">
    <?php require_once 'views/chat.php'; ?>
</div>

<section class="mt-16 grid grid-cols-1 md:grid-cols-2 gap-8">
    <article class="bg-gray-800 p-8 rounded-lg shadow-lg">
        <h3 class="text-2xl font-semibold text-purple-400 mb-4">Sumérgete en la oscuridad</h3>
        <p class="text-gray-300 leading-relaxed">
            Explora relatos que te helarán la sangre. Crea, edita y comparte tus historias de miedo en una plataforma simple y aterradora.
        </p>
    </article>
    <article class="bg-gray-800 p-8 rounded-lg shadow-lg">
        <h3 class="text-2xl font-semibold text-purple-400 mb-4">Conecta con otros espíritus</h3>
        <p class="text-gray-300 leading-relaxed">
            Comparte tus relatos, intercambia ideas con otros amantes del terror y crea una comunidad de mentes inquietas.
        </p>
    </article>
    <article class="bg-gray-800 p-8 rounded-lg shadow-lg">
        <h3 class="text-2xl font-semibold text-purple-400 mb-4">Personaliza tu horror</h3>
        <p class="text-gray-300 leading-relaxed">
            Dale tu toque único a cada historia y a tu perfil, creando una atmósfera aterradora que refleje tu estilo.
        </p>
    </article>
    <article class="bg-gray-800 p-8 rounded-lg shadow-lg">
        <h3 class="text-2xl font-semibold text-purple-400 mb-4">Haz que tus miedos lleguen lejos</h3>
        <p class="text-gray-300 leading-relaxed">
            Publica contenido que atrape a tus lectores y los haga mirar siempre por encima del hombro. El terror puede cruzar fronteras.
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