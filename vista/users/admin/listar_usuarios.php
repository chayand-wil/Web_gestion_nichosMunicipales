<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarioss</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <link rel="stylesheet" href="assets/css/styles2.css">

<style>

 

.container {
    width: 100%;
    max-width: 400px;
}

.card {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
}

h2 {
    color: #333;
}

.user-info p {
    font-size: 18px;
    margin: 10px 0;
}

.user-info strong {
    color: #555;
}



</style>





</head>
<body>


 
<?php foreach($this->modelo2->viewUsers() as $eq):?>         <!--ciclo for -->

    
<div class="container">
    <div class="card">
        <h2>Información del Usuario</h2>
        <div class="user-info">
            <p><strong>CUI:</strong> <?= $eq->id_cui; ?> <span id="cui"></span></p>
            <p><strong>Usuario:</strong> <?= $eq->username; ?><span id="username"></span></p>
            <p><strong>Nombre:</strong> <?= $eq->nombres; ?><span id="nombres"></span></p>
            <p><strong>Apellido:</strong> <?= $eq->apellidos; ?><span id="apellidos"></span></p>
            <p><strong>Calle Asignada:</strong> calle<span id="calle"></span></p>
            <p><strong>Rol:</strong> <?= $eq->rol; ?><span id="rol"></span></p>
            <p><strong>Estado:</strong><?= $eq->estado; ?> <span id="estado"></span></p>
            <button>Cambiar estado </button>

            <button onclick="eliminarUser('?c=admin&a=eliminarUserC&filtro=1', '<?= $eq->id_cui?>' )" >Eliminar </button>


        </div>
    </div>
</div>
<br>  
                       
<?php endforeach;?> 
 
 









 

<script >

        // function cargarVista(url) {
        //     // const id = <?php echo json_encode($this->currentId); ?>;

        //     window.location.href = url;  // Redirige a la nueva URL
        // }



        function eliminarUser(controlador, id_user) {
        const dos = controlador + "&id_user=" + id_user;
 
        alert("Se ha Eliminado el usuario con id: " + id_user );
            
      

        window.location.href = dos;  // Redirige a la nueva URL
        
    }







</script>
 



    

</body>
</html>







