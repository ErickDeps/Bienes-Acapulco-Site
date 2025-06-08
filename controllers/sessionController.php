<?php
    
class SessionController {  


    public function showLogin() {
        if (isset($_SESSION['usuario'])) {
            header('Location: ' . URL_BASE . '?controller=panel&action=dashboard');
        }

        require_once './views/login_view.php';
    }

    public function showRegister() {
        if (isset($_SESSION['usuario'])) {
            header('Location: ' . URL_BASE . '?controller=panel&action=dashboard');
        }

        require_once './views/register_view.php';
    }


    public function login($connection) {
        $usuario = limpiarDatos((strtolower($_POST['usuario'])));
        $password = $_POST['password'];

        require_once './models/sessionModel.php';
        $model = new SessionModel();
        $user = $model->login($connection, $usuario, $password);

        if ($user) {
            // Iniciar sesión
            // session_start();
            $_SESSION['id'] = $user['id'];
            $_SESSION['nombre'] = $user['nombre'];
            $_SESSION['usuario'] = $user['usuario'];

            // Redirigir al panel
            header("Location: ?controller=panel&action=dashboard");
            exit();
        } else {
            $error = "Usuario o contraseña incorrectos";
            require 'views/login_view.php'; // Reenviar a login con error
        }
    }

    public function register($connection) {
    $nombre = limpiarDatos((strtolower($_POST['nombre']))) ?? '';
    $usuario = limpiarDatos((strtolower($_POST['usuario']))) ?? '';
    $email = limpiarDatos((strtolower($_POST['email']))) ?? '';
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';
    $terminos = $_POST['terminos'] ?? '';

    if ($nombre == '' || $usuario == '' || $email == '' || $password == '' || $password2 == '' || $terminos == '') {
        $error = 'Por favor rellena todos los campos';
        require 'views/register_view.php';
        return;
    }

    // Validación de nombre
    if (!preg_match('/^[a-zA-Z\s]{2,50}$/', $nombre)) {
        $error = 'El nombre solo debe contener letras y espacios, entre 2 y 50 caracteres.';
        unset($nombre);
        require 'views/register_view.php';
        return;
    }

    // Validación de usuario
    if (!preg_match('/^[a-zA-Z0-9_]{4,20}$/', $usuario)) {
        $error = 'El usuario solo debe contener letras, números o guion bajo y tener entre 4 y 20 caracteres.';
        unset($usuario);
        require 'views/register_view.php';
        return;
    }

    // Validación de email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'El correo electrónico no es válido.';
        unset($email);
        require 'views/register_view.php';
        return;
    }

    if (strlen($email) > 100) {
        $error = 'El correo electrónico es demasiado largo.';
        require 'views/register_view.php';
        return;
    }

    // Validar el dominio del correo
    $dominioEmail = substr(strrchr($email, "@"), 1);
    if (!checkdnsrr($dominioEmail, "MX")) {
        $error = 'El dominio del correo electrónico no existe.';
        require 'views/register_view.php';
        return;
    }

    // Validación de contraseña
    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)) {
        $error = 'La contraseña debe tener al menos 8 caracteres, incluyendo letras y números.';
        require 'views/register_view.php';
        return; 
    }

    if ($password != $password2) {
        $error = 'Las contraseñas no son iguales';
        require 'views/register_view.php';
        return;
    }

    // Si todo OK, sigue con el registro:
    require_once './models/sessionModel.php';
    $model = new SessionModel();
    $nuevoUsuario = $model->register($connection, $nombre, $usuario, $email, $password, $terminos);

    if (!$nuevoUsuario) {
        $error = "El usuario ya existe";
        require 'views/register_view.php';
        return;
    }

    $success = 'Usuario registrado con éxito, redirigiendo...';
    $nombre = $usuario = $email = $password = $password2 = $terminos = '';
    require 'views/register_view.php';
}



}


?>