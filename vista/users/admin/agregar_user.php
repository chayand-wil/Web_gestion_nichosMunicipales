
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="assets/css/forms_registro.css">

    <style> 
        
    
    </style>


</head>
    

<body>
             <!-- Mostrar mensaje de registro apuntada o retirada -->


 
             
 
    <div class="form-container">
    <!-- <h2>Registro de Usuario</h2> -->
    <form action="?c=registro&a=insertarUser" method="POST">

        <label for="nombres">* Nombres:      </label>  
        <input type="text" id="nombres" name="nombres" placeholder="Luis Miguel" required>
    
        <label for="apellidos">* Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" placeholder="Rosales Esponosa" required>

        <label for="username">* Cree un nombre de Usuario:</label>
        <input type="text" id="username" name="username" placeholder="jonwilson777" >
        
        <label for="mail">* Ingrese un correo electronico:</label>
        <input type="text" id="mail" name="mail" placeholder="jonwilson@gmail.com" >

        
        <label for="password">* Contraseña:</label>
        <input type="password" id="password" name="password" placeholder="aaaBB123" required>
        
            <label for="identificacion">* Cui:</label>
            <input type="number" id="cui" name="cui" placeholder="77040450560101" >
        
        <input type="hidden" id="estado" name="estado" value="3" >
        
        <label for="rol">Rol:</label>
        
        
        
        <select id="rol" name="rol" required>

            <option value="" selected disabled>Elige un rol...</option>
            <option value="1">Administrador</option>
            <option value="2">Ayudante</option>
            <option value="3">Auditor</option>
            <option value="4">Usuario - comun</option>
        </select>

        <button type="submit">Registrar</button>
    </form>
</div>








 
</body>
</html>

    </style>
</head>
 



 


