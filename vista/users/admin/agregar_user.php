
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

    <p style="color: blue;">Informacion personal</p>
            <label for="nombreUno">* Primer nombre:      </label>  
            <input type="text" id="nombreUno" name="nombreUno" placeholder="Luis Miguel" required>
        
            <label for="nombreDos">* Segundo nombre :</label>
            <input type="text" id="nombreDos" name="nombreDos" placeholder="Rosales Esponosa" required>

            <label for="apellidoUno">* Primer apellido:      </label>  
            <input type="text" id="apellidoUno" name="apellidoUno" placeholder="Luis Miguel" required>
        
            <label for="apellidoDos">* Segundo apellido:</label>
            <input type="text" id="apellidoDos" name="apellidoDos" placeholder="Rosales Esponosa" required>
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
        <input type="number" id="dpi" name="dpi" placeholder="77040450560101" required >

        <label for="dir">* Direccion:</label>
        <input type="text" id="dir" name="dir" placeholder="Calle 4, avenida 12" required>


        <label for="cumple">* Fecha de nacimiento:</label>
        <input type="date" id="cumple" name="cumple" placeholder="fecha" required>



<hr>




<p style="color: blue;">Informacion de su cuenta</p>

  
        <label for="mail">* Ingrese un correo electronico:</label>
        <input type="mail" id="mail" name="mail" placeholder="jonwilson@gmail.com"  required>

        
        
        <label for="password">* Contraseña:</label>
        <input type="password" id="password" name="password" placeholder="aaaBB123" required>
        
            
        <label for="rol">Rol:</label>
        <select id="rol" name="rol" required>

            <option value="" selected disabled>Elige un rol...</option>
            <option value="1">Administrador</option>
            <option value="2">Ayudante</option>
            <option value="3">Auditor</option>
            <option value="4">Usuario - Consulta</option>
        </select>

        <button type="submit">Registrar</button>
    </form>
</div>








 
</body>
</html>

    </style>
</head>
 



 


