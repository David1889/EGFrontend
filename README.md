# Veterinaria San Antón - Frontend

Sistema de gestión para clínica veterinaria desarrollado en **Laravel (Blade + Bootstrap 5)**. Este proyecto actúa como interfaz de usuario (Frontend) y consume datos de una API REST externa.

## 🚀 Requisitos Previos

* PHP 8.1 o superior
* Composer
* Acceso al Backend (API) corriendo en local o remoto.

## 🛠️ Instalación y Configuración

1.  **Clonar el repositorio:**
    ```bash
    git clone <url-del-repo>
    cd veterinaria-frontend
    ```

2.  **Instalar dependencias:**
    ```bash
    composer install
    ```

3.  **Configurar entorno:**
    Duplicar el archivo de ejemplo y generar la llave de aplicación.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Conexión con el Backend:**
    Editar el archivo `.env` para configurar la URL de la API y la Key de seguridad.
    
    ```env
    # Configuración de Sesiones (Sin Base de Datos local)
    SESSION_DRIVER=file
    
    # API Backend
    BACKEND_URL=[http://127.0.0.1:8000/api](http://127.0.0.1:8000/api)
    BACKEND_API_KEY=En el informe de postman
    ```

## ▶️ Ejecución

Para evitar conflictos de puertos con el backend (8000), levantar este proyecto en el puerto **8001**:

```bash
php artisan serve --port=8001