<?php
require_once '/xampp/htdocs/taller_mono/models/consultas.php'; 
class ConsultasModel {
    public function obtenerConexion() {
        $conn = new mysqli('localhost', 'root', '', 'tareas_db');
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        return $conn;
    }
    public function ObtenerTareas() {
        $conn = $this->obtenerConexion();
        $query = "SELECT * FROM tareas";
        $result = $conn->query($query);
        if ($result) {
            $tareas = [];
            while ($row = $result->fetch_assoc()) {
                $tareas[] = $row;
            } 
            $conn->close();
            return $tareas;
        } else {
            echo "Error en la consulta: " . $conn->error;
            $conn->close();
            return [];
        }
    }
    public function InsertarTareas($titulo, $descripcion, $fechaEstimadaFinalizacion, $fechaFinalizacion, $crearTarea, $observacion, $empleado, $estado, $prioridad) {
        $conn = $this->obtenerConexion();
        $result = $conn->query("SELECT MAX(id) AS max_id FROM tareas");
        $row = $result->fetch_assoc();
        $next_id = $row['max_id'] + 1; 
        $stmt = $conn->prepare("INSERT INTO tareas (id, titulo, descripcion, fechaEstimadaFinalizacion, fechaFinalizacion, creadorTarea, observaciones, idEmpleado, idEstado, idPrioridad) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
 
        $stmt->bind_param("issssssiii", $next_id, $titulo, $descripcion, $fechaEstimadaFinalizacion, $fechaFinalizacion, $crearTarea, $observacion, $empleado, $estado, $prioridad);
    
        if ($stmt->execute()) {
            echo "Tarea insertada correctamente.";
        } else {
            echo "Error al insertar tarea: " . $stmt->error;
        }
    
        $conn->close();
    }
    
    
    public function ModificarTarea($id, $titulo, $descripcion, $fechaEstimadaFinalizacion, $fechaFinalizacion, $observacion, $empleado, $estado, $prioridad) {
        $conn = $this->obtenerConexion();
        $stmt = $conn->prepare("UPDATE tareas SET titulo=?, descripcion=?, fechaEstimadaFinalizacion=?, fechaFinalizacion=?, observaciones=?, idEmpleado=?, idEstado=?, idPrioridad=? WHERE id=?");
        $stmt->bind_param("ssssssssi", $titulo, $descripcion, $fechaEstimadaFinalizacion, $fechaFinalizacion, $observacion, $empleado, $estado, $prioridad, $id);
        $stmt->execute();
        $conn->close();
    }

    public function EliminarTarea($id) {
        $conn = $this->obtenerConexion();
        $stmt = $conn->prepare("DELETE FROM tareas WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $conn->close();
    }

    public function FiltrarTareas($filtros) {
        $conn = $this->obtenerConexion();
        $whereClauses = [];
        $params = [];
        foreach ($filtros as $key => $value) {
            $whereClauses[] = "$key LIKE ?";
            $params[] = $value;
        }
        $whereSql = implode(" AND ", $whereClauses);
        $stmt = $conn->prepare("SELECT * FROM tareas WHERE $whereSql");
        $stmt->bind_param(str_repeat('s', count($params)), ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        $tareas = [];
        while ($row = $result->fetch_assoc()) {
            $tareas[] = $row;
        }
        $conn->close();
        return $tareas;
    }

    public function CambiarEstadoTarea($id, $estado) {
        $conn = $this->obtenerConexion();
        $stmt = $conn->prepare("UPDATE tareas SET idEstado=? WHERE id=?");
        $stmt->bind_param("ii", $estado, $id);
        $stmt->execute();
        $conn->close();
    }

    public function ReasignarTarea($id, $empleado) {
        $conn = $this->obtenerConexion();
        $stmt = $conn->prepare("UPDATE tareas SET idEmpleado=? WHERE id=?");
        $stmt->bind_param("ii", $empleado, $id);
        $stmt->execute();
        $conn->close();
    }
    
}
?>
