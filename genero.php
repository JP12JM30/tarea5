<?php 
    include "header.php";
    
    $gender = '';
    $probabilidad = '';
    $colorClase = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['nombre'])) {
        $nombre = urlencode(trim($_POST['nombre']));
        $api_url = "https://api.genderize.io/?name=$nombre";

        $genero = file_get_contents($api_url);
        if ($genero !== false) {
            $dato = json_decode($genero, true);
            $gender = $dato['gender'] ?? 'Desconocido';
            $probabilidad = isset($dato['probability']) ? ($dato['probability'] * 100) . '%' : 'N/A';

            
            if ($gender === 'male') {
                $colorClase = 'text-primary bg-primary-subtle border border-primary';
            } elseif ($gender === 'female') {
                $colorClase = 'text-danger bg-danger-subtle border border-danger';
            } else {
                $colorClase = 'text-secondary bg-secondary-subtle border border-secondary';
            }
        }
    }
?>
<link rel="stylesheet" href="style.css">

<div class="container">
    <h2>Predicción de género</h2>
    <form class="form " action="" method="post">
        <div class="mb-3">
            <strong><label for="nombre" class="form-label ms-2 h4">Nombre</label></strong> 
            <input type="text" class="form-control w-50" id="nombre" name="nombre" required
                value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>">
            <button class="btn mt-2" type="submit">Adivinar</button>
        </div>

        <?php if (!empty($gender)) : ?>
            <div class="mb-3 p-3 rounded <?php echo $colorClase; ?>">
                <strong><label class="form-label h5">Resultado:</label></strong> 
                <p class="mb-0"><strong>Género:</strong> <?php echo ucfirst($gender); ?></p>
                <p><strong>Probabilidad:</strong> <?php echo htmlspecialchars($probabilidad); ?></p>
            </div>
        <?php endif; ?>
    </form>
</div>
<?php include "footer.php"; ?>



