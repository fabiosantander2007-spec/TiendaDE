<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../core/Controller.php';

// Controlador para cerrar la sesión del usuario.
class LogoutController extends Controller {

    // Se ejecuta cuando el usuario entra a /logout
    public function index(): void {
        // Eliminamos todos los datos guardados en $_SESSION
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
            );
        }
        session_destroy();

        // Redirigimos al login
        header('Location: ' . BASE_URL . '/login');
        exit;
    }
}
