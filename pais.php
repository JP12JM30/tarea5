<?php
    include "header.php";
    $paises = [];

    if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['pais'])) {
        $pais = urlencode(trim($_POST['pais']));
        $api_url = "https://restcountries.com/v3.1/name/$pais";

        $archivo = file_get_contents($api_url);
        if ($archivo !== false) {
            $datos = json_decode($archivo, true);
            $paises = $datos;
        }
    }
?>
<h2 class="titulo">¡Ingresa un país y conoce cosas nuevas!</h2>
<div class="container4">
    <div class="form-pais">
        <form action="" method="post">
            <div class="mb-3">
               <strong><label for="pais" class="form-label1 row">País</label></strong> 
                <input type="text" name="pais" class="form-control" required>
                <button class="btn mt-2" type="submit">Buscar</button>
            </div>

            <?php if (!empty($paises)) : ?>
                <div class="mb-3 p-3 rounded">
                    <strong><label class="form-label h5">Resultados:</label></strong>
                    <?php foreach ($paises as $p) : ?>
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>País</th>
                                    <th>Bandera</th>
                                    <th>Capital</th>
                                    <th>Población</th>
                                    <th>Moneda</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo htmlspecialchars($p['name']['common'] ?? 'N/A'); ?></td>
                                    <td><img src="<?php echo htmlspecialchars($p['flags']['png'] ?? ''); ?>" width="50" alt="Bandera"></td>
                                    <td><?php echo htmlspecialchars($p['capital'][0] ?? 'N/A'); ?></td>
                                    <td><?php echo number_format($p['population'] ?? 0); ?></td>
                                    <td>
                                        <?php 
                                            if (!empty($p['currencies'])) {
                                                foreach ($p['currencies'] as $codigo => $moneda) {
                                                    echo htmlspecialchars($moneda['name'] . " ($codigo)");
                                                    break; // mostrar solo una
                                                }
                                            } else {
                                                echo 'N/A';
                                            }
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <?php endforeach; ?>
                </div> 
            <?php endif; ?>
        </form>
    </div>
</div>
<?php include "footer.php"; ?>
