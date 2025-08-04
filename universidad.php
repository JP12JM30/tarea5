<?php
    include 'header.php';
    $universidades = [];


    if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['pais'])) {
        $pais = urlencode(trim($_POST['pais']));
        $api_url = "http://universities.hipolabs.com/search?country=$pais";

        $universidad = file_get_contents($api_url);
        if ($universidad !== false) {
            $dato = json_decode($universidad, true);
            $universidades = $dato;
           
        }


    }
?>


<div class="container shadow-lg w-50">
    
     <div class="topic">
            <h2>Universidades de todo el mundo</h2>
            <p>Debe ingresar el nombre en ingles del pais al cual quiere ver las universidades</p>
        </div>
    <form class="form" action="" method="post">
       
        <div class="mb-3">
            <strong><label for="pais" class="form-label ms-2 h4">Pais</label></strong> 
            <input type="text" class="form-control w-50" id="pais" name="pais" placeholder="Dominican republic" required
                value="<?php echo isset($_POST['pais']) ? htmlspecialchars($_POST['pais']) : ''; ?>">
            <button class="btn mt-2" type="submit">Buscar</button>
        </div>

        <?php if (!empty($universidades)) : ?>
            <div class="mb-3 p-3 rounded">
                <strong><label class="form-label h5">Resultados:</label></strong>
                <?php foreach ($universidades as $uni) : ?>
                 <!--   <div class="border p-2 mb-2 rounded"> -->
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Universidad</th>
                                    <th>Página Web</th>
                                    <th>Dominio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo htmlspecialchars($uni['name']); ?></td>
                                    <td><a href="<?php echo htmlspecialchars($uni['web_pages'][0]); ?>" target="_blank"><?php echo htmlspecialchars($uni['web_pages'][0]); ?></a></td>
                                    <td><?php echo htmlspecialchars($uni['domains'][0]); ?></td>
                                </tr>
                            </tbody>
                        </table>
                   <!-- </div> -->
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </form>
</div>
<?php include 'footer.php';
