<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NocheEscrita - Explora los Pensamientos Nocturnos</title>
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
        <h2 class="text-4xl font-extrabold mb-8 text-purple-400 text-center">Explorando los Susurros de la Noche</h2>

        <?php if (!empty($postArr)): ?>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($postArr as $post): ?>
                    <article class="bg-gray-800 rounded-lg shadow-lg overflow-hidden transition-transform hover:scale-105">


                        <div class="p-4">
                            <div class="flex justify-between w-full">
                                <h3 class="text-2xl font-semibold text-purple-400 mb-3"><?php echo htmlspecialchars($post['title']); ?></h3>
                                <div class="flex flex-row gap-x-4">
                                    <form action="/blog/notes/edit" method="GET" class="inline">
                                        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                        <button type="submit" class="bg-transparent border-none p-0">
                                            <svg class="w-6" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0,0,256,256">
                                                <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                                    <g transform="scale(5.12,5.12)">
                                                        <path d="M46.57422,3.42578c-0.94922,-0.94922 -2.19531,-1.42578 -3.44141,-1.42578c-1.24609,0 -2.49219,0.47656 -3.44141,1.42578c0,0 -0.07031,0.06641 -0.16016,0.16016c-0.00781,0.00781 -0.01953,0.01172 -0.02734,0.01953l-35.20312,35.19922c-0.12109,0.125 -0.21094,0.27734 -0.25781,0.44922l-2.00781,7.48828c-0.09375,0.34375 0.00391,0.71094 0.25781,0.96484c0.19141,0.19141 0.44531,0.29297 0.70703,0.29297c0.08594,0 0.17188,-0.01172 0.25781,-0.03516l7.48828,-2.00781c0.17188,-0.04687 0.32422,-0.13672 0.44922,-0.26172l35.19922,-35.19531c0.01172,-0.01172 0.01563,-0.02734 0.02344,-0.03906c0.08984,-0.08984 0.15234,-0.15234 0.15234,-0.15234c1.90625,-1.90234 1.90625,-4.98437 0.00391,-6.88281zM45.16016,4.83984c1.11719,1.11719 1.11719,2.9375 0,4.05469c-0.33203,0.32813 -0.61328,0.61328 -0.85547,0.85547l-4.05469,-4.05469c0.46094,-0.46094 0.85547,-0.85547 0.85547,-0.85547c0.53906,-0.54297 1.26172,-0.83984 2.02734,-0.83984c0.76563,0 1.48438,0.30078 2.02734,0.83984zM5.60547,41.15234l3.24219,3.24219l-4.43359,1.19141z"></path>
                                                    </g>
                                                </g>
                                            </svg>
                                        </button>
                                    </form>
                                    <form action="/blog/notes/delete" method="POST" class="inline">
                                        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                        <button type="submit" class="bg-transparent border-none p-0">

                                            <svg class="w-6" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0,0,256,256">
                                                <g fill="#fe0000" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                                    <g transform="scale(10.66667,10.66667)">
                                                        <path d="M10.80664,2c-0.517,0 -1.01095,0.20431 -1.37695,0.57031l-0.42969,0.42969h-5c-0.36064,-0.0051 -0.69608,0.18438 -0.87789,0.49587c-0.18181,0.3115 -0.18181,0.69676 0,1.00825c0.18181,0.3115 0.51725,0.50097 0.87789,0.49587h16c0.36064,0.0051 0.69608,-0.18438 0.87789,-0.49587c0.18181,-0.3115 0.18181,-0.69676 0,-1.00825c-0.18181,-0.3115 -0.51725,-0.50097 -0.87789,-0.49587h-5l-0.42969,-0.42969c-0.365,-0.366 -0.85995,-0.57031 -1.37695,-0.57031zM4.36523,7l1.52734,13.26367c0.132,0.99 0.98442,1.73633 1.98242,1.73633h8.24805c0.998,0 1.85138,-0.74514 1.98438,-1.74414l1.52734,-13.25586z"></path>
                                                    </g>
                                                </g>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <p class="text-gray-300 mb-4 line-clamp-3"><?php echo htmlspecialchars(substr($post['content'], 0, 150)) . '...'; ?></p>
                            <div class="flex justify-between items-center text-sm text-gray-400">
                                <span>Publicado: <?php echo date('d M Y', strtotime($post['publish_date'])); ?></span>
                                <span>Por: <?php echo $post['author_name']; ?></span>
                            </div>
                        </div>
                        <a href="/blog/notes/<?php echo $post['id']; ?>" class="block bg-purple-600 text-white text-center py-3 hover:bg-purple-700 transition-colors">
                            Leer más
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            
            <div class="text-center py-12">
                <p class="text-xl text-gray-400">Aún no hay publicaciones disponibles.</p>
                <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'escritor')): ?>
                <a href="/blog/notes/create" class="inline-block mt-4 bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                    Sé el primero en escribir
                </a>
                <?php endif; ?>
            </div>
            
        <?php endif; ?>
    </main>

    <footer class="bg-gray-800 py-6">
        <div class="container mx-auto text-center text-gray-400">
            <p>&copy; 2024 NocheEscrita. Donde tus palabras brillan en la oscuridad.</p>
        </div>
    </footer>
</body>
<script>

</script>

</html>