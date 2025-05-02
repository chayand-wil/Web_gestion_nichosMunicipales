    <?php


    require_once "modelos/User.php";

    session_start();    

class RegistroControlador{
    private $user;
    private $municipios;
    private $municipioDef = 1;


    public function __CONSTRUCT(){
        $this->user = new User();
    }

    public function Inicio(){
        if (isset($_SESSION['username'])) {
                header("location:?c=inicio");
        } else {
            $this->cargarMunicipioEtc();
            require_once "vista/inicioS/registro.php";
        }
        exit();

    }
 
    public function cargarMunicipioEtc(){
        $this->municipios = $this->user->darTabla("municipio");

    }



    public function insertarUser(){ 
  
        $e = new User();
        $rol = $_POST['rol'];
        
        
        $e->set_nombres1($_POST['nombreUno']);
        $e->set_nombres2($_POST['nombreDos']);
        $e->set_apellidos1($_POST['apellidoUno']);
        $e->set_apellidos2($_POST['apellidoDos']);
        
        $e->set_cui($_POST['dpi']);
        $e->setFecha($_POST['cumple']);
        $e->setDirr($_POST['dir']);
        
        $e->setMunic($_POST['munic']);

        $e->set_mail($_POST['mail']);
        $e->setpasswords($_POST['password']);

        $e->setIdRol($rol);

        
        
        $lastInsertId = $this->user->insertUsuario($e);
        
    
        if($lastInsertId instanceof PDOException){   
            //     // mensaje_registro error
                $_SESSION['mensaje_registro_error'] = "Error al registrar - la informacion ya ha sido registrada ";            
                
                if(isset($_SESSION['username'])) {
                    header("location:?c=admin&a=filtrar&filtro=1");
                }else{
                    header("location:?c=inicio");
                }
                // header("location:?c=admin&a=filtrar&filtro=1");
                exit;
        }else{
                
                // mensaje_registro exitoso
                $_SESSION['mensaje_registro_succes'] = "Se ha registrado un nuevo usuario ";
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
