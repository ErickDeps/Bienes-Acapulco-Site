<?php

// Invocar al archivo config.php una línea antes donde se utilice.

try {
    $connection = new PDO('mysql:host='.$bd_config['host'].';'.'dbname='.$bd_config['dbname'], $bd_config['user'], $bd_config['pass']);
} catch (PDOException $e) {
    die('Error de conexión: ' . $e->getMessage());
}



?>