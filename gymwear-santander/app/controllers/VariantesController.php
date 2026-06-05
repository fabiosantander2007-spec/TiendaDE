<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Variante.php';

class VariantesController extends Controller {
    public function index(): void {
        $this->reporte();
    }

    public function reporte(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new Variante();
        $variantes = $modelo->obtenerVariantes();

        $this->view('variantes/reportes', [
            'usuario' => $_SESSION['usuario'],
            'variantes' => $variantes
        ]);
    }

    public function reportes(): void {
        $this->reporte();
    }

    public function registro(?int $id_variante = null): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new Variante();
        $productos = $modelo->obtenerProductos();
        $variante = null;
        if ($id_variante) {
            $variante = $modelo->obtenerVariantePorId($id_variante);
        }

        $this->view('variantes/registro', [
            'usuario' => $_SESSION['usuario'],
            'productos' => $productos,
            'variante' => $variante
        ]);
    }

    public function guardar(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new Variante();
        $modelo->guardarVariante([
            'id_variante' => $_POST['id_variante'] ?? 0,
            'id_producto' => $_POST['id_producto'] ?? 0,
            'talla' => $_POST['talla'] ?? '',
            'color' => $_POST['color'] ?? '',
            'stock' => $_POST['stock'] ?? 0
        ]);

        header('Location: ' . BASE_URL . '/variantes');
        exit();
    }

    public function eliminar_variante(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new Variante();
        $modelo->eliminarVariante((int)($_POST['id_variante'] ?? 0));
        header('Location: ' . BASE_URL . '/variantes');
        exit();
    }
}
