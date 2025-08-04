<?php
    include "header.php";

    $api_url = "https://api.exchangerate-api.com/v4/latest/USD";
    $response = file_get_contents($api_url);
    $rates= [];
    $resultado = '';
    $valor = '';
    $op1 = '';
    $op2 = '';

    if ($response !== false) {
        $data = json_decode($response, true);
        if (isset($data['rates'])) {
            $rates = $data['rates'];
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $valor = floatval($_POST['valor']);
        $op1 = $_POST['op1'];
        $op2 = $_POST['op2'];

        if ($valor > 0 && isset($rates[$op1]) && isset($rates[$op2])) {
            $conversion = ($valor / $rates[$op1]) * $rates[$op2];
            $resultado = number_format($conversion, 2);
        }
    }
        
?>
<div class="container3">
    <h2>Conversión de moneda</h2>

    <form class="" method="POST" action="">

        <div class="input-group">
            <div class="input-group mb-3">
                <input type="number" step="any"class="input-group-text" name="valor" placeholder="0.00" value="<?= htmlspecialchars($valor) ?>">
                <select class="input-group-text w-25" id="inputGroupSelect01" name="op1">
                    <option disabled <?= empty($op1) ? 'selected' : '' ?>>Moneda</option>
                    <?php foreach ($rates as $currency => $rate): ?>
                        <option value="<?= $currency ?>" <?= ($currency == $op1) ? 'selected' : '' ?>>
                            <?= $currency ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="input-group">
            <div class="input-group mb-3">
                <input type="text" class="input-group-text" placeholder="0.00" value="<?= htmlspecialchars($resultado)?> " readyonly>
                <select class="input-group-text w-25" name="op2">
                    <option disabled <?= empty($moneda2) ? 'selected' : '' ?>>Moneda</option>
                    <?php foreach ($rates as $currency => $rate): ?>
                            <option value="<?= $currency ?>" <?= ($currency == $op2) ? 'selected' : '' ?>>
                                <?= $currency ?>
                            </option>
                        <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="mt-4">
            <button class="btn btn-primary" type="submit">Convertir</button>
        </div>
    </form>
</div>
<?php include "footer.php";?>