<?php
require_once __DIR__ . '/../core/Database.php';

class Producto{
    private PDO $db;

    public function __construct(){
        $this->db = Database::getConnection();
    }

    public function obtenerProductos():array {
        $sql = "SELECT producto.id_producto,
                       producto.nombre,
                       producto.descripcion,
                       producto.precio_unitario,
                       producto.id_categoria,
                       categoria.nombre AS nombre_categoria
                FROM producto
                INNER JOIN categoria
                ON producto.id_categoria = categoria.id_categoria
                ORDER BY producto.id_producto ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function obtenerCategorias(): array {
        $sql = "SELECT id_categoria, nombre FROM categoria ORDER BY nombre ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function obtenerProductoPorId(int $id_producto): array|false {
        $sql = "SELECT id_producto, nombre, descripcion, precio_unitario, id_categoria
                FROM producto
                WHERE id_producto = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_producto]);
        return $stmt->fetch();
    }

    public function guardarProducto(array $datos): array {
        $id_producto = (int)($datos['id_producto'] ?? 0);
        $nombre = trim($datos['nombre'] ?? '');
        $descripcion = trim($datos['descripcion'] ?? '');
        $precio_unitario = (float)($datos['precio_unitario'] ?? 0);
        $id_categoria = (int)($datos['id_categoria'] ?? 0);

        if ($nombre === '' || $precio_unitario <= 0 || $id_categoria <= 0) {
            return ['ok' => false, 'mensaje' => 'Completa los campos obligatorios'];
        }

        if ($id_producto > 0) {
            $sql = "UPDATE producto
                    SET nombre = :nombre,
                        descripcion = :descripcion,
                        precio_unitario = :precio_unitario,
                        id_categoria = :id_categoria
                    WHERE id_producto = :id_producto";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'precio_unitario' => $precio_unitario,
                'id_categoria' => $id_categoria,
                'id_producto' => $id_producto,
            ]);
            return ['ok' => true, 'mensaje' => 'Producto actualizado'];
        }

        $sql = "INSERT INTO producto (nombre, descripcion, precio_unitario, id_categoria)
                VALUES (:nombre, :descripcion, :precio_unitario, :id_categoria)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio_unitario' => $precio_unitario,
            'id_categoria' => $id_categoria,
        ]);

        return ['ok' => true, 'mensaje' => 'Producto registrado'];
    }

    public function eliminarProducto(int $id_producto): bool {
        $sqlVariantes = "SELECT id_variante FROM variante_producto WHERE id_producto = ?";
        $stmtVariantes = $this->db->prepare($sqlVariantes);
        $stmtVariantes->execute([$id_producto]);
        $variantes = $stmtVariantes->fetchAll(PDO::FETCH_COLUMN);

        require_once __DIR__ . '/Variante.php';
        $modeloVariante = new Variante();
        foreach ($variantes as $id_variante) {
            $modeloVariante->eliminarVariante((int)$id_variante);
        }

        $sql = "DELETE FROM producto WHERE id_producto = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_producto]);
    }
}
