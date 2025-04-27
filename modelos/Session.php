<?php

class Session {
    private $pdo; // Mi objeto de base de datos
    private $id ; // int 
    private $id_usuario ; // int 
    private $fecha; // string (fecha)
    private $hora_inicio; // string (hora)

    public function __CONSTRUCT() {
        $this->pdo = database::conectar();
    } 

    // Getter y Setter para 'id_usuario'
    public function set_id(int $id) {
        $this->id = $id;
    }

    public function get_id(): ?int {
        return $this->id;
    }
        // Getter y Setter para 'id_usuario'
    public function set_id_usuario(int $id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function get_id_usuario(): ?int {
        return $this->id_usuario;
    }


    // Getter y Setter para 'fecha'
    public function set_fecha(string $fecha) {
        $this->fecha = $fecha;
    }

    public function get_fecha(): ?string {
        return $this->fecha;
    }

    // Getter y Setter para 'hora_inicio'
    public function set_hora_inicio(string $hora_inicio) {
        $this->hora_inicio = $hora_inicio;
    }

    public function get_hora_inicio(): ?string {
        return $this->hora_inicio;
    }



    public function insertSesion_db($session) { 
        try {
            // $sql = "INSERT INTO usuario (id_rol, user, password) VALUES (:id_rol, :user, :password)";

            $sql = "INSERT INTO sesion (id_usuario, fecha, hora_inicio)
                     VALUES (:id_user, NOW(), :hora_inicio)";
 
 
            $stmt = $this->pdo->prepare($sql);

            
             // Vinculando los parámetros 
            $stmt->bindParam(':id_user', $session->get_id_usuario(), PDO::PARAM_STR);
            $stmt->bindParam(':hora_inicio', $session->get_hora_inicio(), PDO::PARAM_STR);
            
            // $stmt->bindParam(':fecha', $session->get_fecha, PDO::PARAM_STR);
            // Ejecutar la consulta
            $stmt->execute();
            $lastInsertId = $this->pdo->lastInsertId();

            return $lastInsertId;
      

        } catch (PDOException $e) {
            echo "Error al insertar usuario: " . $e->getMessage();
            exit;
        }


    }
    
    public function insertIteracion_db($session, $entrada, $hora_inicio ) { 
        
        $id_user = $_SESSION['id'];
        try {

            $sql = "INSERT INTO emulacion (id_sesion, tipoEntrada, fecha, hora_inicio, id_usuario)
            VALUES (:id, :entrada, NOW(), :hora_inicio, :id_user);
                     ";

            $stmt = $this->pdo->prepare($sql);
            
            // Vinculando los parámetros 
            $stmt->bindParam(':id', $session, PDO::PARAM_STR);
            $stmt->bindParam(':entrada', $entrada, PDO::PARAM_STR);
            $stmt->bindParam(':hora_inicio', $hora_inicio, PDO::PARAM_STR);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_STR);
            
            
            $stmt->execute();
            
            $lastInsertId = $this->pdo->lastInsertId();
            
            return $lastInsertId;
            

        } catch (PDOException $e) {
            echo "Error al insertar usuario: " . $e->getMessage();
            exit;
        }


    }
    
    
    public function updateIteracion_db($session, $entrada, $hora_fin ) { 
        

        try {

            $sql = "INSERT INTO emulacion (id_sesion, tipoEntrada, fecha, hora_inicio)
            VALUES (:id, :entrada, NOW(), :hora_inicio);
                     ";

            $stmt = $this->pdo->prepare($sql);
            
            // Vinculando los parámetros 
            $stmt->bindParam(':id', $session, PDO::PARAM_STR);
            $stmt->bindParam(':entrada', $entrada, PDO::PARAM_STR);
            $stmt->bindParam(':hora_inicio', $hora_inicio, PDO::PARAM_STR);
            
            
            $stmt->execute();
            
            $lastInsertId = $this->pdo->lastInsertId();
            
            return $lastInsertId;
            

        } catch (PDOException $e) {
            echo "Error al insertar usuario: " . $e->getMessage();
            exit;
        }


    }   
    
     





    public function viewIteraciones(){         
 
         $idd =  $_SESSION['id'];                 
        
        try{ 
            $stmt = $this->pdo->prepare(" 
            SELECT * 
            FROM emulacion
            WHERE id_usuario = :idd;
            ");
            

            $stmt->bindParam(':idd', $idd, PDO::PARAM_INT);
            
            $stmt->execute(); 

            return $stmt->fetchAll(PDO::FETCH_OBJ);
    
        }catch(Exception $e){
            die($e->getMessage());
        }
     } 

    
    public function viewSesiones(){         
 
         $idd =  $_SESSION['id'];                 
        
        try{ 
            $stmt = $this->pdo->prepare(" 
            SELECT * 
            FROM sesion
            WHERE id_usuario = :idd;
            ");
            
            
            $stmt->bindParam(':idd', $idd, PDO::PARAM_INT);
            
            $stmt->execute(); 

            return $stmt->fetchAll(PDO::FETCH_OBJ);
    
        }catch(Exception $e){
            die($e->getMessage());
        }
     }  
     
     
     public function viewIds_users(){         
 
         $idd =  $_SESSION['id'];                 
        
        try{ 
            $stmt = $this->pdo->prepare(" 
            SELECT * 
            FROM sesion
            WHERE id_usuario = :idd;
            ");
            
            
            $stmt->bindParam(':idd', $idd, PDO::PARAM_INT);
            
            $stmt->execute(); 

            
            return $stmt->fetchAll(PDO::FETCH_OBJ);
    
        }catch(Exception $e){
            die($e->getMessage());
        }
     }  












     public function viewIteraciones2($idd){         
 
   
       try{ 
           $stmt = $this->pdo->prepare(" 
           SELECT * 
           FROM emulacion
           WHERE id_usuario = :idd;
           ");
           

           $stmt->bindParam(':idd', $idd, PDO::PARAM_INT);
           
           $stmt->execute(); 

           return $stmt->fetchAll(PDO::FETCH_OBJ);
   
       }catch(Exception $e){
           die($e->getMessage());
       }
    } 

   
   public function viewSesiones2($idd){         

        $idd =  $_SESSION['id'];                 
       
       try{ 
           $stmt = $this->pdo->prepare(" 
           SELECT * 
           FROM sesion
           WHERE id_usuario = :idd;
           ");
           
           
           $stmt->bindParam(':idd', $idd, PDO::PARAM_INT);
           
           $stmt->execute(); 

           return $stmt->fetchAll(PDO::FETCH_OBJ);
   
       }catch(Exception $e){
           die($e->getMessage());
       }
    }  







}


