<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Stock</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/dashboard.css">
</head>
<body>
<?php include __DIR__ . '/../layouts/sidebar-dashboard.php'; ?>
<main>
    <nav class="breadcrumb">
        <span>Dashboard</span><i class="fa-solid fa-chevron-right"></i>
        <span>Stock</span><i class="fa-solid fa-chevron-right"></i>
        <span id="breadcrumb-page">Registro</span>
    </nav>
    <div class="main-content">
        <form action="<?php echo BASE_URL; ?>/stock/guardar" method="POST">
            <input type="hidden" name="id_movimiento" value="<?php echo htmlspecialchars($movimiento['id_movimiento'] ?? ''); ?>">
            <p><label>Variante</label><br>
                <select name="id_variante">
                    <option value="">Seleccione</option>
                    <?php foreach ($variantes as $variante): ?>
                        <option value="<?php echo $variante['id_variante']; ?>" <?php echo (($movimiento['id_variante'] ?? '') == $variante['id_variante']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($variante['nombre_producto'] . ' - ' . $variante['talla'] . ' - ' . $variante['color']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p><label>Tipo</label><br>
                <input type="text" name="tipo" value="<?php echo htmlspecialchars($movimiento['tipo'] ?? ''); ?>">
            </p>
            <p><label>Cantidad</label><br>
                <input type="number" name="cantidad" value="<?php echo htmlspecialchars($movimiento['cantidad'] ?? '0'); ?>">
            </p>
            <p><label>Motivo</label><br>
                <input type="text" name="motivo" value="<?php echo htmlspecialchars($movimiento['motivo'] ?? ''); ?>">
            </p>
            <p><label>Fecha</label><br>
                <input type="datetime-local" name="fecha" value="<?php echo isset($movimiento['fecha']) ? htmlspecialchars(str_replace(' ', 'T', substr($movimiento['fecha'], 0, 16))) : ''; ?>">
            </p>
            <p><label>Usuario</label><br>
                <select name="id_usuario">
                    <option value="">Seleccione</option>
                    <?php foreach ($usuarios as $usuarioFila): ?>
                        <option value="<?php echo $usuarioFila['id_usuario']; ?>" <?php echo (($movimiento['id_usuario'] ?? '') == $usuarioFila['id_usuario']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($usuarioFila['nombre_usuario']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>
            <button type="submit">Guardar</button>
            <a href="<?php echo BASE_URL; ?>/stock">Volver</a>
        </form>
    </div>
</main>
</body>
</html>
