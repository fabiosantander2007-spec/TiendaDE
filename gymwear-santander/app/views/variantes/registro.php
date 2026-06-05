<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Variantes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/dashboard.css">
</head>
<body>
<?php include __DIR__ . '/../layouts/sidebar-dashboard.php'; ?>
<main>
    <nav class="breadcrumb">
        <span>Dashboard</span><i class="fa-solid fa-chevron-right"></i>
        <span>Variantes</span><i class="fa-solid fa-chevron-right"></i>
        <span id="breadcrumb-page">Registro</span>
    </nav>
    <div class="main-content">
        <form action="<?php echo BASE_URL; ?>/variantes/guardar" method="POST">
            <input type="hidden" name="id_variante" value="<?php echo htmlspecialchars($variante['id_variante'] ?? ''); ?>">
            <p><label><i class="fa-solid fa-shirt"></i> Producto</label><br>
                <select name="id_producto">
                    <option value="">Seleccione</option>
                    <?php foreach ($productos as $producto): ?>
                        <option value="<?php echo $producto['id_producto']; ?>" <?php echo (($variante['id_producto'] ?? '') == $producto['id_producto']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($producto['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p><label><i class="fa-solid fa-ruler"></i> Talla</label><br>
                <input type="text" name="talla" value="<?php echo htmlspecialchars($variante['talla'] ?? ''); ?>">
            </p>
            <p><label><i class="fa-solid fa-palette"></i> Color</label><br>
                <input type="text" name="color" value="<?php echo htmlspecialchars($variante['color'] ?? ''); ?>">
            </p>
            <p><label><i class="fa-solid fa-boxes-stacked"></i> Stock</label><br>
                <input type="number" name="stock" value="<?php echo htmlspecialchars($variante['stock'] ?? '0'); ?>">
            </p>
            <button type="submit"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
            <a href="<?php echo BASE_URL; ?>/variantes"><i class="fa-solid fa-arrow-left"></i> Volver</a>
        </form>
    </div>
</main>
</body>
</html>
