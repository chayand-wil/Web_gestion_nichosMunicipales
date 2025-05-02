<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Nichos Quetzaltenango   - Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css"> 
</head>
<body>
    <div class="min-vh-100 d-flex justify-content-center align-items-center">
        <div class="login-container">
            <div class="logo-container">
                <img src="assets/img/logo2.png" alt="Ola Ke Hace Logo">
            </div>
            <h2 class="text-center mb-4">Registro</h2>

        <p style="color: blue;">Informacion personal</p>
        
    <form class="register-form" action="?c=registro&a=insertarUser" method="POST">

    
<div class="mb-3">

    <label for="nombreUno">* Primer nombre:      </label>  
    <input class="form-control" "text" id="nombreUno" name="nombreUno" placeholder="Luis Miguel" required>
</div>


        
            <label for="nombreDos">* Segundo nombre :</label>
            <input class="form-control"type="text" id="nombreDos" name="nombreDos" placeholder="Rosales Esponosa" required>

            <label for="apellidoUno">* Primer apellido:      </label>  
            <input class="form-control"type="text" id="apellidoUno" name="apellidoUno" placeholder="Luis Miguel" required>
        
            <label for="apellidoDos">* Segundo apellido:</label>
            <input class="form-control"type="text" id="apellidoDos" name="apellidoDos" placeholder="Rosales Esponosa" required>
    <hr>



            <div class="tipo-publico">
                <label for="tipoNichoSelect"><h3>Seleccione un municipio</h3></label>
                <select id="tipoNichoSelect" name="munic"> 
                
                    <?php foreach ($this->municipios as $munic): ?>
                        <option value="<?php echo htmlspecialchars($munic->id); ?>"
                            <?php echo ($this->municipioDef ==   $munic->numero) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($munic->nombre . " " . $munic->numero ); ?>
                        </option>
                    <?php endforeach; ?>


                </select>
            </div> 



<p style="color: blue;">Informacion importante</p>

        <label for="dpi">* Cui:</label>
        <input class="form-control" type="number" id="dpi" name="dpi" placeholder="77040450560101" required >

        <label for="dir">* Direccion:</label>
        <input class="form-control" type="text" id="dir" name="dir" placeholder="Calle 4, avenida 12" required>


        <label for="cumple">* Fecha de nacimiento:</label>
        <input class="form-control" type="date" id="cumple" name="cumple" placeholder="fecha" required>



<hr>




<p style="color: blue;">Informacion de su cuenta</p>

  
        <label for="mail">* Ingrese un correo electronico:</label>
        <input class="form-control" type="mail" id="mail" name="mail" placeholder="jonwilson@gmail.com"  required>

        
        
        <label for="password">* Contraseña:</label>
        <input class="form-control" type="password" id="password" name="password" placeholder="aaaBB123" required>
        
            
        <label for="rol">Rol:</label>
        <select class="form-control"id="rol" name="rol" required>

            <option value="" selected disabled>Elige un rol...</option>
            <option value="1">Administrador</option>
            <option value="2">Ayudante</option>
            <option value="3">Auditor</option>
            <option value="4">Usuario - Consulta</option>
        </select>
<br>


        


    
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary w-100">Registrarse</button>
                </div>

                
                <div class="guest-link">
                    <a href="?c=login">¿Ya tienes una cuenta? Inicia sesión</a>


                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
