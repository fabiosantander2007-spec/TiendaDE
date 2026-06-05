<?php
require_once __DIR__ . '/../core/Database.php';

class DetalleVenta{
    private PDO $db;

    public function __construct(){
        $this->db = Database::getConnection();
    }

    public function obtenerDetalleVentas():array {
        $sql = "SELECT detalle_venta.id_detalle,
                       detalle_venta.id_venta,
                       detalle_venta.id_variante,
                       producto.nombre AS nombre_producto,
                       variante_producto.talla,
                       variante_producto.color,
                       detalle_venta.cantidad,
                       detalle_venta.precio_unitario
                FROM detalle_venta
                INNER JOIN variante_producto
                ON detalle_venta.id_variante = variante_producto.id_variante
                INNER JOIN producto
                ON variante_producto.id_producto = producto.id_producto
                ORDER BY detalle_venta.id_detalle ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function obtenerVentas(): array {
        $sql = "SELECT id_venta, fecha FROM venta ORDER BY id_venta ASC";
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

    public function obtenerDetallePorId(int $id_detalle): array|false {
        $sql = "SELECT id_detalle, id_venta, id_variante, cantidad, precio_unitario
                FROM detalle_venta
                WHERE id_detalle = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_detalle]);
        return $stmt->fetch();
    }

    public function guardarDetalle(array $datos): array {
        $id_detalle = (int)($datos['id_detalle'] ?? 0);
        $id_venta = (int)($datos['id_venta'] ?? 0);
        $id_variante = (int)($datos['id_variante'] ?? 0);
        $cantidad = (int)($datos['cantidad'] ?? 0);
        $precio_unitario = (float)($datos['precio_unitario'] ?? 0);

        if ($id_venta <= 0 || $id_variante <= 0 || $cantidad <= 0 || $precio_unitario <= 0) {
            return ['ok' => false, 'mensaje' => 'Completa los campos'];
        }

        if ($id_detalle > 0) {
            $sql = "UPDATE detalle_venta
                    SET id_venta=:id_venta, id_variante=:id_variante, cantidad=:cantidad, precio_unitario=:precio_unitario
                    WHERE id_detalle=:id_detalle";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'id_venta' => $id_venta,
                'id_variante' => $id_variante,
                'cantidad' => $cantidad,
                'precio_unitario' => $precio_unitario,
                'id_detalle' => $id_detalle
            ]);
            return ['ok' => true, 'mensaje' => 'Detalle actualizado'];
        }

        $sql = "INSERT INTO detalle_venta (id_venta, id_variante, cantidad, precio_unitario)
                VALUES (:id_venta, :id_variante, :cantidad, :precio_unitario)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id_venta' => $id_venta,
            'id_variante' => $id_variante,
            'cantidad' => $cantidad,
            'precio_unitario' => $precio_unitario
        ]);
        return ['ok' => true, 'mensaje' => 'Detalle registrado'];
    }

    public function eliminarDetalle(int $id_detalle): bool {
        $sql = "DELETE FROM detalle_venta WHERE id_detalle = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_detalle]);
    }
}
