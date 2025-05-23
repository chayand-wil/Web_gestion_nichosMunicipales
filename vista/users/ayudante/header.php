<?php
// Inicia la sesión si es necesario
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome CDN -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> -->
    <!-- <link rel="stylesheet" href="/assets/css/forms.css"> -->


    <style>
        /* Estilos generales de la página */
        /* Estilos   generales de la página */
body {
    margin: 0;
    padding: 0; 
    color: #333;
    padding-top: 0px;
    font-family: Arial, sans-serif;
    background: linear-gradient(to bottom, #003a7c, #c2dfff); /* Fondo azul difuminado */
    align-items: center;
    display: flex;
    flex-direction: column;
}

/* Estilo general del header */
header {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between; /* Espaciado entre los elementos */
    background: linear-gradient(to right, #001b4e, #003a7c);
    padding: 10px 20px;
    box-sizing: border-box; /* Asegura que el padding no afecte el tamaño */
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
}


/* Contenedor para los íconos del lado derecho */
.header-right {
    display: flex;
    align-items: center;
    gap: 15px; /* Espacio entre los íconos */
}

/* Estilo para el botón */
.header-button {
    background-color: #ffffff;
    border: 2px solid #003366;
    color: #003366;
    padding: 8px 16px;
    border-radius: 50%; /* Forma circular, al igual que los íconos */
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.2s ease, color 0.2s ease;
}

/* Efecto hover en el botón */
.header-button:hover {
    background-color: #003366;
    color: #ffffff;
}

/* Estilo general de los íconos */
.header-right div {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 45px;
    height: 45px;
    background-color: #ffffff;
    border-radius: 50%; /* Forma circular */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: transform 0.2s ease, background-color 0.2s ease;
}

.header-right div i {
    color: #003366;
    font-size: 20px;
}

/* Efecto hover en los íconos */
.header-right div:hover {
    transform: scale(1.1);
    background-color: #f0f0f0;
}

/* Media query para pantallas pequeñas */
@media (max-width: 768px) {
    header {
        flex-wrap: wrap;
    }
    .header-right {
        justify-content: flex-end;
    }
}


 

/* Contenedor del menú desplegable */
.dropdown {
        position: relative;
    }

    /* Botón del menú desplegable */
    .dropdown-btn {
        background-color: #ffffff;
        color: #003a7c;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: background-color 0.2s ease;
    }

    .dropdown-btn:hover {
        background-color: #f0f0f0;
    }

    /* Lista desplegable */
    .dropdown-menu {
        display: none;
        position: absolute;
        top: 45px;
        right: 0;
        background-color: white;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 10;
        list-style: none;
        padding: 0;
        margin: 0;
        overflow: hidden;
    }

    .dropdown-menu li {
        padding: 10px 20px;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .dropdown-menu li:hover {
        background-color: #f0f0f0;
    }

    /* Mostrar el menú al hacer clic */
    .dropdown.show .dropdown-menu {
        display: block;
    }


    .tipo-publico {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

#tipoPublicoSelect {
    padding: 5px;
    border-radius: 5px;
    border: none;
}


</style>





<header>
    <div  class="logo">
        <a href="?c=logout">

            <button class="header-button">Cerrar Sesion</button>
        </a>
    </div>

    <?php 
        $roll = $_SESSION['role'];
        if($roll == '1'){
            $roll = 'Administrador';
        }else if($roll == '2'){
            $roll = 'Ayudante';
        }else if($roll == '3'){
            $roll = 'Auditor';
        }else if($roll == '4'){
            $roll = 'Usuario';
        }
    
    ?>     
    <p style="color: #c2dfff;"> <?= $roll?>:   <?= $_SESSION['username']?></p></div>




<?php if($this->menu == "captura"):?>
    <h2 style="color: #d1e7dd;">Gestionar entrada de datos </h2>

<?php elseif($this->menu == "boletas"):?>
        <h2 style="color: #d1e7dd;">Gestion de boletas</h2>
        
         

<?php elseif($this->menu == "reportes"):?>
    <h2 style="color: #d1e7dd;">Reportes</h2>


<?php endif; ?>



   <div class="tipo-publico">
                <select id="tipoPublicoSelect">
                    <option value="captura" <?php  echo ($this->menu === 'captura') ? 'selected' : ''; ?>>Captura de datos</option>
                    <option value="boletas" <?php  echo ($this->menu === 'boletas') ? 'selected' : ''; ?> >Gestion de boletas</option>
                    <option value="reportes"  <?php  echo ($this->menu === 'reportes') ? 'selected' : ''; ?> >Reportes</option>
                </select>
    </div> <!-- Botón antes de los íconos -->

    <div class="header-right">
        <a href="?c=user_reg">            
            <img src="assets/img/logo.png" alt="Logo" style="height: 40px;">
        </a>

        <a href="?c=userAyudante&menu=captura">
            <button  class="header-button">Home</button>
        </a>


        <div><i class="fa-solid fa-bell"></i></div>
        <div><i class="fa-solid fa-user"></i></div> <!-- Este es el último ícono -->
    </div>  
</header>



 


<script>


document.addEventListener('DOMContentLoaded', () => {
    const tipoPublicoSelect = document.getElementById('tipoPublicoSelect');

    tipoPublicoSelect.addEventListener('change', () => {
        // alert('Tipo público seleccionado:' + tipoPublicoSelect.value);
        const controlador = "?c=userAyudante&menu=";
        const url = controlador + tipoPublicoSelect.value;
        window.location.href = url;  // Redirige a la nueva URL

        
    });

 
});

 
  



</script>










</html>