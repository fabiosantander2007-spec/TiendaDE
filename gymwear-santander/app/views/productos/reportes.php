<!DOCTYPE html>
<html lang="Es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Productos</title>
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
        <span>Productos</span>
        <i class="fa-solid fa-chevron-right"></i>
        <span id="breadcrumb-page">Reportes</span>
    </nav>
    <div class="main-content">
        <p>
            <a href="<?php echo BASE_URL; ?>/productos/registro">Registrar producto</a>
        </p>
        <div class="table-responsive">
            <?php if (empty($productos)) : ?>
                <p>No hay registro</p>
            <?php else: ?>
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th><i class="fa-solid fa-hashtag"></i> ID</th>
                            <th><i class="fa-solid fa-shirt"></i> Nombre</th>
                            <th><i class="fa-solid fa-align-left"></i> Descripción</th>
                            <th><i class="fa-solid fa-money-bill-wave"></i> Precio</th>
                            <th><i class="fa-solid fa-layer-group"></i> Categoría</th>
                            <th><i class="fa-solid fa-gears"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $producto): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($producto['id_producto']) ?></td>
                                <td><?php echo htmlspecialchars($producto['nombre']) ?></td>
                                <td><?php echo htmlspecialchars($producto['descripcion']) ?></td>
                                <td>S/ <?php echo htmlspecialchars($producto['precio_unitario']) ?></td>
                                <td><?php echo htmlspecialchars($producto['nombre_categoria']) ?></td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>/productos/registro/<?php echo $producto['id_producto']; ?>" style="color:#16a34a;"><i class="fa-solid fa-pen"></i></a>
                                    <form action="<?php echo BASE_URL; ?>/productos/eliminar_producto" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar este producto?');">
                                        <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
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
