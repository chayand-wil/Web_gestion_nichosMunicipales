<?php
 

 class Login_svc {
     
    private $pdo;

    function __construct() {
        $this->pdo = database::conectar();       
    }

    public function validateLogin($username, $password) {
        // Preparar la consulta solo con el username
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM usuario
            WHERE username = :username;
        ");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    
        // Ejecutar la consulta
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // Usar FETCH_ASSOC para acceder por nombre de columna
    
        // Verificar si se encontró el usuario y si la contraseña es válida
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Login exitoso
        } else {
            return false; // Usuario no encontrado o contraseña incorrecta
        }
    }

    





    public function insertUsuario($id_rol, $user, $password) {
        try {
            $sql = "INSERT INTO usuario (id_rol, user, password) VALUES (:id_rol, :user, :password)";
            $stmt = $this->pdo->prepare($sql);
            
            // Vinculando los parámetros
            $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
            $stmt->bindParam(':user', $user, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            
            // Ejecutar la consulta
            $stmt->execute();
    
            echo "Usuario insertado correctamente!";
        } catch (PDOException $e) {
            echo "Error al insertar usuario: " . $e->getMessage();
        }
    }









}










?>
