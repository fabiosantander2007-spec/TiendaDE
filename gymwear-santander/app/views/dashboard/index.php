<!DOCTYPE html>
<html lang="Es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Panel de Administración</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/dashboard.css">
</head>

<body>

<?php include __DIR__ . '/../layouts/sidebar-dashboard.php'; ?>

<!-- CONTENIDO PRINCIPAL -->
<main>
    <nav class="breadcrumb">
        <span>Inicio</span>
        <i class="fa-solid fa-chevron-right"></i>
        <span id="breadcrumb-page">Dashboard</span>
    </nav>
    <div class="main-content">
        <div class="table-responsive">
            <h2>Panel principal</h2>
            <p>Accesos rápidos a las tablas del sistema.</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Módulo</th>
                        <th>Ruta</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Productos</td>
                        <td><a href="<?php echo BASE_URL; ?>/productos">Ver</a></td>
                    </tr>
                    <tr>
                        <td>Categorías</td>
                        <td><a href="<?php echo BASE_URL; ?>/categorias">Ver</a></td>
                    </tr>
                    <tr>
                        <td>Variantes</td>
                        <td><a href="<?php echo BASE_URL; ?>/variantes">Ver</a></td>
                    </tr>
                    <tr>
                        <td>Ventas</td>
                        <td><a href="<?php echo BASE_URL; ?>/ventas">Ver</a></td>
                    </tr>
                    <tr>
                        <td>Detalle ventas</td>
                        <td><a href="<?php echo BASE_URL; ?>/detalleventas">Ver</a></td>
                    </tr>
                    <tr>
                        <td>Stock</td>
                        <td><a href="<?php echo BASE_URL; ?>/stock">Ver</a></td>
                    </tr>
                    <tr>
                        <td>Usuarios</td>
                        <td><a href="<?php echo BASE_URL; ?>/usuarios">Ver</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>
<script src="<?php echo BASE_URL; ?>/public/js/dashboard.js"></script>
</body>

</html>
