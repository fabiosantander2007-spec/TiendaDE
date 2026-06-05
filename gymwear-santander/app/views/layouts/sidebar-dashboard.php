<?php
$rutaActual = explode('/', trim($_GET['url'] ?? 'dashboard', '/'))[0] ?: 'dashboard';
?>
<div class="topbar">
    <div class="title-business">
        <span><?php echo htmlspecialchars($usuario['nombre_usuario'] ?? 'Usuario'); ?></span>
    </div>
    <div class="btn-menu">
        <button class="hamburger" aria-label="Abrir menú">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>
</div>

<div class="overlay"></div>

<aside class="sidebar">
    <div class="sidebar-logo"><?php echo htmlspecialchars($usuario['nombre_usuario'] ?? 'Usuario'); ?></div>
    <ul>
        <li>
            <a href="<?php echo BASE_URL; ?>/dashboard"
                class="<?php echo $rutaActual === 'dashboard' ? 'activo' : ''; ?>">
                <i class="fa-solid fa-house"></i>
                <span>Inicio</span>
            </a>
        </li>

        <li class="<?php echo $rutaActual === 'categorias' ? 'dropdown show' : 'dropdown'; ?>">
            <a href="#" class="dropbtn <?php echo $rutaActual === 'categorias' ? 'activo' : ''; ?>">
                <i class="fa-solid fa-layer-group"></i>
                <span>Categorías</span>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>
            <div class="dropdown-content">
                <a href="<?php echo BASE_URL; ?>/categorias"
                    class="<?php echo $rutaActual === 'categorias' ? 'activo' : ''; ?>">
                    <i class="fa-solid fa-table-list"></i>
                    Reporte
                </a>
                <a href="<?php echo BASE_URL; ?>/categorias/registro">
                    <i class="fa-solid fa-plus"></i>
                    Registrar
                </a>
            </div>
        </li>

        <li class="<?php echo $rutaActual === 'productos' ? 'dropdown show' : 'dropdown'; ?>">
            <a href="#" class="dropbtn <?php echo $rutaActual === 'productos' ? 'activo' : ''; ?>">
                <i class="fa-solid fa-shirt"></i>
                <span>Productos</span>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>
            <div class="dropdown-content">
                <a href="<?php echo BASE_URL; ?>/productos"
                    class="<?php echo $rutaActual === 'productos' ? 'activo' : ''; ?>">
                    <i class="fa-solid fa-table-list"></i>
                    Reporte
                </a>
                <a href="<?php echo BASE_URL; ?>/productos/registro">
                    <i class="fa-solid fa-plus"></i>
                    Registrar
                </a>
            </div>
        </li>

        <li class="<?php echo $rutaActual === 'variantes' ? 'dropdown show' : 'dropdown'; ?>">
            <a href="#" class="dropbtn <?php echo $rutaActual === 'variantes' ? 'activo' : ''; ?>">
                <i class="fa-solid fa-tags"></i>
                <span>Variantes</span>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>
            <div class="dropdown-content">
                <a href="<?php echo BASE_URL; ?>/variantes"
                    class="<?php echo $rutaActual === 'variantes' ? 'activo' : ''; ?>">
                    <i class="fa-solid fa-table-list"></i>
                    Reporte
                </a>
                <a href="<?php echo BASE_URL; ?>/variantes/registro">
                    <i class="fa-solid fa-plus"></i>
                    Registrar
                </a>
            </div>
        </li>

        <li class="<?php echo $rutaActual === 'ventas' ? 'dropdown show' : 'dropdown'; ?>">
            <a href="#" class="dropbtn <?php echo $rutaActual === 'ventas' ? 'activo' : ''; ?>">
                <i class="fa-solid fa-cash-register"></i>
                <span>Ventas</span>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>
            <div class="dropdown-content">
                <a href="<?php echo BASE_URL; ?>/ventas"
                    class="<?php echo $rutaActual === 'ventas' ? 'activo' : ''; ?>">
                    <i class="fa-solid fa-table-list"></i>
                    Reporte
                </a>
                <a href="<?php echo BASE_URL; ?>/ventas/registro">
                    <i class="fa-solid fa-plus"></i>
                    Registrar
                </a>
            </div>
        </li>

        <li class="<?php echo $rutaActual === 'detalleventas' ? 'dropdown show' : 'dropdown'; ?>">
            <a href="#" class="dropbtn <?php echo $rutaActual === 'detalleventas' ? 'activo' : ''; ?>">
                <i class="fa-solid fa-receipt"></i>
                <span>Detalle Venta</span>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>
            <div class="dropdown-content">
                <a href="<?php echo BASE_URL; ?>/detalleventas"
                    class="<?php echo $rutaActual === 'detalleventas' ? 'activo' : ''; ?>">
                    <i class="fa-solid fa-table-list"></i>
                    Reporte
                </a>
                <a href="<?php echo BASE_URL; ?>/detalleventas/registro">
                    <i class="fa-solid fa-plus"></i>
                    Registrar
                </a>
            </div>
        </li>

        <li class="<?php echo $rutaActual === 'stock' ? 'dropdown show' : 'dropdown'; ?>">
            <a href="#" class="dropbtn <?php echo $rutaActual === 'stock' ? 'activo' : ''; ?>">
                <i class="fa-solid fa-boxes-stacked"></i>
                <span>Stock</span>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>
            <div class="dropdown-content">
                <a href="<?php echo BASE_URL; ?>/stock"
                    class="<?php echo $rutaActual === 'stock' ? 'activo' : ''; ?>">
                    <i class="fa-solid fa-table-list"></i>
                    Reporte
                </a>
                <a href="<?php echo BASE_URL; ?>/stock/registro">
                    <i class="fa-solid fa-plus"></i>
                    Registrar
                </a>
            </div>
        </li>

        <li class="<?php echo $rutaActual === 'usuarios' ? 'dropdown show' : 'dropdown'; ?>">
            <a href="#" class="dropbtn <?php echo $rutaActual === 'usuarios' ? 'activo' : ''; ?>">
                <i class="fa-solid fa-user-cog"></i>
                <span>Usuarios</span>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>
            <div class="dropdown-content">
                <a href="<?php echo BASE_URL; ?>/usuarios"
                    class="<?php echo $rutaActual === 'usuarios' ? 'activo' : ''; ?>">
                    <i class="fa-solid fa-table-list"></i>
                    Reporte
                </a>
                <a href="<?php echo BASE_URL; ?>/usuarios/registro">
                    <i class="fa-solid fa-plus"></i>
                    Registrar
                </a>
            </div>
        </li>

        <li class="nav-logout">
            <a href="<?php echo BASE_URL; ?>/logout" id="btn-logout">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Cerrar sesión</span>
            </a>
        </li>
    </ul>
</aside>

<script src="<?php echo BASE_URL; ?>/public/js/dropdown.js"></script>
