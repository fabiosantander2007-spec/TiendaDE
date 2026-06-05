<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Venta.php';

class VentasController extends Controller {
    public function index(): void {
        $this->reporte();
    }

    public function reporte(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new Venta();
        $ventas = $modelo->obtenerVentas();

        $this->view('ventas/reportes', [
            'usuario' => $_SESSION['usuario'],
            'ventas' => $ventas
        ]);
    }

    public function reportes(): void {
        $this->reporte();
    }

    public function registro(?int $id_venta = null): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new Venta();
        $usuarios = $modelo->obtenerUsuarios();
        $venta = null;
        if ($id_venta) {
            $venta = $modelo->obtenerVentaPorId($id_venta);
        }

        $this->view('ventas/registro', [
            'usuario' => $_SESSION['usuario'],
            'usuarios' => $usuarios,
            'venta' => $venta
        ]);
    }

    public function guardar(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new Venta();
        $modelo->guardarVenta([
            'id_venta' => $_POST['id_venta'] ?? 0,
            'fecha' => $_POST['fecha'] ?? '',
            'total' => $_POST['total'] ?? 0,
            'id_usuario' => $_POST['id_usuario'] ?? 0
        ]);

        header('Location: ' . BASE_URL . '/ventas');
        exit();
    }

    public function eliminar_venta(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new Venta();
        $modelo->eliminarVenta((int)($_POST['id_venta'] ?? 0));
        header('Location: ' . BASE_URL . '/ventas');
        exit();
    }
}
