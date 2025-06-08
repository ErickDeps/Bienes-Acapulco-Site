<?php


    function pagina_actual() { 
        return $_GET['p'] ?? 1;
    }

    function numero_paginas($total, $inmuebles_por_pagina) {
        return ceil($total / $inmuebles_por_pagina);
    }

    function fecha($fecha) {
        $timestamp = strtotime($fecha);
        $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $dia = date('d', $timestamp); // Extrae el dia
        $mes = date('m', $timestamp) - 1; // Extrae el mes
        $year = date('Y', $timestamp); // Extrae el año
    
        $fecha = "$dia de " . $meses[$mes] . " del $year"; // Concatena todo
        return $fecha;
    }

    function limpiarDatos($datos) {
        $datos = trim($datos);
        $datos = stripslashes($datos);
        return $datos;
    }

    function comprobarSession() {
     if (session_status() === PHP_SESSION_NONE) {
        session_start();  // Asegura que la sesión esté iniciada
     }

     if (!isset($_SESSION['usuario'])) {
        header('Location: ' . URL_BASE);
        exit;  // Siempre usa exit o die después de header Location para que no siga ejecutándose código
     }
}


?>