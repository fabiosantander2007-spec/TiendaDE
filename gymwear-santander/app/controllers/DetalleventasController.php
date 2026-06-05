<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/DetalleVenta.php';

class DetalleventasController extends Controller {
    public function index(): void {
        $this->reporte();
    }

    public function reporte(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new DetalleVenta();
        $detalleventas = $modelo->obtenerDetalleVentas();

        $this->view('detalleventas/reportes', [
            'usuario' => $_SESSION['usuario'],
            'detalleventas' => $detalleventas
        ]);
    }

    public function reportes(): void {
        $this->reporte();
    }

    public function registro(?int $id_detalle = null): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new DetalleVenta();
        $ventas = $modelo->obtenerVentas();
        $variantes = $modelo->obtenerVariantes();
        $detalle = null;
        if ($id_detalle) {
            $detalle = $modelo->obtenerDetallePorId($id_detalle);
        }

        $this->view('detalleventas/registro', [
            'usuario' => $_SESSION['usuario'],
            'ventas' => $ventas,
            'variantes' => $variantes,
            'detalle' => $detalle
        ]);
    }

    public function guardar(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new DetalleVenta();
        $modelo->guardarDetalle([
            'id_detalle' => $_POST['id_detalle'] ?? 0,
            'id_venta' => $_POST['id_venta'] ?? 0,
            'id_variante' => $_POST['id_variante'] ?? 0,
            'cantidad' => $_POST['cantidad'] ?? 0,
            'precio_unitario' => $_POST['precio_unitario'] ?? 0
        ]);

        header('Location: ' . BASE_URL . '/detalleventas');
        exit();
    }

    public function eliminar_detalle(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new DetalleVenta();
        $modelo->eliminarDetalle((int)($_POST['id_detalle'] ?? 0));
        header('Location: ' . BASE_URL . '/detalleventas');
        exit();
    }
}
