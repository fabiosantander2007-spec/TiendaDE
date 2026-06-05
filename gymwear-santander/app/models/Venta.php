<?php
require_once __DIR__ . '/../core/Database.php';

class Venta{
    private PDO $db;

    public function __construct(){
        $this->db = Database::getConnection();
    }

    public function obtenerVentas():array {
        $sql = "SELECT venta.id_venta,
                       venta.fecha,
                       venta.total,
                       venta.id_usuario,
                       usuario.nombre_usuario
                FROM venta
                INNER JOIN usuario
                ON venta.id_usuario = usuario.id_usuario
                ORDER BY venta.id_venta ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function obtenerUsuarios(): array {
        $sql = "SELECT id_usuario, nombre_usuario FROM usuario ORDER BY nombre_usuario ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function obtenerVentaPorId(int $id_venta): array|false {
        $sql = "SELECT id_venta, fecha, total, id_usuario
                FROM venta
                WHERE id_venta = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_venta]);
        return $stmt->fetch();
    }

    public function guardarVenta(array $datos): array {
        $id_venta = (int)($datos['id_venta'] ?? 0);
        $fecha = trim($datos['fecha'] ?? '');
        $total = (float)($datos['total'] ?? 0);
        $id_usuario = (int)($datos['id_usuario'] ?? 0);

        if ($fecha === '' || $total <= 0 || $id_usuario <= 0) {
            return ['ok' => false, 'mensaje' => 'Completa los campos'];
        }

        if ($id_venta > 0) {
            $sql = "UPDATE venta SET fecha = :fecha, total = :total, id_usuario = :id_usuario WHERE id_venta = :id_venta";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'fecha' => $fecha,
                'total' => $total,
                'id_usuario' => $id_usuario,
                'id_venta' => $id_venta
            ]);
            return ['ok' => true, 'mensaje' => 'Venta actualizada'];
        }

        $sql = "INSERT INTO venta (fecha, total, id_usuario) VALUES (:fecha, :total, :id_usuario)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'fecha' => $fecha,
            'total' => $total,
            'id_usuario' => $id_usuario
        ]);
        return ['ok' => true, 'mensaje' => 'Venta registrada'];
    }

    public function eliminarVenta(int $id_venta): bool {
        $sql = "DELETE FROM venta WHERE id_venta = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_venta]);
    }
}
