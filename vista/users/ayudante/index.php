 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarioss</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <link rel="stylesheet" href="assets/css/styles2.css">


<style>
 .contenedor-filtros {
    width: 100%;
    max-width: 1400px; /* Limita el ancho máximo */
    margin: 20px auto; /* Centra el contenedor con margen superior e inferior */
    padding: 0 20px; /* Añade espacio lateral */
}



.filtros {
    display: flex;
    gap: 20px;
    background-color: 	#0a326d; /* Cambiado a azul marino */
    padding: 10px 20px;
    border-radius: 8px;
    color: white;
    align-items: center;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Sombra ligera para darle efecto */
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

.categorias {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.categoria-opciones {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

/* Estilos personalizados para los radio buttons */
input[type="radio"] {
    appearance: none;
    width: 20px;
    height: 20px;
    border: 2px solid white;
    border-radius: 50%;
    background-color: transparent;
    position: relative;
    cursor: pointer;
    margin-right: 10px;
}

input[type="radio"]:checked {
    background-color: white;
}

input[type="radio"]::before {
    content: '';
    display: block;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: #1c3b57; /* Azul marino para el indicador seleccionado */
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    opacity: 0;
    transition: opacity 0.2s ease-in-out;
}

input[type="radio"]:checked::before {
    opacity: 1;
}

       /*barra de vusqueda  */
       .search-container {
      display: flex;
      align-items: center;
      margin: 20px;
    }

    .search-container input[type="text"] {
      padding: 8px;
      font-size: 16px;
    }

    .search-container button {
      padding: 8px 12px;
      font-size: 16px;
      margin-left: 5px;
      cursor: pointer;
    }




    .tipo-publico {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

#estadoNichosSelect {
    padding: 5px;
    border-radius: 5px;
    border: none;
}

#calleNichosSelect {
    padding: 5px;
    border-radius: 5px;
    border: none;
}
#avenidaNichosSelect {
    padding: 5px;
    border-radius: 5px;
    border: none;
}
#tipoNichoSelect {
    padding: 5px;
    border-radius: 5px;
    border: none;
}
  
</style>


 
</head>
<body>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php include 'header.php'; ?>


<?php if($this->menu == "captura"): ?>                  
    <?php include 'captura.php'; ?>

<?php elseif($this->menu == "boletas"): ?>                  

<?php elseif($this->menu == "reportes"): ?>                  
             
 
<?php endif; ?>
  




 <script>

    function cargarVistaa(url) {

    window.location.href = url;  // Redirige a la nueva URL
    }



 </script>
  

</body>
</html>







