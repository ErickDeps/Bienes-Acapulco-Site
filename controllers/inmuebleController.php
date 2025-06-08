<?php

    require_once __DIR__ . '/../vendor/autoload.php';
    use Dotenv\Dotenv;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();



// =======> CONTROLLER <=======
    class InmuebleController { 


        // Muestra los inmuebles en la pagina principal
        function mostrarInmuebles($connection, $inmuebles_config) {
            require_once './models/inmuebleModel.php';
            $inmuebleModel = new InmuebleModel();

            // El método devuelve un array con 'inmuebles' y 'total'
            $resultado = $inmuebleModel->obtenerTodos($connection, $inmuebles_config);
            $inmuebles = $resultado['inmuebles'];
            $total_inmuebles = $resultado['total'];

            // Agrega las imágenes a cada inmueble
            foreach ($inmuebles as &$inmueble) {
                $imagenes = $inmuebleModel->obtenerImagenesPorInmueble($connection, $inmueble['id']);
                $inmueble['imagenes'] = $imagenes;
            }
            unset($inmueble); 

            require_once 'views/index_view.php';
        }


        // Obtiene los datos de la pagina single.php
        function obtenerInmueblePorId($connection, $id_inmueble, $inmuebles_config) {
            $key = "inmueble_{$id_inmueble}_visitado"; 

            if (!isset($_SESSION[$key])) {
                $update = $connection->prepare("UPDATE publicaciones SET visitas = visitas + 1 WHERE id = :id");
                $update->execute([':id' => $id_inmueble]);
                $_SESSION[$key] = true;
            }
            require_once './models/inmuebleModel.php';
            $inmuebleModel = new InmuebleModel();
            if($inmuebleModel->buscarInmueblePorId($connection, $id_inmueble, $inmuebles_config)) {
                $inmueble = $inmuebleModel->obtenerInmueblePorId($connection, $id_inmueble);
                $imagenes = $inmuebleModel->obtenerImagenesPorInmueble($connection, $id_inmueble);
                require_once 'views/single_view.php';
            } else {
                header('Location: ' . URL_BASE);
            }
        }


        function mostrarImagenesPorInmueble($connection, $id_inmueble) {
            require './models/inmuebleModel.php';
            $inmuebleModel = new InmuebleModel();
            $imagenes = $inmuebleModel->obtenerImagenesPorInmueble($connection, $id_inmueble);
            require_once 'views/single_view.php';
        }

        // Filtro de busqueda 
        public function mostrarBusquedaInmuebles($connection, $id_inmueble) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $filtros = [
                    'busqueda' => $_GET['busqueda'] ?? '',
                    'categoria' => $_GET['categoria'] ?? 'default',
                    'recamaras' => $_GET['recamaras'] ?? 'default',
                    'banios' => $_GET['banios'] ?? 'default',
                    'garage' => $_GET['garage'] ?? 'default',
                ];

                // Al menos uno debe ser diferente a default o estar lleno
                $hayFiltros = !empty($filtros['busqueda']) ||
                            $filtros['categoria'] !== 'default' ||
                            $filtros['recamaras'] !== 'default' ||
                            $filtros['banios'] !== 'default' ||
                            $filtros['garage'] !== 'default';

                if ($hayFiltros) {
                    require './models/inmuebleModel.php';
                    $inmuebleModel = new InmuebleModel();
                    $resultados = $inmuebleModel->buscarInmueblesFormulario($connection, $filtros);
                    foreach($resultados as &$resultado) {
                        $imagenes = $inmuebleModel->obtenerImagenesPorInmueble($connection, $resultado['id']);
                        $resultado['imagenes'] = $imagenes;
                    }
                    unset($resultado);
                    $titulo = empty($resultados)
                        ? 'No se encontraron publicaciones'
                        : 'Resultados de la búsqueda:';

                    require_once 'views/search_view.php';
                } else {
                    header('Location: index.php');
                    exit;
                }
            }
        }

        // Formulario de contacto SINGLE
        public function contactarAnunciante($connection, $inmuebles_config = null) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nombre   = htmlspecialchars($_POST['name']);
                $email    = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
                $telefono = htmlspecialchars($_POST['phone']);
                $mensaje  = htmlspecialchars($_POST['message']);
                $whatsapp = isset($_POST['whatsapp']) ? 'Sí' : 'No';

                if ($email && !empty($nombre) && !empty($mensaje)) {
                    if (!isset($_GET['id'])) {
                        echo "<p style='color: red;'>ID de propiedad no especificado.</p>";
                        return;
                    }

                    $id_inmueble = (int)$_GET['id'];

                    require_once './models/inmuebleModel.php';
                    $inmuebleModel = new InmuebleModel();
                    $inmueble = $inmuebleModel->obtenerInmueblePorId($connection, $id_inmueble);

                    if (!$inmueble || !isset($inmueble['email'])) {
                        echo "<p style='color: red;'>No se encontró el anunciante.</p>";
                        return;
                    }

                    $destinatario = $inmueble['email'];
                    $asunto = "Interesado en la propiedad ID {$inmueble['id']}";

                    $cuerpo = "
                        Nombre: $nombre
                        Correo: $email
                        Teléfono: $telefono
                        Contactar por WhatsApp: $whatsapp

                        Mensaje:
                        $mensaje
                    ";

                    $mail = new PHPMailer(true);
                    try {
                        // Configuración SMTP
                        $mail->isSMTP();
                        $mail->Host = $_ENV['MAIL_HOST'];
                        $mail->SMTPAuth = true;
                        $mail->Username = $_ENV['MAIL_USERNAME'];
                        $mail->Password = $_ENV['MAIL_PASSWORD'];
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = $_ENV['MAIL_PORT'];

                        $mail->setFrom($_ENV['MAIL_FROM'], $_ENV['MAIL_FROM_NAME']);

                        $mail->addReplyTo($email, $nombre); // El visitante
                        $mail->addAddress($destinatario);   // El anunciante

                        // Contenido
                        $mail->isHTML(false);
                        $mail->Subject = $asunto;
                        $mail->Body    = $cuerpo;

                        $mail->send();
                        echo "<p style='color: green;'>Mensaje enviado correctamente al anunciante.</p>";
                    } catch (Exception $e) {
                        echo "<p style='color: red;'>Error al enviar el mensaje: {$mail->ErrorInfo}</p>";
                    }

                } else {
                    echo "<p style='color: red;'>Complete todos los campos requeridos.</p>";
                }
            } else {
                echo "<p style='color: red;'>Acceso no permitido.</p>";
            }
        }



    }
    


?>