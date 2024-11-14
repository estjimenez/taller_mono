<?php
class TareaController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
        require_once __DIR__ . '/../models/Consultas.php';
    }

    public function index() {
        $consultasModel = new ConsultasModel();
        $tasks = $consultasModel->ObtenerTareas(); 
        if (empty($tasks)) {
            echo 'No tasks available';  
        } else {
            require_once('/xampp/htdocs/taller_mono/views/formprincipal.php');
        }
    }

    public function crearTarea($data) {
        $tareaModel = new ConsultasModel($this->db);
        $tareaModel->InsertarTareas(
            $data['titulo'], 
            $data['descripcion'], 
            $data['fechaEstimada'], 
            $data['fechaFinal'], 
            $data['crearTarea'], 
            $data['observaciones'], 
            $data['empleado'], 
            $data['estado'], 
            $data['prioridad']
        );
        $this->index();
    }

    public function actualizarTarea($data) {
        $tareaModel = new ConsultasModel($this->db);
        $tareaModel->ModificarTarea(
            $data['id'], 
            $data['titulo'], 
            $data['descripcion'], 
            $data['fechaEstimada'], 
            $data['fechaFinal'], 
            $data['observaciones'], 
            $data['empleado'], 
            $data['estado'], 
            $data['prioridad']
        );
        $this->index();
    }
    public function eliminarTarea($id) {
        $tareaModel = new ConsultasModel($this->db);
        $tareaModel->EliminarTarea($id);
        $this->index();
    }
    public function FiltrarTareas($filtros) {
        $tareaModel = new ConsultasModel($this->db);
        $tareas = $tareaModel->FiltrarTareas($filtros);
        require_once "views/listaTareas.php";
    }
    public function CambiarEstado($id, $estado) {
        $tareaModel = new ConsultasModel($this->db);
        $tareaModel->CambiarEstadoTarea($id, $estado);
        $this->index();
    }
    public function ReasignarTarea($id, $empleado) {
        $tareaModel = new ConsultasModel($this->db);
        $tareaModel->ReasignarTarea($id, $empleado);
        $this->index();
    }
}
?>
