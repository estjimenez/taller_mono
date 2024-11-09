<?php
// index.php

// Requerir el controlador de tareas
require_once '../controllers/TaskController.php';

// Crear una instancia del controlador
$taskController = new TaskController();

// Obtener todas las tareas
$tasks = $taskController->listTasks();

// Asegurarse de que la variable $tasks sea un array, aunque esté vacío
if ($tasks === null) {
    $tasks = [];  // Si no hay tareas, asignar un array vacío
}
require_once '../views/task_list.php';

?>
