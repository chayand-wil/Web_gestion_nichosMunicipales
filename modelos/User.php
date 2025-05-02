<?php
 
class User{
    private $pdo;     //mi objeto 

    private $calle_avenida = 0 ; //varchar
    private $nombres1;  //varchar
    private $nombres2;  //varchar
    private $apellidos1;  //varchar
    private $apellidos2;  //varchar
    private $cui;  //varchar
    private $jur_nombre;  //varchar
    private $passwords;  //int (id del equipo)
    private $idRol;  //int (id del equipo)
    private $id;  //int (id del equipo)
    private $mail;  //int (id del equipo)
    private $jur_correo;  //int (id del equipo)
    private $fecha;    
    private $munic;    


    public $lastInsertId;  
    
    public function __CONSTRUCT(){
        $this->pdo = database::conectar();        
    }
 

    public function setpasswords(String $id){
        $this->passwords = $id;
    }
    public function getpasswords(): ?string{ 
        return $this->passwords;
    }
    
    public function setNombre(string $nombre){
        $this->jur_nombre = $nombre;
    }
    public function getNombre(): ?string{ 
        return $this->jur_nombre;
    }
    
    public function setIdRol(int $int){
            $this->idRol = $int;
    }
    public function getIdRol(): ?int{ 
        return $this->idRol;
    }
    //id
    public function set_id(int $int){
            $this->id = $int;
    }
    public function get_id(): ?int{ 
        return $this->id;
    }

    
    //cui
    public function set_cui(int $cui){
            $this->cui = $cui;
    }
    public function get_cui(): ?int{ 
        return $this->cui;
    }
    //nombre++++++++++
    public function set_nombres1(string $nombres){
            $this->nombres1 = $nombres;
    }
    public function get_nombres1(): ?string{ 
        return $this->nombres1;
    }

    public function set_nombres2(string $nombres){
            $this->nombres2 = $nombres;
    }
    public function get_nombres2(): ?string{ 
        return $this->nombres2;
    }
    
    //apellidos
    public function set_apellidos1(string $apellidos){
            $this->apellidos1 = $apellidos;
    }
    public function get_apellidos1(): ?string{ 
        return $this->apellidos1;
    }
    public function set_apellidos2(string $apellidos){
            $this->apellidos2 = $apellidos;
    }
    public function get_apellidos2(): ?string{ 
        return $this->apellidos2;
    }




        //calle_avenida
    public function setDirr(String $calle_avenida){
        $this->calle_avenida = $calle_avenida;
    }
    public function getDirr(): ?String{ 
        return $this->calle_avenida;
    }
    public function setMunic(int $calle_avenida){
        $this->munic = $calle_avenida;
    }
    public function getMunic(): ?int{ 
        return $this->munic;
    }
    
    
        //estado
    public function set_mail(string $estado){
            $this->mail = $estado;
    }
    public function get_mail(): ?string{ 
        return $this->mail;
    }
        
 


    public function setJur_correo(string $nombre){
        $this->jur_correo = $nombre;
    }
    public function getJur_correo(): ?string{ 
        return $this->jur_correo;
    }
    




    public function setFecha($fecha){
        $this->fecha = new DateTime($fecha);
    }
 
    public function getFecha() { 
        return $this->fecha->format('Y-m-d');
    }
    






    public function darCalles() {

        try{
            // retornar las calles
            $sql = "SELECT * FROM calle;";
            
            $stmt = $this->pdo->prepare($sql);
            // $stmt->bindParam(':id_user', $idUser, PDO::PARAM_INT);
            $stmt->execute();
            // var_dump(">>>"); exit;
            
            return $stmt->fetchAll(PDO::FETCH_OBJ);
            

        }catch(PDOException $e){
            echo "Error al insertar publicacion: " . $e->getMessage();
            exit;
            // header("location:?c=user");
        }
 
    }
    public function darTabla($tabla) {
        try{
            // retornar las calles
            $sql = "SELECT * FROM " .  $tabla . ";" ;
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        }catch(PDOException $e){
            echo "Error al dar tabla: " . $e->getMessage();
            exit;
            // header("location:?c=user");
        }
    }



