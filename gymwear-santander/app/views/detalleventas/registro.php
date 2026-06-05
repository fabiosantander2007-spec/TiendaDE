<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Detalle Venta</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/dashboard.css">
</head>
<body>
<?php include __DIR__ . '/../layouts/sidebar-dashboard.php'; ?>
<main>
    <nav class="breadcrumb">
        <span>Dashboard</span><i class="fa-solid fa-chevron-right"></i>
        <span>Detalle Venta</span><i class="fa-solid fa-chevron-right"></i>
        <span id="breadcrumb-page">Registro</span>
    </nav>
    <div class="main-content">
        <form action="<?php echo BASE_URL; ?>/detalleventas/guardar" method="POST">
            <input type="hidden" name="id_detalle" value="<?php echo htmlspecialchars($detalle['id_detalle'] ?? ''); ?>">
            <p><label>Venta</label><br>
                <select name="id_venta">
                    <option value="">Seleccione</option>
                    <?php foreach ($ventas as $venta): ?>
                        <option value="<?php echo $venta['id_venta']; ?>" <?php echo (($detalle['id_venta'] ?? '') == $venta['id_venta']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($venta['id_venta'] . ' - ' . $venta['fecha']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p><label>Variante</label><br>
                <select name="id_variante">
                    <option value="">Seleccione</option>
                    <?php foreach ($variantes as $variante): ?>
                        <option value="<?php echo $variante['id_variante']; ?>" <?php echo (($detalle['id_variante'] ?? '') == $variante['id_variante']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($variante['nombre_producto'] . ' - ' . $variante['talla'] . ' - ' . $variante['color']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p><label>Cantidad</label><br>
                <input type="number" name="cantidad" value="<?php echo htmlspecialchars($detalle['cantidad'] ?? '0'); ?>">
            </p>
            <p><label>Precio unitario</label><br>
                <input type="number" step="0.01" name="precio_unitario" value="<?php echo htmlspecialchars($detalle['precio_unitario'] ?? ''); ?>">
            </p>
            <button type="submit">Guardar</button>
            <a href="<?php echo BASE_URL; ?>/detalleventas">Volver</a>
        </form>
    </div>
</main>
</body>
</html>
