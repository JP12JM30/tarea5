<?php
    include "header.php";
    function get_wordpress_data($url) {
        $json_url = rtrim($url, "/") . "/wp-json/wp/v2/posts?per_page=3&_embed";

        $json_data = @file_get_contents($json_url);
        if ($json_data === FALSE) return false;

        $posts = json_decode($json_data, true);
        $site_info = @file_get_contents(rtrim($url, "/") . "/wp-json");
        $site_info_data = json_decode($site_info, true);

        $logo = $site_info_data['name'] ?? 'Sitio WordPress';
        $icon_url = $site_info_data['site_icon_url'] ?? 'https://via.placeholder.com/60';

        return [
            'logo' => $logo,
            'icon' => $icon_url,
            'posts' => $posts
        ];
    }

    $data = null;
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['pagina'])) {
        $pagina = filter_var($_POST['pagina'], FILTER_SANITIZE_URL);
        $data = get_wordpress_data($pagina);
    }
?>

<div class="container3">
    <h1 class="text-center mb-4">📰 Noticias desde WordPress</h1>

    <form method="POST" class="row justify-content-center g-3 mb-5">
        <div class="col-md-6">
            <input type="text" name="pagina" class="form-control" placeholder="https://ejemplo.com" required>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn-2">Buscar Noticias</button>
        </div>
    </form>

    <?php if ($data): ?>
        <div class="text-center mb-5">
            <img src="<?= htmlspecialchars($data['icon']) ?>" alt="Logo" class="rounded-circle mb-2" width="60">
            <h2><?= htmlspecialchars($data['logo']) ?></h2>
        </div>

        <div class="row">
            <?php foreach ($data['posts'] as $post): ?>
                <div class="col-md-4">
                    <div class="card2 shadow-sm mb-4">
                        <div class="card-body2">
                            <h5 class="card-title"><?= htmlspecialchars($post['title']['rendered']) ?></h5>
                            <p class="card-text"><?= strip_tags(substr($post['excerpt']['rendered'], 0, 150)) ?>...</p>
                            <a href="<?= $post['link'] ?>" target="_blank">Leer más</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <div class="alert alert-danger text-center">⚠️ No se pudieron obtener noticias. Verifica la URL ingresada.</div>
    <?php endif; ?>
</div>

<?php include "footer.php"?>
