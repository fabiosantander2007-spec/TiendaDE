<!DOCTYPE html>
<html lang="Es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Variantes</title>
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
        <span>Variantes</span>
        <i class="fa-solid fa-chevron-right"></i>
        <span id="breadcrumb-page">Reportes</span>
    </nav>
    <div class="main-content">
        <p><a href="<?php echo BASE_URL; ?>/variantes/registro">Registrar variante</a></p>
        <div class="table-responsive">
            <?php if (empty($variantes)) : ?>
                <p>No hay registro</p>
            <?php else: ?>
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th><i class="fa-solid fa-hashtag"></i> ID</th>
                            <th><i class="fa-solid fa-shirt"></i> Producto</th>
                            <th><i class="fa-solid fa-ruler"></i> Talla</th>
                            <th><i class="fa-solid fa-palette"></i> Color</th>
                            <th><i class="fa-solid fa-boxes-stacked"></i> Stock</th>
                            <th><i class="fa-solid fa-gears"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($variantes as $variante): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($variante['id_variante']) ?></td>
                                <td><?php echo htmlspecialchars($variante['nombre_producto']) ?></td>
                                <td><?php echo htmlspecialchars($variante['talla']) ?></td>
                                <td><?php echo htmlspecialchars($variante['color']) ?></td>
                                <td><?php echo htmlspecialchars($variante['stock']) ?></td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>/variantes/registro/<?php echo $variante['id_variante']; ?>" style="color:#16a34a;"><i class="fa-solid fa-pen"></i></a>
                                    <form action="<?php echo BASE_URL; ?>/variantes/eliminar_variante" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar esta variante?');">
                                        <input type="hidden" name="id_variante" value="<?php echo $variante['id_variante']; ?>">
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
