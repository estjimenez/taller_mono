<!-- task_form.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Tarea</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <h1><?php echo isset($task) ? "Editar Tarea" : "Crear Nueva Tarea"; ?></h1>
    <form action="<?php echo isset($task) ? "../public/index.php?action=update&id=" . $task['id'] : "../public/index.php?action=create"; ?>" method="post">
        
        <label for="title">Título:</label>
        <input type="text" id="title" name="title" value="<?php echo isset($task) ? $task['title'] : ''; ?>" required>
        
        <label for="description">Descripción:</label>
        <textarea id="description" name="description" required><?php echo isset($task) ? $task['description'] : ''; ?></textarea>
        
        <label for="status">Estado:</label>
        <select id="status" name="status" required>
            <option value="pendiente" <?php echo (isset($task) && $task['status'] == 'pendiente') ? 'selected' : ''; ?>>Pendiente</option>
            <option value="en_proceso" <?php echo (isset($task) && $task['status'] == 'en_proceso') ? 'selected' : ''; ?>>En Proceso</option>
            <option value="terminada" <?php echo (isset($task) && $task['status'] == 'terminada') ? 'selected' : ''; ?>>Terminada</option>
            <option value="impedimento" <?php echo (isset($task) && $task['status'] == 'impedimento') ? 'selected' : ''; ?>>Impedimento</option>
        </select>
        
        <label for="estimated_end_date">Fecha Estimada de Finalización:</label>
        <input type="date" id="estimated_end_date" name="estimated_end_date" value="<?php echo isset($task) ? $task['estimated_end_date'] : ''; ?>" required>
        
        <label for="end_date">Fecha de Finalización:</label>
        <input type="date" id="end_date" name="end_date" value="<?php echo isset($task) ? $task['end_date'] : ''; ?>">
        
        <label for="creator">Creador:</label>
        <input type="text" id="creator" name="creator" value="<?php echo isset($task) ? $task['creator'] : ''; ?>" required>
        
        <label for="assignee">Responsable:</label>
        <select name="assignee" required>
            <option value="">Seleccione un responsable</option>
            <?php
            // Conexión a la base de datos para obtener la lista de empleados
            $conn = new mysqli("localhost", "root", "", "tareas_db");

            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            $sql = "SELECT id, nombre FROM empleados"; // Asegúrate de que la tabla 'empleados' existe en la base de datos
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Si existen empleados, los mostrará en el select
                while($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['id'] . '" ' . (isset($task) && $task['idResponsable'] == $row['id'] ? 'selected' : '') . '>' . htmlspecialchars($row['nombre']) . '</option>';
                }
            } else {
                echo '<option value="">No hay empleados disponibles</option>';
            }

            $conn->close();
            ?>
             </select>

        <label for="priority">Prioridad:</label>
        <select id="priority" name="priority" required>
            <option value="alta" <?php echo (isset($task) && $task['priority'] == 'alta') ? 'selected' : ''; ?>>Alta</option>
            <option value="media" <?php echo (isset($task) && $task['priority'] == 'media') ? 'selected' : ''; ?>>Media</option>
            <option value="baja" <?php echo (isset($task) && $task['priority'] == 'baja') ? 'selected' : ''; ?>>Baja</option>
        </select>
        
        <label for="notes">Observaciones:</label>
        <textarea id="notes" name="notes"><?php echo isset($task) ? $task['notes'] : ''; ?></textarea>
        
        <button type="submit"><?php echo isset($task) ? "Actualizar Tarea" : "Crear Tarea"; ?></button>
    </form>
</body>
</html>
