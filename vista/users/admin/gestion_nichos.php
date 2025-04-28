<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Nichos</title>

    <style>
       
    </style>
</head>


<body>
 
 
<div class="barra-botones">
    <a href="?c=admin&a=identificarMenu&filtro=1">
        <button class="boton" data-id="nichos"    >Ver nichos </button>
    </a>
    <a href="?c=admin&a=identificarMenu&filtro=2">
        <button class="boton" data-id="ocupaciones"  >Solicitudes - ocupaciones</button>
    </a>
    <a href="?c=admin&a=identificarMenu&filtro=3">
        <button class="boton" data-id="exhumaciones"  title=""  >Solicitudes - exhumaciones</button>
    </a>
 
</div>



<br><br> 
<br><br><br>
<br><br> 

<?php if($this->titulo == 'Aceptadas'):?>
    <h2 style="color: blanchedalmond;">Ver Nichos</h2>
    
<?php else: ?>
        <h2 style="color: blanchedalmond;"><?= $this->titulo ?></h2>
        
<?php endif; ?>


 
<?php if($this->submenu == "nichos"):?>
    <?php    include 'nichos.php'; ?>
    
    
    <?php elseif($this->submenu == "ocupaciones"):?>
        <?php    include 'solicitudes_ocupaciones.php'; ?>
        
    <?php elseif($this->submenu == "exhumaciones"):?>
        <?php    include 'solicitudes_exhumaciones.php'; ?>
        
    <?php else:?>
                
    <?php    include 'nichos.php'; ?>


<?php endif; ?>








<!-- <script src="assets/js/ani.js"></script> -->



    <script>

 
    </script>
</body>
</html>