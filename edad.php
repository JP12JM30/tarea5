<?php 
    include "header.php";

    $age = '';
    $colorClase = '';
    $img = '';
    $text = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['nombre'])) {
        $nombre = urlencode(trim($_POST['nombre']));
        $api_url = "https://api.agify.io/?name=$nombre";

        $edad = file_get_contents($api_url);
        if ($edad !== false) {
            $dato = json_decode($edad, true);
            $age = $dato['age'] ?? 'Desconocido';

            if ($age <= '18') {
                $colorClase = 'bg-warning-subtle border border-warning';
                $img = "img/bebe.png";
                $text = "Eres joven aun, pero no por mucho tiempo 🤣";
            }elseif($age >='40'){
                $colorClase = 'bg-danger border border-danger';
                $img = "img/señor.png";
                $text = "Eres un anciato cool 😎";
               
            }else{
                $colorClase = 'bg-info-subtle border border-info';
                $img = "img/jovenf.png";
                $text = "Eres un adulto, pero la edad te esta respirando en la nuca 🤣 ";
            }

            
        }
    }
?>

<div class="container">
    <h2>Puedo advinar tu edad</h2>
    <form class="form w-50" action="" method="post">
        <div class="mb-3">
            <strong><label for="nombre" class="form-label ms-2 h4">Nombre</label></strong> 
            <input type="text" class="form-control w-50" id="nombre" name="nombre" required
                value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>">
            <button class="btn mt-2" type="submit">Adivinar</button>
        </div>

        <?php if (!empty($age)) : ?>
            <div class="mb-3 p-3 rounded <?php echo $colorClase; ?>">
                <strong><label class="form-label h5">Resultado:</label></strong> 
                <strong><p class="mb-0"> <?php echo ucfirst($text); ?></p></strong>
                <p class="mb-0"><strong>Edad:</strong> <?php echo ucfirst($age); ?></p>
                <?php echo '<img src="' . $img . '" alt="Imagen de edad" class="img-fluid mb-3 w-25">';?>

            </div>
        <?php endif; ?>
    </form>
</div>











<?php include "footer.php"?>