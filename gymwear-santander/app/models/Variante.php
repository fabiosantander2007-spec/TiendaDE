<?php
require_once __DIR__ . '/../core/Database.php';

class Variante{
    private PDO $db;

    public function __construct(){
        $this->db = Database::getConnection();
    }

    public function obtenerVariantes():array {
        $sql = "SELECT variante_producto.id_variante,
                       producto.nombre AS nombre_producto,
                       variante_producto.id_producto,
                       variante_producto.talla,
                       variante_producto.color,
                       variante_producto.stock
                FROM variante_producto
                INNER JOIN producto
                ON variante_producto.id_producto = producto.id_producto
                ORDER BY variante_producto.id_variante ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function obtenerProductos(): array {
        $sql = "SELECT id_producto, nombre FROM producto ORDER BY nombre ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function obtenerVariantePorId(int $id_variante): array|false {
        $sql = "SELECT id_variante, id_producto, talla, color, stock
                FROM variante_producto
                WHERE id_variante = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_variante]);
        return $stmt->fetch();
    }

    public function guardarVariante(array $datos): array {
        $id_variante = (int)($datos['id_variante'] ?? 0);
        $id_producto = (int)($datos['id_producto'] ?? 0);
        $talla = trim($datos['talla'] ?? '');
        $color = trim($datos['color'] ?? '');
        $stock = (int)($datos['stock'] ?? 0);

        if ($id_producto <= 0 || $talla === '' || $color === '') {
            return ['ok' => false, 'mensaje' => 'Completa los campos'];
        }

        if ($id_variante > 0) {
            $sql = "UPDATE variante_producto
                    SET id_producto = :id_producto, talla = :talla, color = :color, stock = :stock
                    WHERE id_variante = :id_variante";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'id_producto' => $id_producto,
                'talla' => $talla,
                'color' => $color,
                'stock' => $stock,
                'id_variante' => $id_variante
            ]);
            return ['ok' => true, 'mensaje' => 'Variante actualizada'];
        }

        $sql = "INSERT INTO variante_producto (id_producto, talla, color, stock)
                VALUES (:id_producto, :talla, :color, :stock)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id_producto' => $id_producto,
            'talla' => $talla,
            'color' => $color,
            'stock' => $stock
        ]);
        return ['ok' => true, 'mensaje' => 'Variante registrada'];
    }

    public function eliminarVariante(int $id_variante): bool {
        $sql1 = "DELETE FROM detalle_venta WHERE id_variante = ?";
        $stmt1 = $this->db->prepare($sql1);
        $stmt1->execute([$id_variante]);

        $sql2 = "DELETE FROM movimiento_stock WHERE id_variante = ?";
        $stmt2 = $this->db->prepare($sql2);
        $stmt2->execute([$id_variante]);

        $sql3 = "DELETE FROM variante_producto WHERE id_variante = ?";
        $stmt3 = $this->db->prepare($sql3);
        return $stmt3->execute([$id_variante]);
    }
}
