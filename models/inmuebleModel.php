<?php
    // =======> MODEL <=======
class InmuebleModel {  

    // InmuebleModel.php
    public static function obtenerTodos($connection, $inmuebles_config) {
        $inmuebles_por_pagina = $inmuebles_config['inmuebles_por_pagina'];
        $inicio = (pagina_actual() > 1) ? pagina_actual() * $inmuebles_por_pagina - $inmuebles_por_pagina : 0;

        $query = "SELECT SQL_CALC_FOUND_ROWS * FROM publicaciones LIMIT $inicio, $inmuebles_por_pagina";
        $stm = $connection->prepare($query);
        $stm->execute();
        $inmuebles = $stm->fetchAll();

        $total_query = $connection->query("SELECT FOUND_ROWS() as total");
        $total = $total_query->fetch()['total'];

        return [
            'inmuebles' => $inmuebles,
            'total' => $total
        ];
    }

    
    //Obtiene imagenes a través del id del inmueble seleccionado
    public function obtenerImagenesPorInmueble($connection, $id_inmueble) {
        $query = 'SELECT * FROM imagenes WHERE id_publicacion = :id_inmueble';
        $stm = $connection->prepare($query);
        $stm->execute([':id_inmueble' => $id_inmueble]);
        return $stm->fetchALL();
    } 

    // Compara inmuebles respecto al id
    public function buscarInmueblePorId($connection, $id, $inmuebles_config) {
        $inmuebles = self::obtenerTodos($connection, $inmuebles_config);
        foreach($inmuebles['inmuebles'] as $inmueble) {
            if($inmueble['id'] === (int)$id) {
                return $inmueble;
            }
        }
        return null; 
    } 

    // Obtiene el inmueble por el id como tal
    public function obtenerInmueblePorId($connection, $id_inmueble) {
        $query = 'SELECT p.*, u.email 
              FROM publicaciones p 
              JOIN usuarios u ON p.idusuario = u.id 
              WHERE p.id = :id_inmueble 
              LIMIT 1';
        $stm = $connection->prepare($query);
        $stm->execute([':id_inmueble' => $id_inmueble]);
        $result = $stm->fetch();
        return $result;
    }


    public function buscarInmueblesFormulario($connection, $filtros) {
        $condiciones = [];
        $parametros = [];

        if (!empty($filtros['busqueda'])) {
            $condiciones[] = "(titulo LIKE :busqueda OR descripcion LIKE :busqueda OR ubicacion LIKE :busqueda)";
            $parametros[':busqueda'] = "%" . $filtros['busqueda'] . "%";
        }

        if (!empty($filtros['categoria']) && $filtros['categoria'] !== 'default') {
            $condiciones[] = "categoria = :categoria";
            $parametros[':categoria'] = $filtros['categoria'];
        }

        if (!empty($filtros['recamaras']) && $filtros['recamaras'] !== 'default') {
            if ($filtros['recamaras'] === '3+') {
                $condiciones[] = "recamaras > 3";
            } else {
                $condiciones[] = "recamaras = :recamaras";
                $parametros[':recamaras'] = $filtros['recamaras'];
            }
        }

        if (!empty($filtros['banios']) && $filtros['banios'] !== 'default') {
            if ($filtros['banios'] === '3+') {
                $condiciones[] = "banios > 3";
            } else {
                $condiciones[] = "banios = :banios";
                $parametros[':banios'] = $filtros['banios'];
            }
        }

        if (!empty($filtros['garage']) && $filtros['garage'] !== 'default') {
            $condiciones[] = "garage = :garage";
            $parametros[':garage'] = $filtros['garage'];
        }

        // $condiciones[] = "fecha > DATE_SUB(NOW(), INTERVAL 5 DAY)";

        $where = implode(" AND ", $condiciones);
        $query = "SELECT * FROM publicaciones WHERE $where ORDER BY fecha DESC";

        $stmt = $connection->prepare($query);
        $stmt->execute($parametros);
        return $stmt->fetchAll();
    }


}


?>