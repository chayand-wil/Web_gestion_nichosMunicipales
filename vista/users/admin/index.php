<?php session_start(); ?>


<?php include '/opt/lampp/htdocs/Web_gestion_nichosMunicipales/vista/users/header.php' ?>

 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles2.css">
    
    <style>
        .mensaje-registro {
            background-color: #d1e7dd; /* Color de fondo verde claro */
            color: #0f5132; /* Color del texto verde oscuro */
            border: 1px solid #badbcc; /* Borde verde claro */
            border-radius: 8px; /* Bordes redondeados */
            padding: 10px 15px; /* Espaciado interno */
            margin: 10px 0; /* Espaciado externo */
            font-size: 16px; /* Tamaño del texto */
            font-weight: bold; /* Negrita */
            text-align: center; /* Centrar el texto */
            width: 100%; /* Ocupa todo el ancho del contenedor */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra suave */
            animation: fadeIn 2s ease; /* Animación de entrada */
        }

        /* Animación para que el mensaje aparezca suavemente */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

      

        .modale {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Fondo difuminado */
    backdrop-filter: blur(5px); /* Difumina el fondo */
    justify-content: center;
    align-items: center;
    }
    
    .modale-content {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    width: 300px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }
    
    ul {
    list-style: none;
    padding: 0;
    }
    
    ul li {
    margin-bottom: 10px;
    }
    
    .mensaje-exito {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #4caf50;
    color: white;
    padding: 15px 30px;
    border-radius: 10px;
    z-index: 2;
    }
    
    .mensaje-exito.active {
    display: block;
    }
 

    </style>



</head>




<body>


<?php    include 'vista/users/admin/header.php'; ?>


<?php if (isset($_SESSION['mensaje_registro'])): ?>
        <div class="mensaje-registro">
            <p><?= htmlspecialchars($_SESSION['mensaje_registro']) ?></p>
        </div>
        <?php unset($_SESSION['mensaje_registro']); // Eliminar el mensaje después de mostrarlo ?>
<?php endif; ?>

<br>
<br>
<br>
<br>
<br> 

<?php if($this->menu == "usuarios"):?>
    <?php    include 'gestionar_usuarios.php'; ?>
    
    
    <?php elseif($this->menu == "nichos"):?>
<?php    include 'gestion_nichos.php'; ?>
    
        
        
<?php elseif($this->menu == "contratos"):?>
<?php    include 'reportes_g.php'; ?>


<?php elseif($this->menu == "reportes"):?>
<?php    include 'reportes_g.php'; ?>

            

<?php endif; ?>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        let mensaje = document.querySelector(".mensaje-registro");
        if (mensaje) {
            setTimeout(() => {
                mensaje.style.transition = "opacity 0.5s ease";
                mensaje.style.opacity = "0";
                setTimeout(() => {
                    mensaje.style.display = "none";
                }, 500);
            }, 3000); // Desaparece después de 3 segundos
        }
    });
</script>



 
</body>
</html>