    public function insertarContrato($userSelect, $telefono, $mail, $estado_contrato, $nicho ) {
        // $userSelect = $_GET['userSelect'];        
        // $telefono = $_GET['telefono'];        
        // $mail = $_GET['mail'];      

        // $estado_contrato = $_GET['estado_contrato'];       
        // $nicho = $_GET['nicho'];      // Preparar la llamada al procedimiento almacenado
 
    try {

        // Preparar la llamada al procedimiento almacenado
        $sql = "CALL sp_insertar_responsable_contrato(
            :id_user, 
            :telefono, 
            :correo_contacto,
            :id_nicho,
            :id_estado_contrato,
            :fecha_inicio_contrato,
            :fecha_finalizacion,
            :id_ocupante
        )";
        
        
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':id_user', $user->get_nombres1(), PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $user->get_nombres2(), PDO::PARAM_STR);
        $stmt->bindParam(':correo_contacto', $user->get_apellidos1(), PDO::PARAM_STR);
        $stmt->bindParam(':id_nicho', $user->get_apellidos2(), PDO::PARAM_STR);
        
        $stmt->bindParam(':id_estado_contrato', $user->get_cui(), PDO::PARAM_INT);
        $stmt->bindParam(':fecha_inicio_contrato', $user->getFecha(), PDO::PARAM_STR);
        $stmt->bindParam(':fecha_finalizacion', $user->getDirr(), PDO::PARAM_STR);
        $stmt->bindParam(':id_ocupante', $user->getMunic(), PDO::PARAM_STR);
        
        $stmt->bindParam(':fechaFall', $fechaFall, PDO::PARAM_STR);
        $stmt->bindParam(':idCausa', $id_causa, PDO::PARAM_STR);

        // Ejecutar la consulta
        $stmt->execute();
        $lastInsertId = $this->pdo->lastInsertId();

