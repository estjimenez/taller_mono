<?php
// TaskController.php
require_once '../models/Task.php';
require_once '../config/db.php';

class TaskController {
    private $db;
    private $task;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->task = new Task($this->db);
    }

    // Crear una tarea
    public function createTask($data) {
        return $this->task->create(
            $data['title'], 
            $data['description'], 
            $data['estimated_end_date'],
            $data['creator'], 
            $data['notes'], 
            $data['assignee'], 
            $data['status'], 
            $data['priority']
        );
    }

    // Listar todas las tareas
    public function listTasks() {
        return $this->task->readAll();
    }

    // Obtener una tarea específica
    public function getTask($id) {
        return $this->task->readOne($id);
    }

    // Actualizar una tarea existente
    public function updateTask($id, $data) {
        return $this->task->update(
            $id,
            $data['title'],
            $data['description'],
            $data['estimated_end_date'],
            $data['completion_date'],
            $data['notes'],
            $data['assignee'],
            $data['status'],
            $data['priority']
        );
    }

    // Eliminar una tarea
    public function deleteTask($id) {
        return $this->task->delete($id);
    }

    // Filtrar tareas por varios criterios (Ejemplo: por estado, prioridad, fecha estimada de finalización)
    public function filterTasks($filters) {
        $whereClauses = [];
        $params = [];

        if (!empty($filters['status'])) {
            $whereClauses[] = "idEstado = ?";
            $params[] = $filters['status'];
        }
        if (!empty($filters['priority'])) {
            $whereClauses[] = "idPrioridad = ?";
            $params[] = $filters['priority'];
        }
        if (!empty($filters['estimated_end_date'])) {
            $whereClauses[] = "fechaEstimadaFinalizacion <= ?";
            $params[] = $filters['estimated_end_date'];
        }

        $whereClause = count($whereClauses) > 0 ? "WHERE " . implode(" AND ", $whereClauses) : "";
        return $this->task->filter($whereClause, $params);
    }
}
?>
