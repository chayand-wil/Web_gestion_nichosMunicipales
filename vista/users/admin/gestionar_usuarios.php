

 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Nichos - Usuarios</title>
<style>
         
</style>  


</head>
<body>
  










<div class="barra-botones">
    <a href="?c=admin&a=filtrar&filtro=2">
        <button class="boton" data-id="Aceptadas"    >Ver usuarios </button>
    </a>
    <a href="?c=admin&a=filtrar&filtro=1">
        <button class="boton" data-id="Pendientes"  >Agregar usuario +</button>
    </a>
 
</div>
    
  
 <br> <br> <br> <br> <br> <br> <br> <br>

 
 <?php if($this->titulo == 'Aceptadas'):?>
    <h2 style="color: blanchedalmond;">Ver usuarios</h2>
    
<?php else: ?>
        <h2 style="color: blanchedalmond;"><?= $this->titulo ?></h2>
        
<?php endif; ?>
 
 

<?php if($this->submenu == "listar"):?>
    <?php    include 'listar_usuarios.php'; ?>

    
<?php elseif($this->submenu == "agregar"):?>
        <?php    include 'agregar_user.php'; ?>

<?php endif; ?>







 


        <script src="assets/js/ani.js"></script>

</body>
</html>






