<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/MovimientoStock.php';

class StockController extends Controller {
    public function index(): void {
        $this->reporte();
    }

    public function reporte(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new MovimientoStock();
        $movimientos = $modelo->obtenerMovimientos();

        $this->view('stock/reportes', [
            'usuario' => $_SESSION['usuario'],
            'movimientos' => $movimientos
        ]);
    }

    public function reportes(): void {
        $this->reporte();
    }

    public function registro(?int $id_movimiento = null): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new MovimientoStock();
        $variantes = $modelo->obtenerVariantes();
        $usuarios = $modelo->obtenerUsuarios();
        $movimiento = null;
        if ($id_movimiento) {
            $movimiento = $modelo->obtenerMovimientoPorId($id_movimiento);
        }

        $this->view('stock/registro', [
            'usuario' => $_SESSION['usuario'],
            'variantes' => $variantes,
            'usuarios' => $usuarios,
            'movimiento' => $movimiento
        ]);
    }

    public function guardar(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new MovimientoStock();
        $modelo->guardarMovimiento([
            'id_movimiento' => $_POST['id_movimiento'] ?? 0,
            'id_variante' => $_POST['id_variante'] ?? 0,
            'tipo' => $_POST['tipo'] ?? '',
            'cantidad' => $_POST['cantidad'] ?? 0,
            'motivo' => $_POST['motivo'] ?? '',
            'fecha' => $_POST['fecha'] ?? '',
            'id_usuario' => $_POST['id_usuario'] ?? 0
        ]);

        header('Location: ' . BASE_URL . '/stock');
        exit();
    }

    public function eliminar_movimiento(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new MovimientoStock();
        $modelo->eliminarMovimiento((int)($_POST['id_movimiento'] ?? 0));
        header('Location: ' . BASE_URL . '/stock');
        exit();
    }
}
