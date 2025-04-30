<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Nichos</title>

    <style>
        
.contenedor-filtros {
    width: 100%;
    max-width: 1200px; /* Limita el ancho máximo */
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

    </style>


</head>
<body>


<div class="contenedor-filtros">
    <div class="filtros">
            

            
        <div class="categoria-opciones">
            <label>
                <input type="radio" name="categoria" value="filtrar" 
                 <?php  echo ($this->verNichosPor === 'filtrar') ? 'checked' : ''; ?>  > Filtrar por
            </label>

    <br> <br> <br><br><br>

            <div class="tipo-publico">
                <label for="estadoNichosSelect"><h3>Estado</h3></label>
                <select id="estadoNichosSelect"> 
                    <option value="disponible" <?php  echo ($this->filtroEstado === 'disponible') ? 'selected' : ''; ?>>Nichos disponibles</option>
                    <option value="ocupado" <?php  echo ($this->filtroEstado === 'ocupado') ? 'selected' : ''; ?> >Nichos ocupados</option>
                    <option value="historico"  <?php  echo ($this->filtroEstado === 'historico') ? 'selected' : ''; ?> >Nichos historicos</option>
                    <option value="todos"  <?php  echo ($this->filtroEstado === 'todos') ? 'selected' : ''; ?> >Todos los nichos</option>

 

                </select>
            </div>                        
            <div class="tipo-publico">
                <label for="calleNichosSelect"><h3>Calle</h3></label>
                <select id="calleNichosSelect"> 
                    <?php foreach ($this->calles as $calle): ?>
                        <option value="<?php echo htmlspecialchars($calle); ?>"
                            <?php echo ($this->calleSelected ===   $calle) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($calle); ?>
                        </option>
                    <?php endforeach; ?>
                    
                </select>
            </div>             

            <div class="tipo-publico">
                <label for="avenidaNichosSelect"><h3>Avenida</h3></label>
                <select id="avenidaNichosSelect"> 
                    <?php foreach ($this->avenidas as $avenida): ?>
                        <option value="<?php echo htmlspecialchars($avenida); ?>"
                            <?php echo ($this->calleSelected ===   $avenida) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($avenida); ?>
                        </option>
                    <?php endforeach; ?>

                </select>
            </div>            
  
            <label>
                <input type="radio" name="categoria" value="buscar"  
                <?php  echo ($this->verNichosPor === 'buscar') ? 'checked' : ''; ?>  > Buscar 
            </label>    
             
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Buscar por codigo">
                <button onclick="buscar()">Buscar</button>
            </div>




                    

                    
                    
                </div>
         



    </div>





</div>




 
<div class="grid-container">  
 

<!-- tituloooo del estado del nicho -->
 
        <br>
       
            <h2> <?= $this->tituloEstado; ?></h2>
            <br>



 





            <div class="card">
                <div class="container">
                    <div class="header">
                        <div class="date"><?=$eq->fecha_hora?></div>
                        <button class="report-button" data-id="<?=$eq->id_publicacion?>" data-tittle="<?=$eq->titulo?>"  title="Reportar">
                            &#9888;
                        </button>
                    </div>
                    <div class="image">
                        <!-- <img src="<?= $eq->imgdir?>" alt="Imagen del evento"> -->
                        <img src="assets/img/nicho2.png" alt="Imagen del evento">
                    </div>
                    <div class="content">
                        <h2><?=$eq->titulo?></h3>
                        <p>Lugar: <?=$eq->lugar?></p>
                        <p> <?=$eq->descripcion?></p>
                        <h3>invita: <?=$eq->username?></h3>
                    </div>
                    <div class="footerTarjeta">
                        
                        <div class="attendance"> Asistirán: <?= $eq->currentAsistentes?> </div> 
 
                         <button class="details-button" onclick="cargarVista('?c=user_reg&a=mostrarPub&id=<?= $eq->id_publicacion?>')" >Más detalles</button>

                    </div>
                </div>
                                
            </div>            
            <div class="card">
                <div class="container">
                    <div class="header">
                        <div class="date"><?=$eq->fecha_hora?></div>
                        <button class="report-button" data-id="<?=$eq->id_publicacion?>" data-tittle="<?=$eq->titulo?>"  title="Reportar">
                            &#9888;
                        </button>
                    </div>
                    <div class="image">
                        <!-- <img src="<?= $eq->imgdir?>" alt="Imagen del evento"> -->
                        <img src="assets/img/nicho3.png" alt="Imagen del evento">
                    </div>
                    <div class="content">
                        <h2><?=$eq->titulo?></h3>
                        <p>Lugar: <?=$eq->lugar?></p>
                        <p> <?=$eq->descripcion?></p>
                        <h3>invita: <?=$eq->username?></h3>
                    </div>
                    <div class="footerTarjeta">
                        
                        <div class="attendance"> Asistirán: <?= $eq->currentAsistentes?> </div> 
 
                         <button class="details-button" onclick="cargarVista('?c=user_reg&a=mostrarPub&id=<?= $eq->id_publicacion?>')" >Más detalles</button>

                    </div>
                </div>
                                
            </div>             
        
         
 <!-- Puedes agregar más tarjetas aquí siguiendo el mismo formato -->
</div>





 


<script>

    document.addEventListener('DOMContentLoaded', () => {
            const tipoPublicoSelect = document.getElementById('estadoNichosSelect');
            const calles = document.getElementById('calleNichosSelect');
            const avenidas = document.getElementById('avenidaNichosSelect');
            const categoriaInputs = document.querySelectorAll('input[name="categoria"]');

            tipoPublicoSelect.addEventListener('change', () => {
                // alert('Tipo público seleccionado:' + tipoPublicoSelect.value);
                const controlador = "?c=admin&a=filtrarNicho&filtro=";
                const url = controlador + tipoPublicoSelect.value;
                cargarFiltro(url);
                
            });

            calles.addEventListener('change', () => {
                // alert('Tipo público seleccionado:' + tipoPublicoSelect.value);
                const controlador = "?c=admin&a=filtrarNicho_calle&filtro=";
                const url = controlador + calles.value;
                cargarFiltro(url);
            });

            avenidas.addEventListener('change', () => {
                // alert('Tipo público seleccionado:' + tipoPublicoSelect.value);
                const controlador = "?c=admin&a=filtrarNicho_avenida&filtro=";
                const url = controlador + avenidas.value;
                cargarFiltro(url);
                
            });


            categoriaInputs.forEach(input => {
                input.addEventListener('change', () => {
                    // alert('Categoría seleccionada:'+  input.value);
                    const controlador = "?c=admin&a=filtrarNicho&filtro=";
                    const url = controlador + input.value;
                    cargarFiltro(url);

                });
            });
        });



    function cargarFiltro(url) {
        window.location.href = url;  // Redirige a la nueva URL
    }
    function buscar() {
        const valor = document.getElementById('searchInput').value;
        alert('Buscando: ' + valor);

    }

</script>


</body>
</html>