<?php  
    session_start();
    require_once './config/config.php';
    require_once './core/connection.php';
    require_once './helpers/helpers.php';
    
    $controller = $_GET['controller'] ?? 'inmueble';
    $action     = $_GET['action'] ?? 'mostrarInmuebles';
    $id_inmueble         = $_GET['id'] ?? null;

    if (!$controller) return error('Controlador no especificado');

    $controllerName = $controller . 'Controller';
    $controllerFile = 'controllers/' . $controllerName . '.php';

    if (!file_exists($controllerFile)) return error("Archivo del controlador no encontrado: $controllerFile");

    require_once $controllerFile;

    if (!class_exists($controllerName)) return error("Clase del controlador no encontrada: $controllerName");

    $controller = new $controllerName(); //Si existe la clase en el controlador -> hacemos la instancia.

    if (!$action) return error("Acción no especificada");

    if (!method_exists($controller, $action)) return error("La acción no existe");

    // Ejecutar la acción, con o sin parámetro
    if ($action === 'obtenerInmueblePorId') {
        if (!$id_inmueble) return error("ID no proporcionado");
        $controller->$action($connection, $id_inmueble, $inmuebles_config);
    } else {
        $controller->$action($connection, $inmuebles_config);
    }

    function error($msg) {
        echo "<h3>Error: $msg</h3>";
    }
    
?>