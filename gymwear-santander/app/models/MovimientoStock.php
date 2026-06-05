<?php
require_once __DIR__ . '/../core/Database.php';

class MovimientoStock{
    private PDO $db;

    public function __construct(){
        $this->db = Database::getConnection();
    }

    public function obtenerMovimientos():array {
        $sql = "SELECT movimiento_stock.id_movimiento,
                       producto.nombre AS nombre_producto,
                       movimiento_stock.id_variante,
                       variante_producto.talla,
                       variante_producto.color,
                       movimiento_stock.tipo,
                       movimiento_stock.cantidad,
                       movimiento_stock.motivo,
                       movimiento_stock.fecha,
                       movimiento_stock.id_usuario,
                       usuario.nombre_usuario
                FROM movimiento_stock
                INNER JOIN variante_producto
                ON movimiento_stock.id_variante = variante_producto.id_variante
                INNER JOIN producto
                ON variante_producto.id_producto = producto.id_producto
                INNER JOIN usuario
                ON movimiento_stock.id_usuario = usuario.id_usuario
                ORDER BY movimiento_stock.id_movimiento ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function obtenerVariantes(): array {
        $sql = "SELECT variante_producto.id_variante,
                       producto.nombre AS nombre_producto,
                       variante_producto.talla,
                       variante_producto.color
                FROM variante_producto
                INNER JOIN producto ON variante_producto.id_producto = producto.id_producto
                ORDER BY variante_producto.id_variante ASC";
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

    public function obtenerMovimientoPorId(int $id_movimiento): array|false {
        $sql = "SELECT id_movimiento, id_variante, tipo, cantidad, motivo, fecha, id_usuario
                FROM movimiento_stock
                WHERE id_movimiento = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_movimiento]);
        return $stmt->fetch();
    }

    public function guardarMovimiento(array $datos): array {
        $id_movimiento = (int)($datos['id_movimiento'] ?? 0);
        $id_variante = (int)($datos['id_variante'] ?? 0);
        $tipo = trim($datos['tipo'] ?? '');
        $cantidad = (int)($datos['cantidad'] ?? 0);
        $motivo = trim($datos['motivo'] ?? '');
        $fecha = trim($datos['fecha'] ?? '');
        $id_usuario = (int)($datos['id_usuario'] ?? 0);

        if ($id_variante <= 0 || $tipo === '' || $cantidad <= 0 || $fecha === '' || $id_usuario <= 0) {
            return ['ok' => false, 'mensaje' => 'Completa los campos'];
        }

        if ($id_movimiento > 0) {
            $sql = "UPDATE movimiento_stock
                    SET id_variante=:id_variante, tipo=:tipo, cantidad=:cantidad, motivo=:motivo, fecha=:fecha, id_usuario=:id_usuario
                    WHERE id_movimiento=:id_movimiento";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'id_variante' => $id_variante,
                'tipo' => $tipo,
                'cantidad' => $cantidad,
                'motivo' => $motivo,
                'fecha' => $fecha,
                'id_usuario' => $id_usuario,
                'id_movimiento' => $id_movimiento
            ]);
            return ['ok' => true, 'mensaje' => 'Movimiento actualizado'];
        }

        $sql = "INSERT INTO movimiento_stock (id_variante, tipo, cantidad, motivo, fecha, id_usuario)
                VALUES (:id_variante, :tipo, :cantidad, :motivo, :fecha, :id_usuario)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id_variante' => $id_variante,
            'tipo' => $tipo,
            'cantidad' => $cantidad,
            'motivo' => $motivo,
            'fecha' => $fecha,
            'id_usuario' => $id_usuario
        ]);
        return ['ok' => true, 'mensaje' => 'Movimiento registrado'];
    }

    public function eliminarMovimiento(int $id_movimiento): bool {
        $sql = "DELETE FROM movimiento_stock WHERE id_movimiento = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_movimiento]);
    }
}
