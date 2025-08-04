<?php 
    include "header.php";
    date_default_timezone_set('America/Santo_Domingo');

    $apiKey = '0b03b9beefb12bfb4a68b717242f8e63'; 
    $ciudad = 'Santo Domingo'; 
    $datosClima = [];
    $datosPronostico = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['Ciudad'])) {
        $ciudad = trim($_POST['Ciudad']); 
    }

    $ciudadUrl = urlencode($ciudad);

    $apiActual = "https://api.openweathermap.org/data/2.5/weather?q={$ciudadUrl},DO&appid={$apiKey}&units=metric&lang=es";
    $apiForecast = "https://api.openweathermap.org/data/2.5/forecast?q={$ciudadUrl},DO&appid={$apiKey}&units=metric&lang=es";

    
    $respuesta = file_get_contents($apiActual);
    if ($respuesta) {
        $datosClima = json_decode($respuesta, true);
    }

    
    $respuesta2 = file_get_contents($apiForecast);
    if ($respuesta2) {
        $datosPronostico = json_decode($respuesta2, true);
    }

    $icono = $datosClima['weather'][0]['icon'] ?? '01d';
    $temp = round($datosClima['main']['temp'] ?? 0);
    $ubicacion = $datosClima['name'] ?? 'Desconocido';
    $fecha = date("d/m/Y H:i");
    $humedad = $datosClima['main']['humidity'] ?? 0;
    $sensacion = round($datosClima['main']['feels_like'] ?? 0);
    $presion = $datosClima['main']['pressure'] ?? 0;
    $viento = round($datosClima['wind']['speed'] ?? 0);

    if (!empty($datosClima['sys']) && isset($datosClima['timezone'])) {
        $amanecer = date("g:i A", $datosClima['sys']['sunrise'] + $datosClima['timezone']);
        $atardecer = date("g:i A", $datosClima['sys']['sunset'] + $datosClima['timezone']);
    } else {
        $amanecer = 'N/D';
        $atardecer = 'N/D';
    }

    $pronosticos = [];
    if (isset($datosPronostico['list'], $datosPronostico['city']['timezone'])) {
        foreach ($datosPronostico['list'] as $item) {
            $hora = date("g A", strtotime($item['dt_txt']) + $datosPronostico['city']['timezone']);
            $icon = $item['weather'][0]['icon'];
            $tempHora = round($item['main']['temp']);
            $pronosticos[] = [
                'hora' => $hora,
                'icono' => $icon,
                'temp' => $tempHora
            ];
            if (count($pronosticos) >= 8) break;
        }
    }
?>
<div class="barra">
    <nav class="navbar">
        <div class="container-fluid">
            <strong><a class="navbar-brand">Clima de República Dominicana ☀️</a></strong>
            <form class="d-flex" role="search" method="post">
                <input class="form-control me-2" id="buscador" type="text" placeholder="Entra tu ciudad" name="Ciudad"/>
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
        </div>
    </nav>
</div>

<div class="weather-data mt-4 ms-5">
    <div class="weather-left">
        <div class="card-weather">
            <strong><p>Ahora</p></strong>
            <div class="current-weather"> 
                <div class="details">
                    <h2><?= $temp ?>&deg;C</h2>
                    <hr>
                    <img src="https://openweathermap.org/img/wn/<?= $icono ?>.png" alt="icono">
                </div>
            </div>
            <hr>
            <div class="card-footer">
                <p><img src="img/calendario.png" alt=""><?= $fecha ?></p>
                <p><img src="img/ubicaciones.png" alt=""><?= $ubicacion ?></p>
            </div>
        </div>
    </div>

    <div class="weather-right">
        <strong><h2>Destacados</h2></strong>
        <div class="card-highlights">
            <div class="card-head">
                <strong><p>Amanecer</p></strong>
                <p><?= $amanecer ?> <img src="img/amanecer.png" alt=""></p>
                <strong><p>Atardecer</p></strong>
                <p><?= $atardecer ?> <img src="img/atardecer.png" alt=""></p>
                <strong><p>Viento</p></strong>
                <p><?= $viento ?> m/s <img src="img/brujula.png" alt=""></p>
            </div>
        </div>       
    </div>

    <div class="weather-end">
        <div class="card-highlights-end">
            <div class="highlights-end-items">
                <strong><p>Humedad</p></strong>
                <strong><p><?= $humedad ?>%</p></strong>
            </div>
            <hr>
            <div class="highlights-end-items">
                <strong><p>Sensación real</p></strong>
                <span><?= $sensacion ?>&deg;C</span>
            </div>
            <hr>
            <div class="highlights-end-items">
                <strong><p>Presión</p></strong>
                <p><?= $presion ?> hPa</p>
            </div>   
        </div>
    </div>
</div>

<h2 class="title">Hoy</h2>
<div class="wather-bottom d-flex">
    <?php foreach ($pronosticos as $item): ?>
       <div class="today-forcase">
            <div class="hourly-forcase">
                <div class="card-today">
                    <p><?= $item['hora'] ?></p>
                    <p class="img"><img src="https://openweathermap.org/img/wn/<?= $item['icono'] ?>.png" alt=""></p>
                    <p><?= $item['temp'] ?>&deg;C</p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include "footer.php"; ?>
