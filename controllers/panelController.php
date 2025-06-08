<?php
    
class PanelController {

    public function dashboard($connection) {
        comprobarSession(); 
        $idUsuario = $_SESSION['id'];
        require_once './models/panelModel.php';
        $model = new PanelModel();
        $usuarioActivo = ucfirst($_SESSION['nombre']);
        $propiedades = $model->obtenerPropiedadesPorUsuario($connection, $idUsuario);
        require_once 'views/admin/dashboard_view.php';
    }

    public function eliminarPropiedad($connection) {
        comprobarSession();
        $id_inmueble = $_GET['id'];
        require_once './models/panelModel.php';
        $model = new PanelModel();
        $model->eliminarPublicacion($connection, $id_inmueble);
        header("Location: " . URL_BASE . '?controller=panel&action=dashboard');
    }

    public function showCreate() {
        comprobarSession();

        require_once 'views/admin/newProperty_view.php';
    }

    public function publicarPropiedad($connection, $inmuebles_config) {
        comprobarSession();

        $categoria = $_POST['categoria'];
        $titulo = limpiarDatos($_POST['titulo']);
        $precio = $_POST['precio'];
        $ubicacion = $_POST['ubicacion'];
        $descripcion =$_POST['descripcion'];
        $recamaras = $_POST['recamaras'];
        $banios = $_POST['banios'];
        $garage = $_POST['garage'];
        $telefono = $_POST['telefono'];
        $periodo = (isset($_POST['periodo']) ? $_POST['periodo'] : '');
        $totalImagenes = count($_FILES['imagenes']['name']);
        $imagenes = $_FILES['imagenes']['tmp_name'];

        $idUsuario = $_SESSION['id'];

            // Verificamos que el archivo subido sea una foto.
        for($i = 0; $i < $totalImagenes; $i++) {
            $check = @getimagesize($imagenes[$i]);
        }
        if($check !== false) { 
            require_once './models/panelModel.php';
            $model = new PanelModel();
            $model->crearPropiedad($connection, $idUsuario, $inmuebles_config, $totalImagenes, $categoria, $titulo, $precio, $ubicacion, $descripcion, $recamaras, $banios, $garage, $telefono, $periodo);
        } else {
            echo "<script language='javascript'>alert('Hubo un error al cargar las imagenes')</script>";
        } 


        require_once 'views/admin/newProperty_view.php';
    }

    

    public function Configuration($connection) {
        comprobarSession();
        require_once './models/panelModel.php';
        $model = new PanelModel();
        $datosUsuario = $model->obtenerNombreYUsuario($connection);
        require_once 'views/admin/configuration_view.php';
    }

    public function actualizarUsuario($connection) {
        comprobarSession();
        $idUsuario = $_SESSION['id'];
        $nombre = strtolower($_POST['nombre']);
        $usuario = strtolower($_POST['usuario']);
        $email = strtolower($_POST['email']);
        $password_actual = $_POST['password_actual'];
        $nueva_password = $_POST['nueva_password'];

        require_once './models/panelModel.php';
        $model = new panelModel();
        $datosUsuario = $model->obtenerUsuarioCompleto($connection);

        // Validación de email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'El correo electrónico no es válido.';
            header("Location: " . URL_BASE . '?controller=panel&action=configuration');
            return;
        }

        if (strlen($email) > 100) {
            $_SESSION['error'] = 'El correo electrónico es demasiado largo.';
            header("Location: " . URL_BASE . '?controller=panel&action=configuration');
            return;
        }

        // Validar el dominio del correo
        $dominioEmail = substr(strrchr($email, "@"), 1);
        if (!checkdnsrr($dominioEmail, "MX")) {
            $_SESSION['error'] = 'El dominio del correo electrónico no existe.';
            header("Location: " . URL_BASE . '?controller=panel&action=configuration');
            return;
        }

        // Verificamos contraseña actual
        if (!password_verify($password_actual, $datosUsuario['password'])) {
            $_SESSION['error'] = "Contraseña actual incorrecta.";
            header("Location: " . URL_BASE . '?controller=panel&action=configuration');
            return;
        }

        // Si se escribió una nueva contraseña, la encriptamos
        if (!empty($nueva_password)) {
            $password_hash = password_hash($nueva_password, PASSWORD_DEFAULT);
        } else {
            $password_hash = $datosUsuario['password']; // mantener la actual
        }

        // Actualizamos los datos
        $model->actualizarUsuario($connection, $idUsuario, $nombre, $usuario, $email, $password_hash);

        $_SESSION['usuario'] = $usuario;
        $_SESSION['success'] = "Datos actualizados correctamente.";
        header("Location: " . URL_BASE . '?controller=panel&action=configuration');
    }

    public function eliminarCuenta($connection) {
        comprobarSession();
        $password_confirm = $_POST['password_confirm'];
        $idUsuario = $_SESSION['id'];
        require_once './models/panelModel.php';
        $model = new PanelModel();
        $datosUsuario = $model->obtenerUsuarioCompleto($connection);

        if (!password_verify($password_confirm, $datosUsuario['password'])) {
            $_SESSION['error'] = "Contraseña actual incorrecta.";
            header("Location: " . URL_BASE . '?controller=panel&action=configuration');
            return;
        }

        $model->eliminarImagenesDePublicacion($connection, $idUsuario);
        $model->eliminarPublicacionesUsuario($connection, $idUsuario);
        $model->eliminarUsuario($connection, $idUsuario);

        session_unset();
        session_destroy();
        header("Location: " . URL_BASE);
        exit;

    }



    public function logout() {
        session_start(); // Aunque esté en index, lo aseguramos aquí también por seguridad
        comprobarSession();
        $_SESSION = array(); // Vaciar el arreglo

        // Si se usa una cookie de sesión, también eliminarla
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy(); // Destruir sesión

        header('Location: ' . URL_BASE);
        exit;
    }


}    


?>