<?php
class Router {
    private $routes = [];

    public function addRoute($name, $file) {
        $this->routes[$name] = $file;
    }

    public function route($page) {
        // Verificar si el archivo solicitado es un archivo estático
        $requestUri = $_SERVER['REQUEST_URI'];
        $file = __DIR__ . '/../public' . $requestUri;
        if (file_exists($file) && is_file($file)) {
            return false; // Permitir que el servidor maneje la solicitud
        }

        if (array_key_exists($page, $this->routes)) {
            include '../views/header.php';
            include '../' . $this->routes[$page];
            include '../views/footer.php';
        } else {
            echo "<h1>404 - Página no encontrada</h1>";
        }
    }
}
?>