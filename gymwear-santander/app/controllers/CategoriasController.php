<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Categoria.php';

class CategoriasController extends Controller {
    public function index(): void {
        $this->reporte();
    }

    public function reporte(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new Categoria();
        $categorias = $modelo->obtenerCategorias();

        $this->view('categorias/reportes', [
            'usuario' => $_SESSION['usuario'],
            'categorias' => $categorias
        ]);
    }

    public function reportes(): void {
        $this->reporte();
    }

    public function registro(?int $id_categoria = null): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new Categoria();
        $categoria = null;
        if ($id_categoria) {
            $categoria = $modelo->obtenerCategoriaPorId($id_categoria);
        }

        $this->view('categorias/registro', [
            'usuario' => $_SESSION['usuario'],
            'categoria' => $categoria
        ]);
    }

    public function guardar(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new Categoria();
        $resultado = $modelo->guardarCategoria([
            'id_categoria' => $_POST['id_categoria'] ?? 0,
            'nombre' => $_POST['nombre'] ?? ''
        ]);

        header('Location: ' . BASE_URL . '/categorias');
        exit();
    }

    public function eliminar_categoria(): void {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }

        $modelo = new Categoria();
        $modelo->eliminarCategoria((int)($_POST['id_categoria'] ?? 0));
        header('Location: ' . BASE_URL . '/categorias');
        exit();
    }
}
