<?php
session_start();
require_once '../core/Router.php';

// Definir las rutas disponibles
$router = new Router();
$router->addRoute('home', 'views/home.php');
$router->addRoute('login', 'views/login.php');
$router->addRoute('dashboard', 'views/dashboard.php');

// Si hay un parámetro en la URL, lo usamos; si no, mostramos home por defecto
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$router->route($page);
?>
