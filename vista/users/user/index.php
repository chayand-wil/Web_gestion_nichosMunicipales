<?php
// Iniciar la sesión al comienzo del script
session_start();


 ?>

<?php include '/opt/lampp/htdocs/Web_gestion_nichosMunicipales/vista/users/header.php' ?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoreo-Monitor</title>
    <link rel="stylesheet" href="assets/css/styles2.css">
    <link rel="stylesheet" href="assets/css/filtros.css">
</head>
<style>




</style>




<body>


    
    
<?php    include 'header.php'; 



?>



    
        <?php if($this->vista == "home"):?>
                
        <h1>Home</h1>

        <?php    include 'iteracion.php';  
        ?> 
        <?php endif; ?>    





        <?php if($this->vista == "mis_eventos"):?>
            <h1>Historial de iteraciones</h1> 
            <?php include 'historial_iteraciones.php'?>
        <?php endif; ?>
        
 
 
 

<script>

 


document.addEventListener('DOMContentLoaded', () => {
        const tipoPublicoSelect = document.getElementById('tipoPublicoSelect');
        const categoriaInputs = document.querySelectorAll('input[name="categoria"]');

        tipoPublicoSelect.addEventListener('change', () => {
            // alert('Tipo público seleccionado:' + tipoPublicoSelect.value);
            const controlador = "?c=user_reg&ftipo=";
            const url = controlador + tipoPublicoSelect.value;
            cargarFiltro(url);
            
        });


        categoriaInputs.forEach(input => {
            input.addEventListener('change', () => {
                // alert('Categoría seleccionada:'+  input.value);
                const controlador = "?c=user_reg&fcategoria=";
                const url = controlador + input.value;
                cargarFiltro(url);

            });
        });
    });



document.getElementById('btnCargarJSON').addEventListener('click', function() {
            // Simular clic en el input de tipo file (oculto)
            document.getElementById('fileInput').click();
        });
        
        document.getElementById('fileInput').addEventListener('change', function() {
            const file = this.files[0];
            if (!file) {
                alert("No se ha seleccionado ningún archivo.");
                return;
            }
            
            // Crear un objeto FormData para enviar el archivo
            const formData = new FormData();
            formData.append('fileInput', file);
            
            // Enviar el archivo al servidor mediante AJAX
            fetch(window.location.href, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Mostrar el resultado
                const resultadoDiv = document.getElementById('resultado');
                
                if (data.success) {
                    resultadoDiv.innerHTML = `
                        <div style="color: green; margin-top: 15px;">
                            <strong>Éxito:</strong> ${data.message}
                        </div>
                    `;
                    // Recargar la página para mostrar los datos de la sesión
                    setTimeout(() => window.location.reload(), 1500);
                } else {
                    resultadoDiv.innerHTML = `
                        <div style="color: red; margin-top: 15px;">
                            <strong>Error:</strong> ${data.message}
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('resultado').innerHTML = `
                    <div style="color: red; margin-top: 15px;">
                        <strong>Error:</strong> Ocurrió un problema al comunicarse con el servidor.
                    </div>
                `;
            });
        });







 

function handleFileSelect(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    try {
                        const jsonData = JSON.parse(e.target.result);
                        const outputElement = document.getElementById('output');
                        outputElement.value = JSON.stringify(jsonData, null, 4);
                        outputElement.style.display = 'block';
                    } catch (error) {
                        document.getElementById('output').value = 'Error al leer el JSON: ' + error.message;
                        document.getElementById('output').style.display = 'block';
                    }
                };
                reader.readAsText(file);
            }
        }
        
        document.getElementById('fileInput').addEventListener('change', handleFileSelect);

 



function iniciarr(url) {
    // cargarArchivo();
    window.location.href = url;  // Redirige a la nueva URL
    
}
  

function cargarVista(url) {
        const id = <?php echo json_encode($this->currentId); ?>;

        window.location.href = url;  // Redirige a la nueva URL
}

function cargarFiltro(url) {
        window.location.href = url;  // Redirige a la nueva URL
}


 
 




</script>


        <script src="assets/js/form_report.js" ></script>

        <script src="assets/js/ani.js"></script>
</body>
</html>
