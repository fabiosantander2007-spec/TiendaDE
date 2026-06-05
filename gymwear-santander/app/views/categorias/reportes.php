<!DOCTYPE html>
<html lang="Es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Categorías</title>
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
        <span>Categorías</span>
        <i class="fa-solid fa-chevron-right"></i>
        <span id="breadcrumb-page">Reportes</span>
    </nav>
    <div class="main-content">
        <p><a href="<?php echo BASE_URL; ?>/categorias/registro">Registrar categoría</a></p>
        <div class="table-responsive">
            <?php if (empty($categorias)) : ?>
                <p>No hay registro</p>
            <?php else: ?>
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th><i class="fa-solid fa-hashtag"></i> ID</th>
                            <th><i class="fa-solid fa-layer-group"></i> Nombre</th>
                            <th><i class="fa-solid fa-gears"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categorias as $categoria): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($categoria['id_categoria']) ?></td>
                                <td><?php echo htmlspecialchars($categoria['nombre']) ?></td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>/categorias/registro/<?php echo $categoria['id_categoria']; ?>" style="color:#16a34a;">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form action="<?php echo BASE_URL; ?>/categorias/eliminar_categoria" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar esta categoría?');">
                                        <input type="hidden" name="id_categoria" value="<?php echo $categoria['id_categoria']; ?>">
                                        <button type="submit" style="border:0;background:transparent;color:#dc2626;cursor:pointer;">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
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
