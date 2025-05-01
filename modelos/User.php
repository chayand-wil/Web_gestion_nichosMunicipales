<?php
 
class User{
    private $pdo;     //mi objeto 

    private $calle_avenida = 0 ; //varchar
    private $nombres;  //varchar
    private $apellidos;  //varchar
    private $cui;  //varchar
    private $jur_nombre;  //varchar
    private $passwords;  //int (id del equipo)
    private $idRol;  //int (id del equipo)
    private $id;  //int (id del equipo)
    private $estado;  //int (id del equipo)
    private $jur_correo;  //int (id del equipo)
    
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
    //nombre
    public function set_nombres(string $nombres){
            $this->nombres = $nombres;
    }
    public function get_nombres(): ?string{ 
        return $this->nombres;
    }
    //apellidos
    public function set_apellidos(string $apellidos){
            $this->apellidos = $apellidos;
    }
    public function get_apellidos(): ?string{ 
        return $this->apellidos;
    }
        //calle_avenida
    public function set_calle_avenida(int $calle_avenida){
        $this->calle_avenida = $calle_avenida;
    }
    public function get_calle_avenida(): ?int{ 
        return $this->calle_avenida;
    }
    
    
        //estado
    public function set_estado(string $estado){
            $this->estado = $estado;
    }
    public function get_estado(): ?string{ 
        return $this->estado;
    }
        
 


    public function setJur_correo(string $nombre){
        $this->jur_correo = $nombre;
    }
    public function getJur_correo(): ?string{ 
        return $this->jur_correo;
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
            // $sql = "INSERT INTO usuario (id_rol, user, password) VALUES (:id_rol, :user, :password)";

            $sql = "INSERT INTO usuario (id_cui, username, password, nombres, apellidos, id_rol, id_estado) 
            VALUES (:cui, :user, :password, :nombres, :apellidos,  :id_rol, :id_estado)";
     
            $stmt = $this->pdo->prepare($sql);
             

            // Vinculando los parámetros
            $stmt->bindParam(':cui', $user->get_cui(), PDO::PARAM_INT);
            $stmt->bindParam(':user', $user->getNombre(), PDO::PARAM_STR);

            // $stmt->bindParam(':password', $user->getpasswords(), PDO::PARAM_STR);

            $passwordRaw = $user->getpasswords();
            $hashedPassword = password_hash($passwordRaw, PASSWORD_DEFAULT);
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);


            $stmt->bindParam(':nombres', $user->get_nombres(), PDO::PARAM_STR);
            $stmt->bindParam(':apellidos', $user->get_apellidos(), PDO::PARAM_STR);
            // $stmt->bindParam(':calle_avenida', $user->get_calle_avenida(), PDO::PARAM_STR);
            $stmt->bindParam(':id_rol', $user->getIdRol(), PDO::PARAM_INT);
            $stmt->bindParam(':id_estado', $user->get_estado(), PDO::PARAM_INT);
            
            
            // Ejecutar la consulta
            $stmt->execute();
            $lastInsertId = $this->pdo->lastInsertId();

