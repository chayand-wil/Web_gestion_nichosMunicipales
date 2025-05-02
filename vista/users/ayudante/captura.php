 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarioss</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <!-- <link rel="stylesheet" href="assets/css/styles2.css"> -->


 
    <link rel="stylesheet" href="assets/css/forms_registro.css">



<style>
 
 
</style>


 
</head>
<body>

 

<h1>Creacion de contrato de un nicho</h1>

    


<div class="filtros">
     <h3>A continuacion seleccione un nicho </h1>
     <?php ?>
     <label for=""> 
         <?php if($this->nichoSelect): ?>                  
            No ha seleccionado ningun nicho
            
        <?php else: ?>
            ID Nicho seleccionado:  <?= $this->idNichoSelect; ?>            

        <?php endif; ?>
    </label>
          <button onclick="cargarVistaa('?c=userAyudante&a=verNichos')" >Seleccionar Nicho</button>
    <br>
     
</div>

 

<?php if($this->nichoSelect): ?>
    <?php include 'nichos.php'; ?>
<?php endif; ?>






<div class="form-container">
    <!-- <h2>Registro de Usuario</h2> -->
<form action="?c=userAyudante&a=crearContrato" method="POST">
            <div class="tipo-publico">
                <label for="userSelect"><h3>Seleccione un Usuario responble</h3></label>
                <select id="userSelect" name="userSelect"> 
                    <?php foreach ($this->allUsers as $user): ?>
                        <option value="<?php echo htmlspecialchars($user->id_usuario);   ?>"
                            <?php echo ($this->userSelect ==   $user->id_usuario) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($user->id_usuario . " " . $user->primer_nombre . " " . $user->primer_apellido ); ?>
                        </option>
                    <?php endforeach; ?>
 
                </select>
            </div>

    <p style="color: blue;">Informacion de contacto del Reponsable</p>
            <label for="telefono">* Telefono:      </label>  
            <input type="number" id="telefono" name="telefono" placeholder="45645678" required>
        
            <label for="mail">* Correo :</label>
            <input type="mail" id="mail" name="mail" placeholder="chayan@gmail.com" required>
 
    <hr>    
 
 




<p style="color: blue;">Informacion Ocupante</p>
            <label for="nombreUno">* Primer nombre:      </label>  
            <input type="text" id="nombreUno" name="nombreUno" placeholder="Luis Miguel" required>
        
            <label for="nombreDos">* Segundo nombre :</label>
            <input type="text" id="nombreDos" name="nombreDos" placeholder="Rosales Esponosa" required>

            <label for="apellidoUno">* Primer apellido:      </label>  
            <input type="text" id="apellidoUno" name="apellidoUno" placeholder="Luis Miguel" required>
        
            <label for="apellidoDos">* Segundo apellido:</label>
            <input type="text" id="apellidoDos" name="apellidoDos" placeholder="Rosales Esponosa" required>

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

        <label for="dpi">* Cui:</label>
        <input type="number" id="dpi" name="dpi" placeholder="77040450560101" required >

        <label for="dir">* Direccion:</label>
        <input type="text" id="dir" name="dir" placeholder="Calle 4, avenida 12" required>


        <label for="cumple">* Fecha de nacimiento:</label>
        <input type="date" id="cumple" name="cumple" placeholder="fecha" required>

 
<hr>
<p style="color: blue;">Sobre el fallecimiento</p>

        <label for="fechaFall">* Fecha de fallecimiento:</label>
        <input type="date" id="fechaFall" name="fechaFall" placeholder="fecha" required>
        
        <label for="causaFallecimiento">* Causa de fallecimiento:</label>
        <select id="causaFallecimiento" name="causa"> 
                <?php foreach ($this->causas as $causa): ?>
                    <option value="<?php echo htmlspecialchars($causa->id); ?>"
                        <?php echo ($this->causaipioDef ==   $causa->id) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($causa->causa  ); ?>
                    </option>
                <?php endforeach; ?> 
        </select>
        <input type="hidden" value="1" name="estado_contrato">
        <input type="hidden" value="<?= $this->idNichoSelect; ?>" name="nicho">


<hr>

 
 


        <button type="submit">Registrar</button>
    </form>
</div>









<br> 
<br> 
<br>   
 






 <script>

    function cargarVistaa(url) {

    window.location.href = url;  // Redirige a la nueva URL
    }



 </script>
  

</body>
</html>







