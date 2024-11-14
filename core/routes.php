<?php
require_once '../config/database.php';
require_once '../controllers/TareaController.php';

$db = Conectar::conexion(); 
$tareaController = new TareaController($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'crear':
            $tareaController->crearTarea($_POST);
            break;
        case 'actualizar':
            $tareaController->actualizarTarea($_POST);
            break;
        case 'eliminar':
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $tareaController->eliminarTarea($_POST['id']);
            } else {
                echo "ID de tarea no proporcionado";
            }
            break;
        default:
            echo "Acción no válida";
            break;
    }
}
?>
