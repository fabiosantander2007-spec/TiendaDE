<!DOCTYPE html>
<html lang="Es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Stock</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/dashboard.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/table-responsive.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/botones.css">
</head>

<body>

<?php include __DIR__ . '/../layouts/sidebar-dashboard.php'; ?>

<main>
    <nav class="breadcrumb">
        <span>Dashboard</span>
        <i class="fa-solid fa-chevron-right"></i>
        <span>Stock</span>
        <i class="fa-solid fa-chevron-right"></i>
        <span id="breadcrumb-page">Reportes</span>
    </nav>
    <div class="main-content">
        <p><a href="<?php echo BASE_URL; ?>/stock/registro">Registrar movimiento</a></p>
        <div class="table-responsive">
            <?php if (empty($movimientos)) : ?>
                <p>No hay registro</p>
            <?php else: ?>
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th><i class="fa-solid fa-hashtag"></i> ID</th>
                            <th><i class="fa-solid fa-shirt"></i> Producto</th>
                            <th><i class="fa-solid fa-ruler"></i> Talla</th>
                            <th><i class="fa-solid fa-palette"></i> Color</th>
                            <th><i class="fa-solid fa-arrow-right-arrow-left"></i> Tipo</th>
                            <th><i class="fa-solid fa-cubes"></i> Cantidad</th>
                            <th><i class="fa-solid fa-note-sticky"></i> Motivo</th>
                            <th><i class="fa-solid fa-calendar-days"></i> Fecha</th>
                            <th><i class="fa-solid fa-user"></i> Usuario</th>
                            <th><i class="fa-solid fa-gears"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($movimientos as $movimiento): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($movimiento['id_movimiento']) ?></td>
                                <td><?php echo htmlspecialchars($movimiento['nombre_producto']) ?></td>
                                <td><?php echo htmlspecialchars($movimiento['talla']) ?></td>
                                <td><?php echo htmlspecialchars($movimiento['color']) ?></td>
                                <td><?php echo htmlspecialchars($movimiento['tipo']) ?></td>
                                <td><?php echo htmlspecialchars($movimiento['cantidad']) ?></td>
                                <td><?php echo htmlspecialchars($movimiento['motivo']) ?></td>
                                <td><?php echo htmlspecialchars($movimiento['fecha']) ?></td>
                                <td><?php echo htmlspecialchars($movimiento['nombre_usuario']) ?></td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>/stock/registro/<?php echo $movimiento['id_movimiento']; ?>" style="color:#16a34a;"><i class="fa-solid fa-pen"></i></a>
                                    <form action="<?php echo BASE_URL; ?>/stock/eliminar_movimiento" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar este movimiento?');">
                                        <input type="hidden" name="id_movimiento" value="<?php echo $movimiento['id_movimiento']; ?>">
                                        <button type="submit" style="border:0;background:transparent;color:#dc2626;cursor:pointer;"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</main>
<script src="<?php echo BASE_URL; ?>/public/js/dashboard.js"></script>
</body>

</html>
