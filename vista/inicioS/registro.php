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
                <img src="assets/img/logo.png" alt="Ola Ke Hace Logo">
            </div>
            <h2 class="text-center mb-4">Registro</h2>


            <form class="register-form" action="?c=registro&a=insertarUser" method="POST">
                <div class="mb-3">
                    <label for="nombres" class="form-label">* Nombres:      </label>  
                    <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Luis Miguel" required>
                </div>
                <div class="mb-3">  
                    <label for="apellidos" class="form-label"   >* Apellidos:</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Rosales Esponosa" required>
                </div>
            



                <div class="mb-3">
                    <label for="username" class="form-label">Nombre de usuario</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Escriba su nombre de usuario" required>
                </div>
 
                <div class="mb-3">
                    <label for="password" class="form-label">Correo electronico</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese un correo electronico" required>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Escriba su contraseña" required>
                </div>

                <div class="mb-3">
                  <input type="hidden" name="rol" id="rol" value="4" >  
                </div>
                <div class="mb-3">
                    <label for="identificacion" class="form-label">* Cui:</label>
                    <input type="number" class="form-control" id="cui" name="cui" placeholder="77040450560101" >
                </div>
    
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