        return $lastInsertId;

  
    } catch (PDOException $e) {
        //   var_dump("tryy: " . $e->getMessage()); exit;
        // echo "Error al insertar persona y ocupante: " . $e->getMessage();

        return $e;

        exit;
    }






    }




    public function darUsersCui() {
        try{
            // retornar las calles
            $sql = "SELECT 
                u.id AS id_usuario,
                u.mail,
                u.password,
                
                r.rol AS rol,
                
                p.id AS id_persona,
                p.primer_nombre,
                p.segundo_nombre,
                p.primer_apellido,
                p.segundo_apellido,
                p.dpi,
                p.fecha_cumpleanos,
                p.direccion,
                p.id_municipio

            FROM 
                user u
            JOIN 
                rol_user r ON u.id_rol = r.id
            JOIN 
                persona p ON u.id_persona = p.id;
                                                        " ;
            

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        }catch(PDOException $e){
            echo "Error al dar tabla: " . $e->getMessage();
            exit;
            // header("location:?c=user");
        }
    }



    public function buscarNicho($id) {
        //consulta que devuelva 
        try{
            // retornar las calles
            $sql = "
            SELECT * 
            FROM nicho 
            WHERE id = :idd;
            ";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':idd', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);

        }catch(PDOException $e){
            echo "Error al insertar publicacion: " . $e->getMessage();
            exit;
            // header("location:?c=user");
        }
 
    }

    public function darNichos() {
        //consulta que devuelva 
 
        try{
            // retornar las calles
            $sql = "
                SELECT 
                    n.*, 
                    tn.tipo AS tipo_nicho,
                    c.numero AS numero_calle,
                    a.numero AS numero_avenida,
                    j.estado AS estado_nicho
                FROM 
                    nicho n
                LEFT JOIN 
                    tipo_nicho tn ON n.id_tipo_nicho = tn.id
                LEFT JOIN 
                    estado_nicho j ON n.id_estado_nicho = j.id
                LEFT JOIN 
                    ubicacion_nicho u ON n.id_ubicacion = u.id
                LEFT JOIN 
                    calle c ON u.id_calle = c.id
                LEFT JOIN 
                    avenida a ON u.id_avenida = a.id;

            
            ";
            
            $stmt = $this->pdo->prepare($sql);
            // $stmt->bindParam(':id_user', $idUser, PDO::PARAM_INT);
            $stmt->execute();
            // var_dump(">>>"); exit;
            
            return $stmt->fetchAll(PDO::FETCH_OBJ);
            

        }catch(PDOException $e){
            echo "Error al insertar publicacion: " . $e->getMessage();
            exit;
            // header("location:?c=user");
        }
 
    }
    



    // public function darAvenidas($calle) {
    //     // retornar las avenidas
    //     $numero = array(4,5,6);
        
    //         //retornar las avenidas
    //     return $numero;
    // }

    public function darIntersecciones() {
        // retornar las avenidas
        // consulta o vista que retorne el numero de calle y nombre de calle, numero de avenida y nombre avenida.
         $sql = "SELECT 
                i.id AS ubicacion_nicho,
                c.numero AS numero_calle, 
                c.nombre AS nombre_calle, 
                a.numero AS numero_avenida, 
                a.nombre AS nombre_avenida
            FROM 
                ubicacion_nicho i
            JOIN 
                calle c ON i.id_calle = c.id
            JOIN 
                avenida a ON i.id_avenida = a.id;
            ";


        $stmt = $this->pdo->prepare($sql);
        // $stmt->bindParam(':id_user', $idUser, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

 
    public function verNichos() {
        //retornar todos los nichos
        

    }














    


    public function insertUsuario($user) {

        try {

            $sql = "CALL insertar_persona_y_usuario(
                :pNombre, :sNombre, :pApe, :sApe,
                :cui, :fecha, :dirr, :munic,
                :mail, :pasw, :rol
            );
            ";
     
            $stmt = $this->pdo->prepare($sql);
  
            
            $passwordRaw = $user->getpasswords();
            
            $stmt->bindParam(':pNombre', $user->get_nombres1(), PDO::PARAM_STR);
            $stmt->bindParam(':sNombre', $user->get_nombres2(), PDO::PARAM_STR);
            $stmt->bindParam(':pApe', $user->get_apellidos1(), PDO::PARAM_STR);
            $stmt->bindParam(':sApe', $user->get_apellidos2(), PDO::PARAM_STR);
            
            $stmt->bindParam(':cui', $user->get_cui(), PDO::PARAM_INT);
            $stmt->bindParam(':fecha', $user->getFecha(), PDO::PARAM_STR);
            $stmt->bindParam(':dirr', $user->getDirr(), PDO::PARAM_STR);
            $stmt->bindParam(':munic', $user->getMunic(), PDO::PARAM_STR);
            
            $stmt->bindParam(':mail', $user->get_mail(), PDO::PARAM_STR);
            
            
            $hashedPassword = password_hash($passwordRaw, PASSWORD_DEFAULT);
            $stmt->bindParam(':pasw', $hashedPassword, PDO::PARAM_STR);
            
            $stmt->bindParam(':rol', $user->getIdRol(), PDO::PARAM_INT);
            // Ejecutar la consulta
            $stmt->execute();

            // $lastInsertId = $this->pdo->lastInsertId();


            return "yes";
      
        } catch (PDOException $e) {
            //   var_dump("tryy: " . $e->getMessage()); exit;

            return $e;
            echo "Error al insertar usuario: " . $e->getMessage();
            exit;
        }
    }



    public function insertPersonaOcupante($user, $fechaFall, $id_causa) {  
        try {

            // Preparar la llamada al procedimiento almacenado
            $sql = "CALL insertar_persona_y_ocupante(
                :pNombre, :sNombre, :pApe, :sApe,
                :cui, :fecha, :dirr, :munic,
                :fechaFall, :idCausa
            );";
            
            
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':pNombre', $user->get_nombres1(), PDO::PARAM_STR);
            $stmt->bindParam(':sNombre', $user->get_nombres2(), PDO::PARAM_STR);
            $stmt->bindParam(':pApe', $user->get_apellidos1(), PDO::PARAM_STR);
            $stmt->bindParam(':sApe', $user->get_apellidos2(), PDO::PARAM_STR);
            
            $stmt->bindParam(':cui', $user->get_cui(), PDO::PARAM_INT);
            $stmt->bindParam(':fecha', $user->getFecha(), PDO::PARAM_STR);
            $stmt->bindParam(':dirr', $user->getDirr(), PDO::PARAM_STR);
            $stmt->bindParam(':munic', $user->getMunic(), PDO::PARAM_STR);
            
            $stmt->bindParam(':fechaFall', $fechaFall, PDO::PARAM_STR);
            $stmt->bindParam(':idCausa', $id_causa, PDO::PARAM_STR);

            // Ejecutar la consulta
            $stmt->execute();
            $lastInsertId = $this->pdo->lastInsertId();
 
            return $lastInsertId;
 
      
        } catch (PDOException $e) {
            //   var_dump("tryy: " . $e->getMessage()); exit;
            // echo "Error al insertar persona y ocupante: " . $e->getMessage();

            return $e;

            exit;
        }
    }

    


  


    
