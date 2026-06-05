<?php
require_once __DIR__ . '/../core/Database.php';

class Usuario{
    private PDO $db;

    public function __construct(){
        $this->db = Database::getConnection();
    }

    public function obtenerUsuarios():array {
        $sql = "SELECT id_usuario, roles, nombre_usuario, clave
                FROM usuario
                ORDER BY id_usuario ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function obtenerUsuarioPorId(int $id_usuario): array|false {
        $sql = "SELECT id_usuario, roles, nombre_usuario, clave
                FROM usuario
                WHERE id_usuario = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_usuario]);
        return $stmt->fetch();
    }

    public function guardarUsuario(array $datos): array {
        $id_usuario = (int)($datos['id_usuario'] ?? 0);
        $roles = trim($datos['roles'] ?? 'admin');
        $nombre_usuario = trim($datos['nombre_usuario'] ?? '');
        $clave = trim($datos['clave'] ?? '');

        if ($nombre_usuario === '' || $clave === '') {
            return ['ok' => false, 'mensaje' => 'Completa los campos'];
        }

        if ($id_usuario > 0) {
            $sql = "UPDATE usuario
                    SET roles = :roles, nombre_usuario = :nombre_usuario, clave = :clave
                    WHERE id_usuario = :id_usuario";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'roles' => $roles,
                'nombre_usuario' => $nombre_usuario,
                'clave' => $clave,
                'id_usuario' => $id_usuario
            ]);
            return ['ok' => true, 'mensaje' => 'Usuario actualizado'];
        }

        $sql = "INSERT INTO usuario (roles, nombre_usuario, clave)
                VALUES (:roles, :nombre_usuario, :clave)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'roles' => $roles,
            'nombre_usuario' => $nombre_usuario,
            'clave' => $clave
        ]);
        return ['ok' => true, 'mensaje' => 'Usuario registrado'];
    }

    public function eliminarUsuario(int $id_usuario): bool {
        $sql = "DELETE FROM usuario WHERE id_usuario = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_usuario]);
    }
}
