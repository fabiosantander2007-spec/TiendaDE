<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gymwear Santander</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/landing.css">
</head>
<body>
    <div id="fadeOverlay"></div>
    <?php
    $p1 = glob(__DIR__ . '/../../../public/image/conjunto.*');
    $p2 = glob(__DIR__ . '/../../../public/image/polos.*');
    $imgP1 = !empty($p1) ? BASE_URL . '/public/image/' . basename($p1[0]) : BASE_URL . '/public/image/conjunto';
    $imgP2 = !empty($p2) ? BASE_URL . '/public/image/' . basename($p2[0]) : BASE_URL . '/public/image/polos';
    ?>

    <?php include __DIR__ . '/../layouts/header-home.php'; ?>

    <section class="stage">
        <video class="hero-video" autoplay muted loop playsinline>
            <source src="<?php echo BASE_URL; ?>/public/video/donde.mp4" type="video/mp4">
        </video>

        <nav class="navbar" id="navbar">
            <a class="brand" href="#">GYMWEAR SANTANDER</a>

            <button class="menu-btn" id="menuBtn" aria-label="Abrir menú">
                <i class="bi bi-list"></i>
            </button>
        </nav>

        <div class="hero-content">
            <span class="hero-kicker">Streetwear deportivo</span>
            <h1 class="hero-title">Prendas para entrenar con presencia y comodidad.</h1>
            <p class="hero-copy">Catálogo visual, control de stock y ventas en un solo panel con la misma lógica simple del proyecto original.</p>
            <button class="cta-btn demo-trigger" id="verDemo">Ver demo</button>
        </div>

        <div class="scroll-indicator" id="scrollIndicator">
            <span>Scroll</span>
            <div class="scroll-line"></div>
        </div>
    </section>

    <section class="projects-section" id="catalogo">
        <div class="project-card">
            <div class="project-img-wrap">
                <img src="<?php echo $imgP1; ?>" alt="Conjuntos deportivos" class="project-img">
            </div>
            <span class="project-chip">Conjuntos</span>
            <h3 class="project-title">Hoodies y joggers</h3>
            <p class="project-desc">Combinaciones deportivas para vitrina o catálogo con enfoque urbano, cómodas para entrenar y usar a diario.</p>
            <a href="<?php echo BASE_URL; ?>/productos" class="project-link">Ver productos <i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="project-card">
            <div class="project-img-wrap">
                <img src="<?php echo $imgP2; ?>" alt="Polos estampados" class="project-img project-img--admin">
            </div>
            <span class="project-chip">Colección</span>
            <h3 class="project-title">Polos con identidad</h3>
            <p class="project-desc">Prendas destacadas para mostrar diseños, colores y variantes en una interfaz limpia y moderna sin perder el estilo del sistema.</p>
            <a href="<?php echo BASE_URL; ?>/variantes" class="project-link">Ver variantes <i class="bi bi-arrow-right"></i></a>
        </div>
    </section>

    <?php include __DIR__ . '/../layouts/footer-home.php'; ?>
    <script src="<?php echo BASE_URL; ?>/public/js/landing.js"></script>
</body>
</html>
