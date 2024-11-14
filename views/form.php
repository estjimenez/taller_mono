<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <form action="http://localhost/TALLER_MONO/core/routes.php" method="post">
        <input type="hidden" name="action" value="crear">

        <label>Ingrese Titulo :</label>
        <input type="text" name="titulo" id="titulo" required><br>

        <label>Descripcion:</label><br>
        <input type="text" name="descripcion" id="descripcion" required><br>

        <label>Fecha estimada de finalización:</label><br>
        <input type="date" name="fechaEstimada" id="fechaEstimada" required><br>

        <label>Fecha de finalización:</label><br>
        <input type="date" name="fechaFinal" id="fechaFinal" required><br>

        <label>Creador de tarea:</label><br>
        <input type="text" name="crearTarea" id="crearTarea" required><br>

        <label>Observaciones:</label><br>
        <input type="text" name="observaciones" id="observaciones" required><br>

        <label>Empleado:</label><br>
        <input type="text" name="empleado" id="empleado" required><br>

        <label>Estado:</label><br>
        <input type="text" name="estado" id="estado" required><br>

        <label>Prioridad:</label><br>
        <input type="text" name="prioridad" id="prioridad" required><br>
        
        <button type="submit">Crear</button>
    </form>
</body>
</html>
