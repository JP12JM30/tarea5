<?php 
    include "header.php";
    $api_url="https://pokeapi.co/api/v2/pokemon/";

    $datosPokemon = null;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["pokemon"])) {
        $nombrePokemon = strtolower(trim($_POST["pokemon"]));
        $url = $api_url . $nombrePokemon;

        $respuesta = file_get_contents($url);
        if ($respuesta !== false) {
            $datosPokemon = json_decode($respuesta, true);
        } else {
            echo "<p style='color:red;text-align:center;'>Pokémon no encontrado 😢</p>";
        }
    }
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cherry+Bomb+One&family=DM+Serif+Text:ital@0;1&display=swap" rel="stylesheet">
<div class="nav">
    <p><img class="pokemon-logo" src="img/Pokemon-logo.png" alt=""></p>
</div>
<div class="contenedor">
    
    <form class="pokeForm shadow-lg" action="" method="post">
        <h2 class="texto-fondo">Busca tus Pokemón favoritos<img src='img/pikachu.png' alt=""></h2> <br>
        <div class="mb-3">
            <strong><label for="nombre" class="form-label">Nombre</label></strong>
            <input type="text" name="pokemon" class="form-input" required>
            <button type="submit" class="boton"> Buscar</button>
        </div>
        <?php if ($datosPokemon): ?>
            <div class="pokemon-card">
                <h2 class="texto-fondo"><?= ucfirst($datosPokemon["name"]) ?></h2>
                <img class="pokefoto" src="<?= $datosPokemon["sprites"]["front_default"] ?>" alt="<?= $datosPokemon["name"] ?>">
                <p class="texto-fondo"><strong>Experiencia Base:</strong> <?= $datosPokemon["base_experience"] ?></p>
                <p class="texto-fondo"><strong>Habilidades:</strong>
                    <?php
                        $habilidades = array_map(fn($hab) => $hab["ability"]["name"], $datosPokemon["abilities"]);
                        echo implode(", ", $habilidades);
                    ?>
                </p>

                <!-- Sonido (opcional, basado en fan-made) -->
                <?php
                    // Algunos sonidos están en repositorios externos (la API oficial no ofrece audios directamente)
                    $nombre = strtolower($datosPokemon["name"]);
                    $audio_url = "https://play.pokemonshowdown.com/audio/cries/$nombre.ogg";
                ?>
                <audio controls>
                    <source src="<?= $audio_url ?>" type="audio/ogg">
                    Tu navegador no soporta audio.
                </audio>
            </div>
        <?php endif; ?>
    </form>
</div>


<?php include "footer.php";