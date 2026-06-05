<?php
require_once __DIR__ . '/../core/Database.php';

class Categoria{
    private PDO $db;

    public function __construct(){
        $this->db = Database::getConnection();
    }

    public function obtenerCategorias():array {
        $sql = "SELECT id_categoria, nombre
                FROM categoria
                ORDER BY id_categoria ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function obtenerCategoriaPorId(int $id_categoria): array|false {
        $sql = "SELECT id_categoria, nombre
                FROM categoria
                WHERE id_categoria = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_categoria]);
        return $stmt->fetch();
    }

    public function guardarCategoria(array $datos): array {
        $id_categoria = (int)($datos['id_categoria'] ?? 0);
        $nombre = trim($datos['nombre'] ?? '');

        if ($nombre === '') {
            return ['ok' => false, 'mensaje' => 'Escribe un nombre'];
        }

        if ($id_categoria > 0) {
            $sql = "UPDATE categoria SET nombre = :nombre WHERE id_categoria = :id_categoria";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'nombre' => $nombre,
                'id_categoria' => $id_categoria
            ]);
            return ['ok' => true, 'mensaje' => 'Categoría actualizada'];
        }

        $sql = "INSERT INTO categoria (nombre) VALUES (:nombre)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['nombre' => $nombre]);
        return ['ok' => true, 'mensaje' => 'Categoría registrada'];
    }

    public function eliminarCategoria(int $id_categoria): bool {
        $sqlProductos = "SELECT id_producto FROM producto WHERE id_categoria = ?";
        $stmtProductos = $this->db->prepare($sqlProductos);
        $stmtProductos->execute([$id_categoria]);
        $productos = $stmtProductos->fetchAll(PDO::FETCH_COLUMN);

        require_once __DIR__ . '/Producto.php';
        $modeloProducto = new Producto();
        foreach ($productos as $id_producto) {
            $modeloProducto->eliminarProducto((int)$id_producto);
        }

        $sql = "DELETE FROM categoria WHERE id_categoria = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_categoria]);
    }
}
