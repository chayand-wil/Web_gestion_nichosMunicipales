<?php

  session_start();


require_once "modelos/Publicacion.php";
require_once "modelos/User.php";

class userAyudanteControlador{

     
    private $modelo;
    private $modelo2;
    
    private $currentId;
    private $titulo = "Aceptadas";
    private $filtro = 2;
    private $reportes;
    private $condicionRep = 1 ;

    private $verNichosPor =  'filtrar';
  

    private $menu = "captura" ;
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

 
    private $municipios;
    private $userSelect;
    private $allUsers;
    private $causas;
        private $municipioDef = 1;

    private $calles;
    private $avenidas;
    private $intersecciones;

    private $calleSelected;
    private $avenidaSelected;
    
    private bool $nichoSelect = false;
    private $idNichoSelect;


    // array("d", "d");
    
 
    public function __CONSTRUCT(){
        $this->modelo2 = new User;


    }
 

 
 

    public function Inicio(){
        // $this->filtrarPublications($this->filtro);

        if (isset($_SESSION['username'])) {
            $rol = $_SESSION['role']; 
                
            if($rol==2){
                // header("location:?c=admin");

                if(isset($_SESSION['menu'])){
                     $this->menu = $_SESSION['menu'] ; 
                }

                if(isset($_GET['menu'])){
                     $_SESSION['menu'] = $_GET['menu'];   
                     $this->menu = $_SESSION['menu'] ; 
                }
 
                if($this->menu == 'captura'){
                    $this->cargarDatos();
                    $this->filtrarNichos();
                }


                require_once "vista/users/ayudante/index.php"; 
                
            }else{
                
                header("location:?c=inicio");
                exit;
            }
            
        } else {
            header("location:?c=inicio");
            exit;
        }
 
    }
 




 



    public function verNichos(){
        $this->nichoSelect = true;
        $this->filtrarNichos();
        $this->menu = "captura";

        require_once "vista/users/ayudante/index.php"; 

    }



    public function seleccionarNicho(){ 
        $this->cargarDatos();
        $this->menu = "captura";

        $this->nichoSelect = false;
    
                // validacionesssss

        if(isset($_GET['id'])){
            $this->idNichoSelect = $_GET['id'];
        }
          
 
        require_once "vista/users/ayudante/index.php"; 

        

    }




 

    public function buscarNichos(){

        if(isset($_GET['menu'])){
            $this->menu = $_SESSION['menu'];
        }
        if(isset($_GET['ver'])){
            $this->nichoSelect = $_GET['ver'];
        }

 
        $this->titulo = "Ver nichos";
        $this->submenu = "nichos";
        $this->verNichosPor = "buscar";
        $this->tituloEstado = "Resultados de la busqueda";
        $this->cargarCallesAv_nichos();
        $this->filtrosNichos();

        
        $codigo= $_GET['codigo'];
        $this->losNichosFiltrados = [];
        $this->losNichosFiltrados[] = $this->modelo2->buscarNicho($codigo);
        

        require_once "vista/users/ayudante/index.php";
        

    }

    public function filtrarNichos(){

        
        if(isset($_GET['menu'])){
            $this->menu = $_SESSION['menu'];
        }
        if(isset($_GET['ver'])){
            $this->nichoSelect = $_GET['ver'];
        }
        

        $this->titulo = "Ver nichos";
        $this->submenu = "nichos";

        $this->cargarCallesAv_nichos();
        $this->filtrosNichos();
        if($this->verNichosPor == 'buscar'){
            $losNichosFiltrados = [];
            
        }else{
            $this->filtrarArrNichos();
        }
        
        require_once "vista/users/ayudante/index.php";

        // problema al seleccionar de los filtros no cargan los nichosss

    }


  
    public function crearContrato(){
        //insertar persona y ocupante
        $e = new User();
  
        $e->set_nombres1($_POST['nombreUno']);
        $e->set_nombres2($_POST['nombreDos']);
        $e->set_apellidos1($_POST['apellidoUno']);
        $e->set_apellidos2($_POST['apellidoDos']);
        
        $e->set_cui($_POST['dpi']);
        $e->setFecha($_POST['cumple']);
        $e->setDirr($_POST['dir']);
        
        $e->setMunic($_POST['munic']);

        $fechaFall = $_POST['fechaFall'];        
        $id_causa = $_POST['causa'];        
        
        $idCcupante = $this->modelo2->insertPersonaOcupante($e, $fechaFall, $id_causa);
        var_dump(">>>ocupp: " . $idCcupante); exit;

        
        //insertar responsable y contrato
        $userSelect = $_POST['userSelect'];        
        $telefono = $_POST['telefono'];        
        $mail = $_POST['mail'];      

        $estado_contrato = $_POST['estado_contrato'];       
        $nicho = $_POST['nicho'];       
        
        $this->modelo2->insertarContrato($userSelect, $telefono, $mail, $estado_contrato, $nicho);

        
        
        
        // var_dump("userID: "  . $userSelect);
        // var_dump("nicho_id: "  . $nicho);exit;

    }

    public function cargarDatos(){
        $this->municipios = $this->modelo2->darTabla("municipio");
        $this->causas = $this->modelo2->darTabla("causa_fallecimiento");
        $allUsers = $this->modelo2->darUsersCui();
        // $this->allUsers = $this->modelo2->darUsersCui();
                        // solo usuarios de tipo consulta(user)
        foreach($allUsers  as $us):
            if($us->rol == 'user'){
                $this->allUsers [] = $us ;
            }
        endforeach;
         

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







    // public function filtrar(){
    //     $this->identificarFiltros();
        
    //     $_SESSION['titulo'] = $this->titulo;

    //     require_once "vista/users/admin/index.php"; 
        
    // }
    



                                                            //ADMIN 
    // public function identificarFiltros() {
    //     $this->filtro = $_GET['filtro'];

    //     switch($this->filtro){
    //         case 1:
    //             $this->titulo = "Agregar un usuario";
    //             $this->submenu = "agregar";
    //             $this->cargarMunicipioEtc();
    //         break;
    //         case 2:
    //             $this->titulo = "Usuarios disponibles";
    //             $this->submenu = "listar";
                
    //             break;
                

    //     }

    // }    


                    //todo sobre los nihcos en el admin
    // public function identificarMenu() {
        
        
    //     $this->menu = $_SESSION['menu'];
    //     $this->filtro = $_GET['filtro'];
        
    //     switch($this->filtro){
    //         case 1:
    //             $this->titulo = "Ver nichos";
    //             $this->submenu = "nichos";
    //             $this->filtrarNichos();
    //             require_once "vista/users/admin/index.php"; 

    //         break;
    //         case 2:
    //             $this->titulo = "Solicitudes de ocupaciones";
    //             $this->submenu = "ocupaciones";
    //             require_once "vista/users/admin/index.php"; 
        
    //         break;
    //         case 3:
    //             $this->titulo = "Solicitudes de exhumaciones";
    //             $this->submenu = "exhumaciones";
    //             require_once "vista/users/admin/index.php"; 
                    
    //                 break;
                
    //     }

 

    // }

  

  
 

}