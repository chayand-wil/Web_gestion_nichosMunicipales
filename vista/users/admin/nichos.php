<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nichos</title>

    <style>
       
    </style>
</head>
<body>



 
<div class="grid-container">  
 
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
                                
            </div>            <div class="card">
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
                                
            </div>            <div class="card">
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
                                
            </div>            <div class="card">
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



 
    </script>
</body>
</html>