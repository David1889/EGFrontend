<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/header-styles.css" rel="stylesheet"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <?php
    // Detectar qué página se está cargando
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

    // Verificar si existe un CSS específico para la página
    $cssFile = "css/$page.css";
    if (file_exists($cssFile)) {
        echo "<link href='$cssFile' rel='stylesheet'>";
    }
    ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="?page=home">
        <img src="./assets/img/logo.png" alt="Logo de San Antón">
    </a>    
    <div class="menu-container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <img src="./assets/img/menu-btn.png" alt="menú-hamburguesa" class="navbar-toggler-icon">
            </button>
            <div class="collapse navbar-collapse menu-wrap" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="?page=home">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="?page=services">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="?page=contact">Contactanos</a></li>
                    <li class="nav-item"><a class="nav-link" href="?page=products">Productos</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>