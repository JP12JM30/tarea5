<?php 
    include 'header.php'; 
    $chistes = '';
    $api_url = "https://official-joke-api.appspot.com/random_joke";

    $chiste = file_get_contents($api_url);
    if ($chiste !== false) {
        $datos = json_decode($chiste, true);
        $chistes = $datos['setup'] . " - " . $datos['punchline'];
    }
?>
<div class="container4">
    <div>
        <h2>El chiste del dia: </h2>
        <p><?= $chistes ?></p>
    </div>
   
    

</div>
<?php include 'footer.php'; ?>