            return $lastInsertId;
      
        } catch (PDOException $e) {
            return $e;
            echo "Error al insertar usuario: " . $e->getMessage();
            exit;
        }
    }

    


 
    
    
    public function insertarAsistencia($idUser, $idPub){     
            try{
                $sql = " CALL insertarAsistencia(:idUser, :idPub);
                ";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':idUser', $idUser);
                $stmt->bindParam(':idPub', $idPub);
                
                // Ejecutar la consulta
                $stmt->execute();
        
                // header("location:?c=user");
        
                // echo "Evento insertado correctamente!";
            }catch(PDOException $e){
                echo "Error al insertar publicacion: " . $e->getMessage();
                exit;
                // header("location:?c=user");
            }
        
        

        
    }   


    public function verificarAsistencia($idUser, $idPub){     
        try {
            $sql = "SELECT EXISTS (
                        SELECT 1
                        FROM asistencia
                        WHERE id_usuario = :id_usuario AND id_publicacion = :id_publicacion
                    ) AS es_asistente";
        
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_usuario', $idUser, PDO::PARAM_INT);
            $stmt->bindParam(':id_publicacion', $idPub, PDO::PARAM_INT);
        
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
            return (bool)$resultado['es_asistente']; // Retorna true o false
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }   

    public function retirarAsistencia($idUser, $idPub){     
        try {
            $sql = "CALL retirar_asistencia(:id_user, :id_publicacion)";
    
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_user', $idUser, PDO::PARAM_INT);
            $stmt->bindParam(':id_publicacion', $idPub, PDO::PARAM_INT);
    
            $stmt->execute();
            // return true; // Éxito
        } catch (PDOException $e) {
            echo "Error al retirar asistencia: " . $e->getMessage();
            return false;
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
        $sql = "DELETE FROM usuario
                where id_cui =:id_user
                ;
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        
        // Ejecutar la consulta
        $stmt->execute();

        // header("location:?c=user");

        // echo "Evento insertado correctamente!";
    }catch(PDOException $e){
        echo "Error al actualizar Publicaciones(AceptarRechazar): " . $e->getMessage();
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



public function insertarReporte_user($publicacionId, $idMotivo, $idReportador){


    try{
        $sql = "INSERT INTO reporte_pub (id_user, id_motivo, id_reportador, fecha_report) 
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





public function obtenerEventosAsistente($idUser) {
 
    try {
        $sql = "SELECT 
                    p.id_publicacion,
                    p.titulo,
                    p.imgdir,
                    p.lugar,
                    p.fecha_hora,
                    p.descripcion,
                    p.cantidad_asistentes,
                    c.nombre_categoria AS categoria,
                    t.descripcion_publico AS tipo_publico,
                    e.nombre_estado AS estado
                FROM
                    asistencia a
                JOIN 
                    publicacion p ON a.id_publicacion = p.id_publicacion
                JOIN 
                    categorias c ON p.id_cat = c.id_categoria
                JOIN 
                    tipo t ON p.id_tipo = t.id_tipo
                JOIN 
                    estado e ON p.id_estado = e.id_estado
                WHERE 
                    a.id_usuario = :id_user
                ORDER BY 
                    ABS(TIMESTAMPDIFF(SECOND, NOW(), p.fecha_hora)) ASC;
                ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_user', $idUser, PDO::PARAM_INT);
        $stmt->execute();
        
        // return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve un array de eventos
        return $stmt->fetchAll(PDO::FETCH_OBJ);

        
    } catch (PDOException $e) {
        echo "Error al obtener eventos: " . $e->getMessage();
        return [];
    }
}



public function eventoMasProximo($idUser) {
 
    try {
        $sql = "SELECT 
                    p.id_publicacion,
                    p.titulo,
                    p.lugar,
                    p.fecha_hora,
                    p.descripcion,
                    p.cantidad_asistentes,
                    c.nombre_categoria AS categoria,
                    t.descripcion_publico AS tipo_publico,
                    e.nombre_estado AS estado
                FROM
                    asistencia a
                JOIN 
                    publicacion p ON a.id_publicacion = p.id_publicacion
                JOIN 
                    categorias c ON p.id_cat = c.id_categoria
                JOIN 
                    tipo t ON p.id_tipo = t.id_tipo
                JOIN 
                    estado e ON p.id_estado = e.id_estado
                WHERE 
                    a.id_usuario = :id_user
                ORDER BY 
                    ABS(TIMESTAMPDIFF(SECOND, NOW(), p.fecha_hora)) ASC;
                ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_user', $idUser, PDO::PARAM_INT);
        $stmt->execute();
        
        // return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve un array de eventos
        return $stmt->fetch(PDO::FETCH_OBJ);

        
    } catch (PDOException $e) {
        echo "Error al obtener eventos: " . $e->getMessage();
        return [];
    }
}
    







    



}