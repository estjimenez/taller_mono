<?php
class Task {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Método para obtener todas las tareas
    public function readAll() {
        $stmt = $this->pdo->prepare("SELECT * FROM tareas");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para crear una nueva tarea
    public function create($titulo, $descripcion, $fechaEstimadaFinalizacion,
        $creadorTarea, $observaciones, $idEmpleado, $idEstado, $idPrioridad) {

        $stmt = $this->pdo->prepare("INSERT INTO tareas (titulo, descripcion, 
        fechaEstimadaFinalizacion, creadorTarea, observaciones, idEmpleado,
         idEstado, idPrioridad, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");

        return $stmt->execute([
            $titulo, 
            $descripcion, 
            $fechaEstimadaFinalizacion,
            $creadorTarea, 
            $observaciones, 
            $idEmpleado, 
            $idEstado, 
            $idPrioridad
        ]);
    }

    // Método para actualizar una tarea existente
    public function update($id, $titulo, $descripcion, $fechaEstimadaFinalizacion,
     $fechaFinalizacion, $observaciones, $idEmpleado, $idEstado, $idPrioridad) {
        $stmt = $this->pdo->prepare("UPDATE tareas SET titulo = ?,
         descripcion = ?, fechaEstimadaFinalizacion = ?, 
         fechaFinalizacion = ?, observaciones = ?, idEmpleado = ?, idEstado = ?, 
         idPrioridad = ?, updated_at = NOW() WHERE id = ?");
        return $stmt->execute([
            $titulo, 
            $descripcion, 
            $fechaEstimadaFinalizacion,
            $fechaFinalizacion, 
            $observaciones, 
            $idEmpleado, 
            $idEstado, 
            $idPrioridad, 
            $id
        ]);
    }

    // Método para eliminar una tarea
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM tareas WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Método para obtener una tarea específica
    public function readOne($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM tareas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para filtrar tareas según criterios
    public function filter($whereClause, $params) {
        $query = "SELECT * FROM tareas " . $whereClause . " ORDER BY fechaEstimadaFinalizacion ASC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
