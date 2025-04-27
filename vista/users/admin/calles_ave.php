<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Vías</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .checkbox-group {
            margin-top: 10px;
        }
        .btn-submit {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-submit:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registro de Calles y Avenidas</h2>
        <form id="streetForm" action="procesar_formulario.php" method="POST">
            <div class="form-group">
                <label for="viaType">Tipo de Vía:</label>
                <select id="viaType" name="viaType" required>
                    <option value="">Seleccione tipo de vía</option>
                    <option value="calle">Calle</option>
                    <option value="avenida">Avenida</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="viaName">Nombre o Número:</label>
                <input type="text" id="viaName" name="viaName" placeholder="Ej: Calle 5 o Avenida Reforma" required>
            </div>
            
            <div class="form-group">
                <label for="viaLength">Distancia (metros):</label>
                <input type="number" id="viaLength" name="viaLength" min="1" step="0.01" required>
            </div>
            
            <div class="form-group">
                <label for="departamento">Departamento:</label>
                <select id="departamento" name="departamento" required>
                    <option value="">Seleccione un departamento</option>
                    <option value="guatemala">Guatemala</option>
                    <option value="quetzaltenango">Quetzaltenango</option>
                    <option value="escuintla">Escuintla</option>
                    <option value="sacatepequez">Sacatepéquez</option>
                    <option value="chimaltenango">Chimaltenango</option>
                    <!-- Añadir más departamentos de Guatemala según sea necesario -->
                </select>
            </div>
            
            <div class="form-group">
                <label for="municipio">Municipio:</label>
                <select id="municipio" name="municipio" required>
                    <option value="">Primero seleccione un departamento</option>
                    <!-- Opciones se cargarán dinámicamente con JavaScript -->
                </select>
            </div>
            
            <div class="form-group">
                <label for="zona">Zona:</label>
                <select id="zona" name="zona" required>
                    <option value="">Primero seleccione un municipio</option>
                    <!-- Se pueden agregar opciones predeterminadas o cargar dinámicamente -->
                    <option value="zona1">Zona 1</option>
                    <option value="zona2">Zona 2</option>
                    <option value="zona3">Zona 3</option>
                    <option value="zona4">Zona 4</option>
                    <option value="zona5">Zona 5</option>
                    <!-- Añadir más zonas según sea necesario -->
                </select>
            </div>
            
            <label for="hasSemaforo">Semáforo</label>
            <div class="form-group checkbox-group">
                <div>
                    <input type="checkbox" id="hasSemaforo" name="infraestructura[]" value="semaforo">
                </div>
    
            </div>
            
            <div class="form-group">
                <label for="observaciones">Observaciones adicionales:</label>
                <textarea id="observaciones" name="observaciones" rows="3" placeholder="Ingrese cualquier información adicional sobre la vía"></textarea>
            </div>
            
            <button type="submit" class="btn-submit">Registrar Vía</button>
        </form>
    </div>

    <script>
        // Objeto con los municipios por departamento
        const municipiosPorDepartamento = {
            guatemala: ["Guatemala", "Mixco", "Villa Nueva", "San Miguel Petapa", "Santa Catarina Pinula"],
            quetzaltenango: ["Quetzaltenango", "Coatepeque", "Colomba", "San Martín Sacatepéquez"],
            escuintla: ["Escuintla", "Santa Lucía Cotzumalguapa", "La Democracia", "Siquinalá"],
            sacatepequez: ["Antigua Guatemala", "Jocotenango", "Ciudad Vieja", "Santa María de Jesús"],
            chimaltenango: ["Chimaltenango", "Tecpán Guatemala", "Patzún", "Zaragoza"]
        };

        // Cargar municipios cuando cambia el departamento
        document.getElementById('departamento').addEventListener('change', function() {
            const departamento = this.value;
            const municipioSelect = document.getElementById('municipio');
            
            // Limpiar opciones actuales
            municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>';
            
            // Si hay un departamento seleccionado
            if(departamento) {
                // Obtener municipios del departamento seleccionado
                const municipios = municipiosPorDepartamento[departamento] || [];
                
                // Agregar opciones de municipios
                municipios.forEach(municipio => {
                    const option = document.createElement('option');
                    option.value = municipio.toLowerCase().replace(/ /g, '_');
                    option.textContent = municipio;
                    municipioSelect.appendChild(option);
                });
            }
        });
    </script>
</body>
</html>