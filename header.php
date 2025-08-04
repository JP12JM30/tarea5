<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Oswald:wght@200..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
    <body>
        <nav class="navbar bg-body-tertiary block-top ">
            <div class="container-fluid">
                <a class="navbar-brand h1" href="index.php">APIS'APP</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Apis Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body ">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link" href="acerca.php">Acerca de</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Menu
                                </a>
                                <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="genero.php">Predicción de género</a></li>
                                <li><a class="dropdown-item" href="edad.php">Predicción de edad</a></li>
                                <li><a class="dropdown-item" href="universidad.php">Universidades del Mundo</a></li>
                                <li><a class="dropdown-item" href="clima.php">Clima en República Dominicana</a></li>
                                <li><a class="dropdown-item" href="pokemon.php">Pokémon</a></li>
                                <li><a class="dropdown-item" href="noticias.php">Noticias WordPress</a></li>
                                <li><a class="dropdown-item" href="monedas.php">Conversión de Monedas</a></li>
                                <li><a class="dropdown-item" href="ia.php">Generador de imágenes con IA</a></li>
                                <li><a class="dropdown-item" href="pais.php">Datos de un país</a></li>
                                <li><a class="dropdown-item" href="chistes.php">Generador de chistes</a></li>

                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        
        
    
