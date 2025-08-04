<?php 
    include 'header.php'; 
    $apiKey = "9y41Djd8PI5qHPwMfwkDDX1QUA1bQhEkU8neaWWvRWg";
    $imagenUrl = "";
   if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['foto'])  ) {
        $imagen = urlencode(trim($_POST['foto']));
        $api_url = "https://api.unsplash.com/photos/random?query=$imagen&client_id=$apiKey";

        $repuestas = file_get_contents($api_url);
        if ($repuestas !== false) {
            $datos = json_decode($repuestas, true);
            if (isset($datos['urls']['regular'])) {
                $imagenUrl = $datos['urls']['regular']; 
            }
        }
   }
?>
<div class="container4">
   <h2>Buscar imagen</h2>
   <form action="" method="post" class="d-flex mb-5">
        <input type="text" name= "foto" class= "form-control w-10">
        <button type="submit" class="btn" >Buscar</button>
   </form>
   
    <?php if($imagenUrl): ?>
        <div>
            <img src="<?= htmlspecialchars($imagenUrl)?>" alt="imagen" class="imagen">
            
        </div>
    <?php endif; ?>
    

</div>
<?php include 'footer.php'; ?>