public function viewUsers(){         
                                                
    try{
        // $stmt = $this->pdo->prepare("SELECT * FROM vista_publicacion_completa v
        // WHERE NOT EXISTS (
        //     SELECT 1
        //     FROM reporte r
        //     WHERE r.id_publicacion = v.id_publicacion
        //     AND r.id_reportador = :id_user
        // )")
        $stmt = $this->pdo->prepare("SELECT 
                    u.mail, 
                    u.id, 
                    u.password, 
                    r.rol AS Rol
                FROM user u
                JOIN rol_user r ON u.id_rol = r.id;
        ");
                             

                            //  var_dump(">>>>");
                            //  exit;

        $stmt->execute();




        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }catch(Exception $e){
        die($e->getMessage());
    }
 }  
 


 


public function delete_user($id_user){
    try{
        $sql = "DELETE FROM user
                where id = :id_user
                ;
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        
        // Ejecutar la consulta
        $stmt->execute(); 

    }catch(PDOException $e){
        echo "Error al actualizar eliminar user " . $e->getMessage();
        exit;
        // header("location:?c=user");
    }


}




 
 
 public function insertarReporte($publicacionId, $idMotivo, $idReportador){

    try{
        $sql = "INSERT INTO reporte (id_publicacion, id_motivo, id_reportador, fecha_report) 
                VALUES (:publicacionId, :idMotivo, :idReportador, NOW())";
            
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':publicacionId', $publicacionId);
        $stmt->bindParam(':idMotivo', $idMotivo);
        $stmt->bindParam(':idReportador', $idReportador);
         


        // Ejecutar la consulta
        $stmt->execute();
 
        // echo "Evento insertado correctamente!";
    }catch(PDOException $e){
        echo "Error al insertar reporte: " . $e->getMessage();
        exit;
        // header("location:?c=user");
    }
}

 
 

public function insertarMotivo($motivo){

    try{
        $sql = "CALL insertar_motivo(:motivo, @id_generado);
            ";
            
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':motivo', $motivo);
         
        // Ejecutar la consulta
        $stmt->execute();
    // Recuperar el id generado
         $result = $this->pdo->query("SELECT @id_generado AS id_motivo")->fetch(PDO::FETCH_ASSOC);
         
         return $result['id_motivo'];

        // echo "Evento insertado correctamente!";
    }catch(PDOException $e){
        echo "Error al insertar Motivo: " . $e->getMessage();
        exit;
        // header("location:?c=user");
    }
  
}



 

 






    



}