<?php

  session_start();


require_once "modelos/Publicacion.php";
require_once "modelos/User.php";

class adminControlador{

     
    private $modelo;
    private $modelo2;
    
    private $currentId;
    private $titulo = "Aceptadas";
    private $filtro = 2;
    private $reportes;
    private $condicionRep = 1 ;

    private $verNichosPor =  'filtrar';
  

    private $menu = "usuarios" ;
    private $submenu = "listar" ;
     
    private $userss;
    
    private $tituloEstado = "Todos los Nichos";
    private $filtroEstado = "todos";




    private $losNichos;
    private $losNichosFiltrados;

    private $calles;
    private $avenidas;
    private $intersecciones;
    private $calleSelected;
    private $avenidaSelected;
    // array("d", "d");
    




    public function __CONSTRUCT(){
        $this->modelo2 = new User;


    }
 

 
 

    public function Inicio(){
        // $this->filtrarPublications($this->filtro);

        if (isset($_SESSION['username'])) {
            $rol = $_SESSION['role']; 
                
            if($rol==1){
                // header("location:?c=admin");

                if(isset($_SESSION['menu'])){
                     $this->menu = $_SESSION['menu'] ; 
                }

                if(isset($_GET['menu'])){
                     $_SESSION['menu'] = $_GET['menu'];   
                     $this->menu = $_SESSION['menu'] ; 
                }
                


                $this->cargarCallesAv();
                // calles por default en  


                
                require_once "vista/users/admin/index.php";
                // $this->userss = $this->modelo2->viewUsers();
             

            }else{
                // require_once "vista/users/admin/index.php"; 
                header("location:?c=inicio");
                exit;
            }
            
        } else {
            header("location:?c=inicio");
            exit;
        }
 
    }
 
 
 



    public function cargarCallesAv(){
        // cargar las calles
        // $this->calles = $this->modelo2->darCalles();
        // // calle por default
        // $this->calleSelected = $this->calles[0];
        // //cargar las intersecciones
        // $this->intersecciones = $this->modelo2->darIntersecciones();
        
        // //llenando las avenidas
        // foreach($this->intersecciones as $intersec):
        //     if($intersec->calle == $this->calleSelected){
        //         $this->avenidas[] = $intersec->avenida;
        //     }
            
        // endforeach;
        // // avenida por default
        // $this->avenidaSelected = $this->avenidas[0];
 

    }


    public function filtrarArrNichos(){
        if($this->filtroEstado == "todos"){
            //ver todos los nichos
            $this->losNichosFiltrados = $this->losNichos;
        }else{
            foreach ($this->losNichos as $nicho):
                // filtrar por estado
                if($nicho->estado == $this->filtroEstado){
                    
                    // filtrar por calle
                    if($nicho->no_calle == $this->calleSelected){
                        // filtrar por avenida
                        if($nicho->no_ave == $this->avenidaSelected){
                            $this->losNichosFiltrados[] = $nicho;
    
                        }
                    }
                } 
    
            endforeach;
        }

    }


    public function filtrarNicho(){
        $tipoFiltro = $_GET['filtro'];
        


         switch($tipoFiltro){
            case 'disponible':
                $this->tituloEstado = "Nichos Disponibles";
                $this->filtroEstado = "disponible";
            break;
            case 'ocupado':
                $this->tituloEstado = "Nichos ocupados";
                $this->filtroEstado = "ocupado";
                break;
            case 'historico':
                $this->tituloEstado = "Nichos historicos";
                $this->filtroEstado = "historico";
                break;

            case 'todos':
                $this->tituloEstado = "Todos los Nichos";
                $this->filtroEstado = "todos";
                    
                break;
            default:
                $this->verNichosPor = $tipoFiltro;
   
                if(!($this->verNichosPor == 'filtrar')){
                    $this->tituloEstado = "Resultados de la busqueda";
                }

                break;

        }
 
        // traer los nichos
        // $this->losNichos = $this->modelo2->verNichos();
        $this->identificarMenu();
 

        // recorrer los nichos para llenar losNichosFiltrados
        $this->filtrarArrNichos();         


        require_once "vista/users/admin/index.php";
 
    
    }






    public function filtrar(){
        $this->identificarFiltros();
        
        $_SESSION['titulo'] = $this->titulo;

        require_once "vista/users/admin/index.php"; 
        
    }
    

    public function eliminarUserC(){ 
 
        $this->identificarFiltros();
        $id_user = $_GET['id_user'];
        
        $this->modelo2->delete_user($id_user);


        require_once "vista/users/admin/index.php"; 
    }




    public function identificarFiltros() {
        $this->filtro = $_GET['filtro'];

        switch($this->filtro){
            case 1:
                $this->titulo = "Agregar un usuario";
                $this->submenu = "agregar";
            break;
            case 2:
                $this->titulo = "Usuarios disponibles";
                $this->submenu = "listar";
                
                break;
                

        }

    }
                    //todo sobre los nihcos en el admin
    public function identificarMenu() {
        $this->cargarCallesAv();
        // calles por default en  
        $this->calleSelected = $this->calles[0];
        $this->avenidaSelected = $this->avenidas[0];

        $this->menu = $_SESSION['menu'];
        $this->filtro = $_GET['filtro'];

        switch($this->filtro){
            case 1:
                $this->titulo = "Ver nichos";
                $this->submenu = "nichos";

            break;
            case 2:
                $this->titulo = "Solicitudes de ocupaciones";
                $this->submenu = "ocupaciones";
                
                break;
            case 3:
                $this->titulo = "Solicitudes de exhumaciones";
                $this->submenu = "exhumaciones";
                
                break;
                
        }


        $_SESSION['titulo'] = $this->titulo;

        // var_d    ump("menu " . $this->menu);
        // var_dump("submenu " . $this->submenu);
        // var_dump("titulo " . $this->titulo);

        // exit;

        require_once "vista/users/admin/index.php"; 

    }


 
    public function mostrarPub() {
        $this->titulo = $_SESSION['titulo'] ;
        // Verificar si se recibe el parámetro 'id'
        if (isset($_GET['id'])) {
            $this->currentId = $_GET['id'];
            switch($this->titulo){
                case "Reportadas": 
                    require_once "vista/users/admin/reportadas.php";
                    break;
                    case "Pendientes": 
                        require_once "vista/users/admin/pendientes.php";
                    break;
                    case "Aceptadas": 
                        require_once "vista/users/admin/pendientes.php";
                    break;
            } 

            // $id = $_GET['id'];
            // var_dump("id: ".$id);
            // exit;
            // Ahora puedes usar el valor de $id en tu lógica
        } else {
            var_dump("No se recibio el id");
            exit;
        }
    }


 

 

}