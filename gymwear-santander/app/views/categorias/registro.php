<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Categorías</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/dashboard.css">
</head>
<body>
<?php include __DIR__ . '/../layouts/sidebar-dashboard.php'; ?>
<main>
    <nav class="breadcrumb">
        <span>Dashboard</span><i class="fa-solid fa-chevron-right"></i>
        <span>Categorías</span><i class="fa-solid fa-chevron-right"></i>
        <span id="breadcrumb-page">Registro</span>
    </nav>
    <div class="main-content">
        <form action="<?php echo BASE_URL; ?>/categorias/guardar" method="POST">
            <input type="hidden" name="id_categoria" value="<?php echo htmlspecialchars($categoria['id_categoria'] ?? ''); ?>">
            <p><label><i class="fa-solid fa-layer-group"></i> Nombre</label><br>
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($categoria['nombre'] ?? ''); ?>">
            </p>
            <button type="submit"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
            <a href="<?php echo BASE_URL; ?>/categorias"><i class="fa-solid fa-arrow-left"></i> Volver</a>
        </form>
    </div>
</main>
</body>
</html>
