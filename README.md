# Bienes Acapulco

Bienes Acapulco es una plataforma web desarrollada en PHP que permite publicar, visualizar y gestionar propiedades inmobiliarias. El proyecto está diseñado para agentes o empresas que desean mostrar y administrar inmuebles en línea, incluyendo imágenes, detalles y sistema de contacto.

Puedes visitar el sitio en el siguiente enlace: https://bienes-acapulco.com

## ✨ Características principales

* Visualización de publicaciones de inmuebles.
* Búsqueda avanzada con filtros (categoría, recámaras, baños, garage, etc.).
* Páginas individuales para cada inmueble con galería de imágenes.
* Formulario de contacto que envía mensajes al anunciante.
* Sistema de conteo de visitas por publicación.
* Panel de administración:

  * Listado de publicaciones existentes.
  * Creación y edición de inmuebles.
  * Gestión de cuenta de usuario.

## 📁 Estructura del proyecto

```
Inmuebles-web/
├── assets/               # Archivos estáticos (CSS, JS, imágenes)
├── config/               # Configuración base de datos y constantes
├── controllers/          # Lógica del lado del servidor
├── core/                 # Lógica base como conexión PDO
├── helpers/              # Funciones auxiliares
├── models/               # Acceso a la base de datos (inmuebles)
├── test/                 # Archivos de prueba
├── vendor/               # Dependencias de Composer (ignorada por Git)
├── views/                # Vistas HTML y PHP
├── .env                  # Variables de entorno (ignorado por Git)
├── index.php             # Entrada principal de la app
└── composer.json         # Dependencias PHP
```

## 🛠️ Tecnologías utilizadas

* **PHP** (vanilla)
* **Composer** para gestión de dependencias
* **PHPMailer** para el envío de correos
* **Dotenv** para manejo de variables de entorno
* **HTML5**, **CSS3** y **JavaScript**

## 🚀 Instalación local

1. Clona el repositorio:

   ```bash
   git clone https://github.com/ErickDeps/Inmuebles-web.git
   ```

2. Entra a la carpeta del proyecto:

   ```bash
   cd Inmuebles-web
   ```

3. Instala las dependencias:

   ```bash
   composer install
   ```

4. Crea un archivo `.env` con tu configuración SMTP:

   ```env
   MAIL_HOST=smtp.tu-servidor.com
   MAIL_PORT=587
   MAIL_USERNAME=usuario
   MAIL_PASSWORD=contraseña
   MAIL_FROM=remitente@tudominio.com
   MAIL_FROM_NAME=Nombre del remitente
   ```

5. Configura tu archivo `config.php` o usa `config.example` como base.

6. Ejecuta el proyecto en tu entorno local (ej. XAMPP o similar):

   ```
   http://localhost/Inmuebles-web/
   ```

## 🔐 Seguridad

* El archivo `.env` está en `.gitignore` para no ser rastreado por Git.
* También se ignora la carpeta `vendor/`, que puede regenerarse con Composer.

## 📌 Estado del proyecto

✅ En desarrollo activo. El sitio ya cuenta con funcionalidades completas para el usuario final y un **panel de administrador** para gestionar publicaciones.

## 📩 Contacto

¿Tienes dudas o sugerencias? Puedes escribirme a erickdepps@gmail.com

---

¡Gracias por visitar Inmuebles Web!
