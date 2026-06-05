<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Registro de Producto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/dashboard.css">
</head>

<body>

<?php include __DIR__ . '/../layouts/sidebar-dashboard.php'; ?>

<main>
    <nav class="breadcrumb">
        <span>Dashboard</span>
        <i class="fa-solid fa-chevron-right"></i>
        <span>Productos</span>
        <i class="fa-solid fa-chevron-right"></i>
        <span id="breadcrumb-page">Registro</span>
    </nav>

    <div class="main-content">
        <form action="<?php echo BASE_URL; ?>/productos/guardar" method="POST">
            <input type="hidden" name="id_producto" value="<?php echo htmlspecialchars($producto['id_producto'] ?? ''); ?>">

            <p>
                <label><i class="fa-solid fa-tag"></i> Nombre</label><br>
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($producto['nombre'] ?? ''); ?>">
            </p>

            <p>
                <label><i class="fa-solid fa-align-left"></i> Descripción</label><br>
                <textarea name="descripcion"><?php echo htmlspecialchars($producto['descripcion'] ?? ''); ?></textarea>
            </p>

            <p>
                <label><i class="fa-solid fa-money-bill-wave"></i> Precio unitario</label><br>
                <input type="number" step="0.01" name="precio_unitario" value="<?php echo htmlspecialchars($producto['precio_unitario'] ?? ''); ?>">
            </p>

            <p>
                <label><i class="fa-solid fa-layer-group"></i> Categoría</label><br>
                <select name="id_categoria">
                    <option value="">Seleccione</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?php echo $categoria['id_categoria']; ?>"
                            <?php echo (($producto['id_categoria'] ?? '') == $categoria['id_categoria']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($categoria['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>

            <button type="submit">
                <i class="fa-solid fa-floppy-disk"></i>
                <?php echo !empty($producto) ? 'Actualizar' : 'Registrar'; ?>
            </button>
            <a href="<?php echo BASE_URL; ?>/productos"><i class="fa-solid fa-arrow-left"></i> Volver</a>
        </form>
    </div>
</main>

<script src="<?php echo BASE_URL; ?>/public/js/dashboard.js"></script>
</body>

</html>
