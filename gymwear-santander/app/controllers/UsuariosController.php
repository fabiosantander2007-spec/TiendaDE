<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Usuario.php';

class UsuariosController extends Controller {
    public function index(): void {
        $this->reporte();
    }

    public function reporte(): void {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $modelo = new Usuario();
        $usuarios = $modelo->obtenerUsuarios();

        $this->view('usuarios/reportes', [
            'usuario' => $_SESSION['usuario'],
            'usuarios' => $usuarios
        ]);
    }

    public function reportes(): void {
        $this->reporte();
    }

    public function registro(?int $id_usuario = null): void {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $modelo = new Usuario();
        $usuarioFila = null;
        if ($id_usuario) {
            $usuarioFila = $modelo->obtenerUsuarioPorId($id_usuario);
        }

        $this->view('usuarios/registro', [
            'usuario' => $_SESSION['usuario'],
            'usuarioFila' => $usuarioFila
        ]);
    }

    public function guardar(): void {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $modelo = new Usuario();
        $modelo->guardarUsuario([
            'id_usuario' => $_POST['id_usuario'] ?? 0,
            'roles' => $_POST['roles'] ?? 'admin',
            'nombre_usuario' => $_POST['nombre_usuario'] ?? '',
            'clave' => $_POST['clave'] ?? ''
        ]);

        header('Location: ' . BASE_URL . '/usuarios');
        exit;
    }

    public function eliminar_usuario(): void {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $modelo = new Usuario();
        $modelo->eliminarUsuario((int)($_POST['id_usuario'] ?? 0));
        header('Location: ' . BASE_URL . '/usuarios');
        exit;
    }
}
