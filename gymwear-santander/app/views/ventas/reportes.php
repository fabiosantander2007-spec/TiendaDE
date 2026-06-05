<!DOCTYPE html>
<html lang="Es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Ventas</title>
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
        <span>Ventas</span>
        <i class="fa-solid fa-chevron-right"></i>
        <span id="breadcrumb-page">Reportes</span>
    </nav>
    <div class="main-content">
        <p><a href="<?php echo BASE_URL; ?>/ventas/registro">Registrar venta</a></p>
        <div class="table-responsive">
            <?php if (empty($ventas)) : ?>
                <p>No hay registro</p>
            <?php else: ?>
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th><i class="fa-solid fa-hashtag"></i> ID</th>
                            <th><i class="fa-solid fa-calendar-days"></i> Fecha</th>
                            <th><i class="fa-solid fa-cash-register"></i> Total</th>
                            <th><i class="fa-solid fa-user"></i> Usuario</th>
                            <th><i class="fa-solid fa-gears"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ventas as $venta): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($venta['id_venta']) ?></td>
                                <td><?php echo htmlspecialchars($venta['fecha']) ?></td>
                                <td>S/ <?php echo htmlspecialchars($venta['total']) ?></td>
                                <td><?php echo htmlspecialchars($venta['nombre_usuario']) ?></td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>/ventas/registro/<?php echo $venta['id_venta']; ?>" style="color:#16a34a;"><i class="fa-solid fa-pen"></i></a>
                                    <form action="<?php echo BASE_URL; ?>/ventas/eliminar_venta" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar esta venta?');">
                                        <input type="hidden" name="id_venta" value="<?php echo $venta['id_venta']; ?>">
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
