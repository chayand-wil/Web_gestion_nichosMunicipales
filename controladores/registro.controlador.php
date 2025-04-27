<?php


require_once "modelos/User.php";

session_start();    

class RegistroControlador{
    private $user;
    
    public function __CONSTRUCT(){
        $this->user = new User();
    }

    public function Inicio(){
        if (isset($_SESSION['username'])) {
                header("location:?c=inicio");
        } else {
            require_once "vista/inicioS/registro.php";
        }
        exit();


    }
 


    public function insertarUser(){ 
 
        $e = new User();
        $rol = $_POST['rol'];
        $e->set_cui($_POST['cui']);
        
        $e->set_nombres($_POST['nombres']);
        $e->set_apellidos($_POST['apellidos']);
     
        $e->setNombre($_POST['username']);
        $e->setpasswords($_POST['password']);


        $e->setIdRol($rol);
        
        $e->set_estado($_POST['estado']);
    
        $lastInsertId = $this->user->insertUsuario($e);
        if($lastInsertId instanceof PDOException){   
        //     // mensaje_registro error
            $_SESSION['mensaje_registro'] = "Error al registrar - la informacion ya ha sido registrada ";            
            header("location:?c=admin&a=filtrar&filtro=1");
            exit;
        }else{
            // mensaje_registro exitoso
            $_SESSION['mensaje_registro'] = "Se ha registrado un nuevo usuario ";
            header("location:?c=inicio");
            exit;
        }
     
 
                                //inicio de sesion automatico despues de un registro exitoso
        // $_SESSION['username'] = $e->getNombre();
        // $_SESSION['role'] = $e->getIdRol();
        // $_SESSION['id'] = $lastInsertId;
        
        // require_once "vista/users/admin/agregar_user.php";

        // require_once "vista/users/admin/agregar_user.php";

        // exit;


     }

 


 


}
