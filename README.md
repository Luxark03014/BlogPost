# Blog de Historias de Miedo

Este proyecto es un blog dedicado a los amantes de las historias de miedo. Permite a los usuarios leer, publicar y comentar historias, mientras interactúan en tiempo real a través de un chat.

## Características

- **CRUD de Posts**: Los usuarios pueden crear, leer, actualizar y eliminar historias de miedo.
- **CRUD de Comentarios**: Sistema de comentarios en las publicaciones para fomentar la discusión.
- **Chat en Tiempo Real**: Un espacio interactivo para que los usuarios hablen sobre sus experiencias y opiniones.
- **Seguridad y Rendimiento**: Utilizamos PHP con PDO para gestionar las conexiones a la base de datos de forma segura y eficiente.

---

## Tecnologías Utilizadas

- **Backend**: PHP 8.3+
- **Base de Datos**: MySQL
- **Frontend**: PHP, TailwindCSS
- **Gestor de Dependencias**: Composer

---

## Requisitos Previos

1. Tener instalado:
   - Servidor web Apache o Nginx.
   - PHP 8.3+ o superior.
   - MySQL.
   - Composer.
2. Conexión a internet para instalar dependencias.

---

## Instalación

### 1. Clonar el Repositorio

```bash
git clone https://github.com/lucasmaragu/BlogPostPDO.git
```

### 2. Configuración del Proyecto

#### Acceder al Directorio
```bash
cd BlogPostPDO
```

#### Instalar Dependencias
Ejecuta el siguiente comando para instalar las dependencias de PHP:
```bash
composer install
```

#### Configurar el Archivo `.env`
Renombra el archivo `.env.example` a `.env` y edítalo con los datos de tu base de datos:
```env
DB_HOST=localhost
DB_NAME=nombre_base_de_datos
DB_USER=tu_usuario
DB_PASS=tu_contraseña
```

### 3. Configuración de la Base de Datos

1. Crea una base de datos en MySQL.
2. Importa el archivo `database.sql` para generar las tablas necesarias:
```bash
mysql -u tu_usuario -p nombre_base_de_datos < database.sql
```

### 4. Configurar el Servidor Web
Asegúrate de que tu servidor web apunte al directorio `public/`.

---

## Uso

1. Accede al proyecto desde tu navegador a través de la URL configurada en tu servidor (e.g., `http://localhost/BlogPostPDO`).
2. Explora las historias, comenta y chatea con otros usuarios.

---

## Estructura del Proyecto

- `/blog` - Contiene la lógica principal de la aplicación.
- `/views` - Archivos de vistas para renderizar la interfaz.
- `/config` - Scripts relacionados con la configuración de la base de datos.

---

## Contribución

Si deseas colaborar con el proyecto:

1. Realiza un fork del repositorio.
2. Crea una nueva rama para tus cambios:
   ```bash
   git checkout -b feature/nueva-funcionalidad
   ```
3. Envía un Pull Request para revisión.

---

## Contacto

Si tienes dudas o sugerencias, no dudes en contactarme:

- **Autor**: Lucas Martínez Aguilera
- **Email**: [lucasmaragu@gmail.com](mailto:lucasmaragu@gmail.com)
- **Repositorio**: [GitHub](https://github.com/lucasmaragu/BlogPostPDO)

🌱 *¡Gracias por visitar este blog! Si te gustan las historias de miedo, éste es tu lugar.*

