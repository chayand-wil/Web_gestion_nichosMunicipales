<?php
  session_start();


require_once "modelos/User.php";
require_once "modelos/Session.php";


class user_comunControlador{
    // private $titulo = "Aceptadas";
    private $modelo;
    private $modelo2;
    private $modelo3;
    private $currentId;
    // private $filtroReporte = "Sin revision";
    // private $filtro = 2;
    private $pubs;
    private $condicionRep = 1 ;
    private $id_user;
    private $asiste = false;
    private $vista = "home";    //mis_eventos
    private $fechaProx;   
    private $filtroPublico = "carga";   
    private $filtroCategoria = "nofilter";   


    private $modo = "carga";   

 




    public function __CONSTRUCT(){
        $this->modelo = new User;
        $this->modelo2 = new Session;
        $this->modelo3 = new Session;
    }

 

    public function Inicio(){

        
        if (isset($_SESSION['username'])) {
            if($_SESSION['role']==4){
                $this->id_user = $_SESSION['id'];
                // var_dump("iduserr: " . $this->id_user);
                // exit;
                
                if (isset($_GET['vista'])) {
                    $this->vista = $_GET['vista'];
                }
                
                if (isset($_SESSION['ftipo'])) {
                    $this->filtroPublico = $_SESSION['ftipo'];
                }

                if (isset($_SESSION['fcategoria'])) {
                    $this->filtroCategoria = $_SESSION['fcategoria'];
                    //  unset($_SESSION['fcategoria']); // no mostrar nuevamente 
                }

                
                if (isset($_GET['ftipo'])) {
                    $_SESSION['ftipo'] = $_GET['ftipo'];
                    $this->filtroPublico = $_SESSION['ftipo'];
                }

                if (isset($_GET['fcategoria'])) {
                    $_SESSION['fcategoria'] = $_GET['fcategoria'];
                    $this->filtroCategoria = $_SESSION['fcategoria'];
                }



                require_once "vista/users/user/index.php"; 


                
                // header("location:?c=admin");
            }else{
                header("location:?c=inicio");
            }
            
        } else {
            header("location:?c=inicio");
        }
        exit(); 
 
        
        // $this->filtrarPublications($this->filtro);


        // require_once "vista/users/admin/revision.php"; 
        // exit(); 
        // require_once "vista/encabezado.php";
        // require_once "vista/topsJugadores/index.php";
        // require_once "vista/pie.php";
    }
  
    

 


 


 






 
     


 
 
    

 
 


    





 
    




}