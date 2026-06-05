<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Producto.php';

class ProductosController extends Controller {
    public function index(): void {
        $this->reporte();
    }

    public function reporte(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new Producto();
        $productos = $modelo->obtenerProductos();

        $this->view('productos/reportes', [
            'usuario' => $_SESSION['usuario'],
            'productos' => $productos
        ]);
    }

    public function reportes(): void {
        $this->reporte();
    }

    public function registro(?int $id_producto = null): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new Producto();
        $categorias = $modelo->obtenerCategorias();
        $producto = null;

        if ($id_producto) {
            $producto = $modelo->obtenerProductoPorId($id_producto);
        }

        $this->view('productos/registro', [
            'usuario' => $_SESSION['usuario'],
            'categorias' => $categorias,
            'producto' => $producto
        ]);
    }

    public function guardar(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $datos = [
            'id_producto' => $_POST['id_producto'] ?? 0,
            'nombre' => $_POST['nombre'] ?? '',
            'descripcion' => $_POST['descripcion'] ?? '',
            'precio_unitario' => $_POST['precio_unitario'] ?? 0,
            'id_categoria' => $_POST['id_categoria'] ?? 0
        ];

        $modelo = new Producto();
        $resultado = $modelo->guardarProducto($datos);

        if ($resultado['ok']) {
            header('Location: ' . BASE_URL . '/productos');
            exit();
        }

        header('Location: ' . BASE_URL . '/productos/registro');
        exit();
    }

    public function eliminar_producto(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $id_producto = (int)($_POST['id_producto'] ?? 0);
        $modelo = new Producto();
        $modelo->eliminarProducto($id_producto);

        header('Location: ' . BASE_URL . '/productos');
        exit();
    }
}
