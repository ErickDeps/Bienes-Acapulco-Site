<?php
    
    class Pruebas {


        // Obtiene el ultimo id insertado en la bd publicaciones para ser insertado en la bd imagenes 
        public function obtenerUltimoIdPublicacion($connection) { 
            $id = $connection->prepare("SELECT id from publicaciones ORDER BY id DESC LIMIT 1");
            $id->execute();
            $id = $id->fetch();
            $id = $id[0];
            return $id;
        }


        public function crearPropiedadOriginal($connection, $idUsuario, $inmuebles_config, $totalImagenes, $categoria, $titulo, $precio, $ubicacion, $descripcion, $recamaras, $banios, $garage, $telefono, $periodo) {
        $stmt = $connection->prepare(
            "INSERT INTO publicaciones 
            (idusuario, categoria, titulo, precio, ubicacion, descripcion, recamaras, banios, garage, telefono, periodo) 
            VALUES 
            (:idusuario, :categoria, :titulo, :precio, :ubicacion, :descripcion, :recamaras, :banios, :garage, :telefono, :periodo)"
        );
        $stmt->execute(array(
            ':idusuario' => $idUsuario,
            ':categoria' => $categoria,
            ':titulo' => $titulo,
            ':precio' => $precio,
            ':ubicacion' => $ubicacion,
            ':descripcion' => $descripcion,
            ':recamaras' => $recamaras,
            ':banios' => $banios,
            ':garage' => $garage,
            ':telefono' => $telefono,
            ':periodo' => $periodo
        ));
        $id = $connection->lastInsertId();

        // $id = self::obtenerUltimoIdPublicacion($connection);

        for($i = 0; $i < $totalImagenes; $i++) {
            $nombreImagen = $_FILES['imagenes']['name'][$i];
            date_default_timezone_set('America/Denver');
            $nombreFinal = date('d-m-y') . '-' . date('h-i-s') . '-' . $nombreImagen;
            $rutaDestino = './assets/' . $inmuebles_config['carpeta_destino'] . $nombreFinal;
            $stmt = $connection->prepare("INSERT INTO imagenes (id_publicacion, imagenes) VALUES (:id_publicacion, :imagenes)");
            $stmt->execute(array(
                ':id_publicacion' => $id,
                ':imagenes' => $nombreFinal
            ));

            move_uploaded_file($_FILES['imagenes']['tmp_name'][$i], $rutaDestino);
        }
    }



// ======> Cómo subir multiples imagenes correctamente

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imagenes = $_FILES['imagenes'];
    $totalImagenes = count($imagenes['name']);
    $errores = [];

    for ($i = 0; $i < $totalImagenes; $i++) {
        $nombre = $imagenes['name'][$i];
        $tmp = $imagenes['tmp_name'][$i];

        // Validar si el archivo es una imagen real
        $info = @getimagesize($tmp);

        if ($info === false) {
            $errores[] = "El archivo '$nombre' no es una imagen válida.";
            continue;
        }

        // Opcional: Validar tipo MIME permitido
        $mimePermitidos = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($info['mime'], $mimePermitidos)) {
            $errores[] = "El archivo '$nombre' tiene un tipo no permitido ({$info['mime']}).";
            continue;
        }

        // Crear nombre único
        $nombreUnico = date('YmdHis') . '-' . uniqid() . '-' . basename($nombre);
        $rutaDestino = './uploads/' . $nombreUnico;

        // Mover la imagen al servidor
        if (move_uploaded_file($tmp, $rutaDestino)) {
            // Si quieres guardar en la BD:
            /*
            $stmt = $conexion->prepare("INSERT INTO imagenes (id_publicacion, imagenes) VALUES (:id, :img)");
            $stmt->execute([':id' => $idPublicacion, ':img' => $nombreUnico]);
            */
        } else {
            $errores[] = "No se pudo subir la imagen '$nombre'.";
        }
    }

    // Mostrar resultados
    if (empty($errores)) {
        echo "Todas las imágenes se subieron correctamente.";
    } else {
        foreach ($errores as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}







    }



?>