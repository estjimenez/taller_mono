<?php

class Conectar
{
    public static function conexion()
    {
        $conexion = new mysqli("localhost", "root", "", "tareas_db");
        return $conexion;
    }
}