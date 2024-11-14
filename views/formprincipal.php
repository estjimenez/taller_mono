<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tareas</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="/views/form.php">Crear Nueva Tarea</a></li>
        </ul>
    </nav>
    <h1>Listado de Tareas</h1>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Prioridad</th>
                <th>Fecha de Vencimiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            
            <?php if (isset($tasks) && is_array($tasks) && count($tasks) > 0): ?>
                <?php foreach ($tasks as $task): ?>
                    <tr class="<?php echo $task['idEstado'] == 4 ? 'impediment' : ''; ?>"> 
                        <td><?php echo $task['titulo']; ?></td>
                        <td><?php echo $task['descripcion']; ?></td>
                        <td><?php echo $task['idEstado']; ?></td>
                        <td><?php echo $task['idPrioridad']; ?></td>
                        <td><?php echo $task['fechaEstimadaFinalizacion']; ?></td>
                        <td>
                            <a href="views/form.php?id=<?php echo $task['id']; ?>">Editar</a>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                                <button type="submit" name="action" value="delete">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6">No se encontraron tareas</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
