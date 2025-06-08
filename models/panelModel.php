<?php 

class PanelModel {

    // Formulario de crear publicacion
    public function crearPropiedad($connection, $idUsuario, $inmuebles_config, $totalImagenes, $categoria, $titulo, $precio, $ubicacion, $descripcion, $recamaras, $banios, $garage, $telefono, $periodo) {
            try {

                $stmt = $connection->prepare(
                    "INSERT INTO publicaciones 
                    (idusuario, categoria, titulo, precio, ubicacion, descripcion, recamaras, banios, garage, telefono, periodo) 
                    VALUES 
                    (:idusuario, :categoria, :titulo, :precio, :ubicacion, :descripcion, :recamaras, :banios, :garage, :telefono, :periodo)"
                );
                $stmt->execute([
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
                ]);

                $id = $connection->lastInsertId();

                for ($i = 0; $i < $totalImagenes; $i++) {
                    if ($_FILES['imagenes']['error'][$i] === UPLOAD_ERR_OK) {
                        $nombreOriginal = basename($_FILES['imagenes']['name'][$i]);
                        $nombreFinal = uniqid('img_', true) . '_' . $nombreOriginal;
                        $rutaDestino = './assets/' . $inmuebles_config['carpeta_destino'] . $nombreFinal;

                        $stmt = $connection->prepare("INSERT INTO imagenes (id_publicacion, imagenes) VALUES (:id_publicacion, :imagenes)");
                        $stmt->execute([
                            ':id_publicacion' => $id,
                            ':imagenes' => $nombreFinal
                        ]);

                        move_uploaded_file($_FILES['imagenes']['tmp_name'][$i], $rutaDestino);
                    }
                }

            } catch (PDOException $e) {
                error_log("Error al crear propiedad: " . $e->getMessage());
            }
        }

    public function obtenerNombreYUsuario($connection) {
        if(isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
            $stmt = $connection->prepare("SELECT nombre, usuario, email FROM usuarios WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $datosUsuario = $stmt->fetch();
            return $datosUsuario;
        }

    }

    public function obtenerUsuarioCompleto($connection) {
        if(isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
            $stmt = $connection->prepare("SELECT * FROM usuarios WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $datosUsuario = $stmt->fetch();
            return $datosUsuario;
        }
    }

    public function actualizarUsuario($connection, $id, $nombre, $usuario, $email, $password) {
        $stmt = $connection->prepare("UPDATE usuarios SET nombre = :nombre, usuario = :usuario, email = :email, password = :password WHERE id = :id");
        $stmt->execute([
            ':nombre' => $nombre,
            ':usuario' => $usuario,
            ':email' => $email,
            ':password' => $password,
            ':id' => $id
        ]);
    }
    // ========== >> INICIO DEL BLOQUE DE ELIMINACION DE CUENTA  
    public function eliminarImagenesDePublicacion($connection, $idUsuario) {
        $publicaciones = self::obtenerPropiedadesPorUsuario($connection, $idUsuario);
        $idPublicaciones  = [];
        foreach($publicaciones as $publicacion) {
            $idPublicaciones[] = $publicacion['id'];
        }
        
        $imagenesTotales = [];

        foreach($idPublicaciones as $idPublicacion) {
            $stmt = $connection->prepare("SELECT imagenes FROM imagenes WHERE id_publicacion = :id_publicacion");
            $stmt->execute([':id_publicacion' => $idPublicacion]);
            $imagenes = $stmt->fetchALL();

            // Acumular todas las imágenes
            foreach ($imagenes as $imagen) {
                $imagenesTotales[] = $imagen;
            }
        }
        
        foreach($imagenesTotales as $imagen) {
            $imagenABorrar = './assets/uploads/' . $imagen['imagenes'];
            if (file_exists($imagenABorrar)) {
                unlink($imagenABorrar);
            }
        }

        foreach($idPublicaciones as $idPublicacion) {
            $stmt = $connection->prepare("DELETE FROM imagenes WHERE id_publicacion = :id_publicacion");
            $stmt->execute([':id_publicacion' => $idPublicacion]);
        }
    }

    public function eliminarPublicacionesUsuario($connection, $idUsuario) {
        $stmt = $connection->prepare("DELETE FROM publicaciones WHERE idusuario = :idusuario");
        $stmt->execute([':idusuario' => $idUsuario]);
    }

    public function eliminarUsuario($connection, $idUsuario) {
        $stmt = $connection->prepare("DELETE FROM usuarios WHERE id = :id");
        $stmt->execute([':id' => $idUsuario]);
    }

    // ========== >> FIN DEL BLOQUE DE ELIMINACION DE CUENTA  


    // Obtener las publicaciones por usuario
    public function obtenerPropiedadesPorUsuario($connection ,$idUsuario) {
        $query = "
            SELECT *,
                CASE
                    WHEN fecha >= (NOW() - INTERVAL 3 DAY) THEN 'Activa'
                    ELSE 'Inactiva'
                END AS estado
            FROM publicaciones
            WHERE idusuario = :idusuario
            ORDER BY fecha DESC
        ";
        $stmt = $connection->prepare($query);
        $stmt->execute([':idusuario' => $idUsuario]);
        $publicacionesPorUsuario = $stmt->fetchALL();
        return $publicacionesPorUsuario;   
    }

    // Eliminar la publicacion desde la tabla del dashboard
    public function eliminarPublicacion($connection, $idPublicacion) {
    try {
        $stmt = $connection->prepare('SELECT * FROM imagenes WHERE id_publicacion = :id_publicacion');
        $stmt->execute([':id_publicacion' => $idPublicacion]);
        $imagenes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Eliminar archivos físicos
        foreach ($imagenes as $imagen) {
            $rutaImagen = './assets/uploads/' . $imagen['imagenes'];
            if (file_exists($rutaImagen)) {
                if (!unlink($rutaImagen)) {
                    error_log("No se pudo eliminar la imagen: $rutaImagen");
                }
            } else {
                error_log("Archivo no encontrado: $rutaImagen");
            }
        } 

        // Eliminar registros de imágenes
        $stmt = $connection->prepare("DELETE FROM imagenes WHERE id_publicacion = :id_publicacion");
        $stmt->execute([':id_publicacion' => $idPublicacion]);

        // Eliminar publicación
        $stmt = $connection->prepare("DELETE FROM publicaciones WHERE id = :id_publicacion");
        $stmt->execute([':id_publicacion' => $idPublicacion]);

    } catch (PDOException $e) {
        error_log("Error al eliminar publicación: " . $e->getMessage());
    }
}


    

    

}



?>