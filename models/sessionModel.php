<?php

class SessionModel {    

    public function login($connection, $usuario, $password) {
        $stmt = $connection->prepare("SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1");
        $stmt->execute([':usuario' => $usuario]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
             return [
                'id' => $user['id'],
                'nombre' => $user['nombre'],
                'usuario' => $user['usuario']
            ];
        } 


        return false;
    }

    public function register($connection, $nombre, $usuario, $email, $password, $terminos) {

        $usuarioExistente = self::validarUsuario($connection, $usuario, $email);
        if(!$usuarioExistente) {
            // Inserta un nuevo usuario a la base de datos
            $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $connection->prepare("INSERT INTO usuarios (nombre, usuario, email, password, terminos) VALUES(:nombre, :usuario, :email, :password, :terminos)");
            $stmt->execute([
                ':nombre' => $nombre,
                ':usuario' => $usuario,
                ':email' => $email,
                ':password' => $passwordHashed,
                ':terminos' => $terminos
            ]);
            return true;
        } else {
            return false;
        }
    }

    public function validarUsuario($connection, $usuario, $email) {
        $stmt = $connection->prepare("SELECT * FROM usuarios WHERE usuario = :usuario OR email = :email");
        $stmt->execute([
            ':usuario' => $usuario,
            ':email' => $email
        ]);
        $usuarioExistente = $stmt->fetch();
        return $usuarioExistente;
    }


}


?>