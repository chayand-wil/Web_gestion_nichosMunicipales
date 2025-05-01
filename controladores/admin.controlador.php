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
    private $filtroTipo = "ninio";

    private $filtroCalle = 1;
    private $filtroAvenida = 1;

 
    private $losNichos;
    private $losNichosFiltrados;
    private $nichoEncontrado;

 
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
 
                if($this->menu == 'nichos'){
                    $this->filtrarNichos();
                }

                require_once "vista/users/admin/index.php";
                

            }else{
                
                header("location:?c=inicio");
                exit;
            }
            
        } else {
            header("location:?c=inicio");
            exit;
        }
 
    }
 
    public function buscarNichos(){
        $this->menu = $_SESSION['menu'];
        $this->titulo = "Ver nichos";
        $this->submenu = "nichos";
        $this->verNichosPor = "buscar";
        $this->tituloEstado = "Resultados de la busqueda";
        $this->cargarCallesAv_nichos();
        $this->filtrosNichos();

        
        $codigo= $_GET['codigo'];
        $this->losNichosFiltrados = [];
        $this->losNichosFiltrados[] = $this->modelo2->buscarNicho($codigo);
        

        require_once "vista/users/admin/index.php";
        

    }

    public function filtrarNichos(){
        $this->menu = $_SESSION['menu'];
        $this->titulo = "Ver nichos";
        $this->submenu = "nichos";

        $this->cargarCallesAv_nichos();
        $this->filtrosNichos();
        if($this->verNichosPor == 'buscar'){
            $losNichosFiltrados = [];
            
        }else{
            $this->filtrarArrNichos();
        }
        
        require_once "vista/users/admin/index.php";

        // problema al seleccionar de los filtros no cargan los nichosss

    }


  
    public function cargarCallesAv_nichos(){
        $this->losNichos = $this->modelo2->darNichos();

        // cargar las calles
        $this->calles = $this->modelo2->darCalles();

        //cargar las intersecciones
        $this->intersecciones = $this->modelo2->darIntersecciones();

        
    }


    public function filtrarArrNichos(){
        if($this->filtroEstado == 'todos'){

                                            // filtrar por tipo
            foreach($this->losNichos as $nicho):
                // filtrar por tipo
                if($nicho->tipo_nicho == $this->filtroTipo){
    
                        // filtrar por calle
                        if($nicho->numero_calle == $this->filtroCalle){
                            // filtrar por avenida
                            if($nicho->numero_avenida == $this->filtroAvenida){
                                $this->losNichosFiltrados[] = $nicho;
        
                            }
                        }
                    }

            endforeach;
             
            
        }else{
            foreach ($this->losNichos as $nicho):
                
                // filtrar por estado
                if($nicho->estado_nicho == $this->filtroEstado){
                
                        if($nicho->tipo_nicho == $this->filtroTipo){
                        // filtrar por tipo
                        
                        // filtrar por calle
                        if($nicho->numero_calle == $this->filtroCalle){
                            // filtrar por avenida
                            if($nicho->numero_avenida == $this->filtroAvenida){
                                $this->losNichosFiltrados[] = $nicho;
        
                            }
                        }
                    } 

                } 
    
            endforeach;
        }


    }

 

    public function filtrosNichos(){

        $filtroEstado = $_GET['estado'];
        
        if(isset($_GET['tipo'])){
            $this->filtroTipo = $_GET['tipo'] ;
        }
        if(isset($_GET['calle'])){
            $this->filtroCalle = $_GET['calle'];
        }
        
        if(isset($_GET['avenida'])){
            $this->filtroAvenida = $_GET['avenida'];
        }  
        

        switch($filtroEstado){
            case 'disponible':
                $this->tituloEstado = "Nichos Disponibles";
                $this->filtroEstado = "disponible";
            break;
            case 'ocupado':
                $this->tituloEstado = "Nichos ocupados";
                $this->filtroEstado = "ocupado";
                break;

            case 'todos':
                $this->tituloEstado = "Todos los Nichos";
                $this->filtroEstado = "todos";
                    
                break;
            case 'proceso_exumacion':
                $this->tituloEstado = "En Proceso de exhumacion";
                $this->filtroEstado = "proceso_exumacion";
                    
                break;
            case 'buscar':
                $this->verNichosPor = $filtroEstado;
                if(!($this->verNichosPor == 'filtrar')){
                    $this->tituloEstado = "Resultados de la busqueda";
                }

                break;

            default:

                break;
                
        } 


        // llenando las avenidas
        foreach($this->intersecciones as $intersec):
            if($intersec->numero_calle == $this->filtroCalle){
                $this->avenidas[] = $intersec;
            }
            
        
        endforeach;

            // calle por default
            $this->calleSelected = $this->calles[$this->filtroCalle - 1];

            // avenida por default
            $this->avenidaSelected = $this->avenidas[$this->filtroAvenida-1];
    


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
        
        
        $this->menu = $_SESSION['menu'];
        $this->filtro = $_GET['filtro'];
        
        switch($this->filtro){
            case 1:
                $this->titulo = "Ver nichos";
                $this->submenu = "nichos";
                $this->filtrarNichos();
                require_once "vista/users/admin/index.php"; 

            break;
            case 2:
                $this->titulo = "Solicitudes de ocupaciones";
                $this->submenu = "ocupaciones";
                require_once "vista/users/admin/index.php"; 
        
            break;
            case 3:
                $this->titulo = "Solicitudes de exhumaciones";
                $this->submenu = "exhumaciones";
                require_once "vista/users/admin/index.php"; 
                    
                    break;
                
        }

 

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