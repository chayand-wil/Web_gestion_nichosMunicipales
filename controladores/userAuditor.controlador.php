<?php

// use Random\Engine\PcgOneseq128XslRr64;

  session_start();
 
// require_once "modelos/Publicacion.php";


class userAuditorControlador{ 
    private $modelo;
    private $filtro = "Aceptada";


    public function __CONSTRUCT(){ 
    }


    public function Inicio(){ 
        // var_dump("dasfadsf");
        // exit;            

        if (isset($_SESSION['username'])) {
            if($_SESSION['role']==3){
                require_once "vista/users/auditor/index.php"; 
            }else{
                header("location:?c=inicio");
            }
            
        } else {
            header("location:?c=inicio");
        }
        exit(); 



    } 



   public function insertPublication(){
 
       $imgDef = "https://www.shutterstock.com/image-vector/default-ui-image-placeholder-wireframes-600nw-1037719192.jpg"; 
    
       $estado = 1;
       $idUser = $_POST['id_user'];
       //identificar si el user tiene permisos automaticos y set a el estado de la nueva publicacion
       $idPermiso = $this->modelo->getPermisosUser($idUser);
       
       if($idPermiso == 0){        
           $estado = 1;        
        }else{  
            $estado = 2;        //significa estado aceptado
        }
        
        $e = new Publicacion();
        
        $e->setId($idUser);
        $e->setEstado($estado);
        $e->setTipo($_POST['tipo']);
        $e->setLugar($_POST['lugar']);
        $e->setFecha_hora($_POST['fecha-hora']);
        $e->setDescripcion($_POST['descripcion']); 

        $e->setPath($_POST['website']);  
     
    


       
       
       
        $cantidad=$_POST['cantidad-asistentes'];
         
        if(isset($cantidad)){
            $e->setCantidad($cantidad);
        }else{
            $cantidad = 0;
            $e->setCantidad($cantidad);
        }
        $e->setTitulo($_POST['titulo']);
        $e->setCat($_POST['categoria']);

   
        $this->modelo->insertPublication2($e);
 
               // echo "Error en controlador insertarPub..: " . $e->getMessage();
            // header("location:?c=alls");

        
            header("location:?c=userPublicator");
            exit;
            
     }
   
    public function mostrarFormulario(){
        //verificar si el usuario no esta baneado
        require_once "vista/users/publicator/index.php"; 
        
    }
    
    
    






    




    
    
    










    


}