<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tareas</title>
    <link rel="stylesheet" href="/public//cs/style.css"> <!-- Ruta absoluta para asegurar que el CSS se cargue -->
</head>
<body>
    <h1>Lista de Tareas</h1>

    <?php if (!empty($tasks)): ?>
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Prioridad</th>
                    <th>Fecha Estimada de Finalización</th>
                    <th>Estado</th>
                    <th>Responsable</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr class="<?php echo htmlspecialchars($task['status']); ?>">
                        <td><?php echo htmlspecialchars($task['title']); ?></td>
                        <td><?php echo htmlspecialchars($task['priority']); ?></td>
                        <td><?php echo htmlspecialchars($task['estimated_end_date']); ?></td>
                        <td><?php echo htmlspecialchars($task['status']); ?></td>
                        <td><?php echo htmlspecialchars($task['assignee']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay tareas disponibles.</p>
    <?php endif; ?>
</body>
</html>
