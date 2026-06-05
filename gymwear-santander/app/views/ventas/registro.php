<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Ventas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/dashboard.css">
</head>
<body>
<?php include __DIR__ . '/../layouts/sidebar-dashboard.php'; ?>
<main>
    <nav class="breadcrumb">
        <span>Dashboard</span><i class="fa-solid fa-chevron-right"></i>
        <span>Ventas</span><i class="fa-solid fa-chevron-right"></i>
        <span id="breadcrumb-page">Registro</span>
    </nav>
    <div class="main-content">
        <form action="<?php echo BASE_URL; ?>/ventas/guardar" method="POST">
            <input type="hidden" name="id_venta" value="<?php echo htmlspecialchars($venta['id_venta'] ?? ''); ?>">
            <p><label>Fecha</label><br>
                <input type="datetime-local" name="fecha" value="<?php echo isset($venta['fecha']) ? htmlspecialchars(str_replace(' ', 'T', substr($venta['fecha'], 0, 16))) : ''; ?>">
            </p>
            <p><label>Total</label><br>
                <input type="number" step="0.01" name="total" value="<?php echo htmlspecialchars($venta['total'] ?? ''); ?>">
            </p>
            <p><label>Usuario</label><br>
                <select name="id_usuario">
                    <option value="">Seleccione</option>
                    <?php foreach ($usuarios as $usuarioFila): ?>
                        <option value="<?php echo $usuarioFila['id_usuario']; ?>" <?php echo (($venta['id_usuario'] ?? '') == $usuarioFila['id_usuario']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($usuarioFila['nombre_usuario']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>
            <button type="submit">Guardar</button>
            <a href="<?php echo BASE_URL; ?>/ventas">Volver</a>
        </form>
    </div>
</main>
</body>
</html>
