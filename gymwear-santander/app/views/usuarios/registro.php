<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Usuarios</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/dashboard.css">
</head>
<body>
<?php include __DIR__ . '/../layouts/sidebar-dashboard.php'; ?>
<main>
    <nav class="breadcrumb">
        <span>Dashboard</span><i class="fa-solid fa-chevron-right"></i>
        <span>Usuarios</span><i class="fa-solid fa-chevron-right"></i>
        <span id="breadcrumb-page">Registro</span>
    </nav>
    <div class="main-content">
        <form action="<?php echo BASE_URL; ?>/usuarios/guardar" method="POST">
            <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($usuarioFila['id_usuario'] ?? ''); ?>">
            <p><label>Rol</label><br>
                <select name="roles">
                    <option value="admin" <?php echo (($usuarioFila['roles'] ?? '') === 'admin') ? 'selected' : ''; ?>>admin</option>
                    <option value="superadmin" <?php echo (($usuarioFila['roles'] ?? '') === 'superadmin') ? 'selected' : ''; ?>>superadmin</option>
                </select>
            </p>
            <p><label>Usuario</label><br>
                <input type="text" name="nombre_usuario" value="<?php echo htmlspecialchars($usuarioFila['nombre_usuario'] ?? ''); ?>">
            </p>
            <p><label>Clave</label><br>
                <input type="text" name="clave" value="<?php echo htmlspecialchars($usuarioFila['clave'] ?? ''); ?>">
            </p>
            <button type="submit">Guardar</button>
            <a href="<?php echo BASE_URL; ?>/usuarios">Volver</a>
        </form>
    </div>
</main>
</body>
</html>
