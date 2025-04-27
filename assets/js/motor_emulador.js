const canvas = document.getElementById("trafficCanvas");
const ctx = canvas.getContext("2d");

        const interseccion = {
            x: 300,
            y: 200,
            width: 200,
            height: 200
        };

        // Definición de los carriles (1-16)
        const carriles = {
            1: { x: 0, y: 210, direccion: "izquierda" },    // Carril 1 (horizontal, superior)
            2: { x: 0, y: 260, direccion: "izquierda" },    // Carril 2
            3: { x: 0, y: 310, direccion: "derecha" },    // Carril 3
            4: { x: 0, y: 370, direccion: "derecha" },    // Carril 4
            5: { x: 900, y: 210, direccion: "izquierda" }, // Carril 5 (horizontal, superior)
            6: { x: 900, y: 260, direccion: "izquierda" }, // Carril 6
            7: { x: 900, y: 310, direccion: "derecha" }, // Carril 7
            8: { x: 900, y: 370, direccion: "derecha" }, // Carril 8
            9: { x: 310, y: 0, direccion: "abajo" },      // Carril 9 (vertical, izquierdo)
            10: { x: 370, y: 0, direccion: "abajo" },      // Carril 10
            11: { x: 430, y: 0, direccion: "arriba" },      // Carril 11
            12: { x: 490, y: 0, direccion: "arriba" },      // Carril 12
            13: { x: 310, y: 600, direccion: "abajo" },   // Carril 13 (vertical, izquierdo)
            14: { x: 370, y: 600, direccion: "abajo" },   // Carril 14
            15: { x: 420, y: 600, direccion: "arriba" },   // Carril 15
            16: { x: 480, y: 600, direccion: "arriba" },   // Carril 16
        };

        let autos = [];


 


        // function cargarArchivo() {  
            
        //     alert("ddentro archiovooo.");
            
        //     const input = document.getElementById('fileInput');
        //     const file = input.files[0];

        //     if (!file) {
                
        //         alert("Por favor, selecciona un archivo JSON.");
                
        //         return;
        //     } 

        //     const reader = new FileReader();
        //     reader.onload = function(event) {
        //         try {
        //             const data = JSON.parse(event.target.result);
                    
        //             procesarDatos(data);
        //         } catch (error) {
        //             console.error("Error al leer el archivo JSON:", error);
        //             alert("El archivo JSON tiene un formato inválido.");
        //         }
        //     };
        //     reader.readAsText(file);
        // }


        function procesarJSON(jsonData) {
            // alert("dentro del jsonn");
            try {
                // Si el parámetro es una cadena JSON, la convertimos a objeto
                let data;
                if (typeof jsonData === 'string') {
                    data = JSON.parse(jsonData);
                } else {
                    // Si ya es un objeto, lo usamos directamente
                    data = jsonData;
                }
                
                // Procesamos los datos
                procesarDatos(data);
                
                return true; // Indica que el procesamiento fue exitoso
            } catch (error) {
                console.error("Error al procesar el JSON:", error);
                alert("El formato JSON es inválido o hay un error en el procesamiento.");
                return false; // Indica que hubo un error
            }
        }
        
        // Ejemplo de uso:
        // const miJSON = {"nombre": "Juan", "edad": 30};
        // procesarJSON(miJSON);
        
        // También puedes mantener la función original para cargar desde archivo




 














// Cargar de datos. archivo JSON 
// fetch('autos.php')

// fetch('autos.json')

// fetch('vista/users/publicator/autos.json')



 function procesarDatos(data) {
            const autosPorCarril = {};
            
            data.forEach(autoConfig => {
                if (!autosPorCarril[autoConfig.carrilInicio]) {
                    autosPorCarril[autoConfig.carrilInicio] = [];
                }
                autosPorCarril[autoConfig.carrilInicio].push(autoConfig);
            });

            Object.keys(autosPorCarril).forEach(carril => {
                const autosEnCarril = autosPorCarril[carril];
                
                autosEnCarril.forEach((autoConfig, index) => {
                    const carrilInicio = carriles[autoConfig.carrilInicio];

                    const esHorizontal = autoConfig.carrilInicio <= 8;
                    let offsetX = 0, offsetY = 0;
                    const espaciado = 100;

                    switch (carrilInicio.direccion) {
                        case "derecha": offsetX = -espaciado * index; break;
                        case "izquierda": offsetX = espaciado * index; break;
                        case "abajo": offsetY = -espaciado * index; break;
                        case "arriba": offsetY = espaciado * index; break;
                    }

                    autos.push({
                        x: carrilInicio.x + offsetX,
                        y: carrilInicio.y + offsetY,
                        width: esHorizontal ? 40 : 20,
                        height: esHorizontal ? 20 : 40,
                        color: autoConfig.color,
                        speed: autoConfig.speed,
                        direccion: carrilInicio.direccion,
                        carrilInicio: autoConfig.carrilInicio,
                        carrilDestino: autoConfig.carrilDestino,
                        girado: false
                    });
                });
            });

            console.log("Autos cargados:", autos);
        }


 




    
        //dibujossssss


    function dibujarInterseccion() {
    ctx.fillStyle = "#2362a6";
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Dibujar la intersección
    ctx.fillStyle = "#000";
    ctx.fillRect(interseccion.x, 0, interseccion.width, canvas.height);
    ctx.fillRect(0, interseccion.y, canvas.width, interseccion.height);

    // Dibujar líneas discontinuas
    ctx.setLineDash([10, 10]);
    ctx.strokeStyle = "white";
    ctx.lineWidth = 2;

    // Dibujar carriles horizontales (1-8)
    for (let i = 1; i <= 4; i++) {
        let offsetY = 150 + i * 50;
        ctx.beginPath();
        ctx.moveTo(0, offsetY);
        ctx.lineTo(interseccion.x, offsetY);
        ctx.stroke();
        ctx.beginPath();
        ctx.moveTo(interseccion.x + interseccion.width, offsetY);
        ctx.lineTo(canvas.width, offsetY);
        ctx.stroke();

        // Dibujar números de los carriles (1-4 y 5-8)
        ctx.fillStyle = "white";
        ctx.font = "14px Arial";
        ctx.fillText(`Carril ${i}`, interseccion.x - 80, offsetY + 40);
        ctx.fillText(`Carril ${i + 4}`, interseccion.x + interseccion.width + 20, offsetY + 40);
    }

    // Dibujar carriles verticales (9-16)
    for (let i = 1; i <= 4; i++) {
        let offsetX = 250 + i * 50;
        ctx.beginPath();
        ctx.moveTo(offsetX, 0);
        ctx.lineTo(offsetX, interseccion.y);
        ctx.stroke();
        ctx.beginPath();
        ctx.moveTo(offsetX, interseccion.y + interseccion.height);
        ctx.lineTo(offsetX, canvas.height);
        ctx.stroke();

        // Dibujar números de los carriles (9-12 y 13-16)
        ctx.fillStyle = "white";
        ctx.font = "14px Arial";
        ctx.fillText(`Carril ${i + 8}`, offsetX - 10, interseccion.y - 20);
        ctx.fillText(`Carril ${i + 12}`, offsetX - 10, interseccion.y + interseccion.height + 40);
    }

    // Dibujar líneas sólidas en la intersección
    ctx.setLineDash([]);
    for (let i = 0; i < 10; i++) {
        ctx.fillStyle = "white";
        ctx.fillRect(interseccion.x + i * 20, interseccion.y - 20, 10, 20);
        ctx.fillRect(interseccion.x + i * 20, interseccion.y + interseccion.height, 10, 20);
        ctx.fillRect(interseccion.x - 20, interseccion.y + i * 20, 20, 10);
        ctx.fillRect(interseccion.x + interseccion.width, interseccion.y + i * 20, 20, 10);
    }
}    
 



        function dibujarAutos() {
            autos.forEach(auto => {
                ctx.fillStyle = auto.color;
                ctx.fillRect(auto.x, auto.y, auto.width, auto.height);
            });
        }












        //FUNCIONES importartes






        // Función para verificar colisiones entre autos
function detectarColisiones(auto) {
    const margenSeguridad = 5; // Espacio mínimo entre autos
    
    for (const otroAuto of autos) {
        // No comprobar colisión consigo mismo
        if (auto === otroAuto) continue;
        
        // Solo verificar colisiones con autos en la misma dirección y carril
        if (auto.direccion === otroAuto.direccion) {
            let distancia = 0;
            
            switch (auto.direccion) {
                case "derecha":
                    // Si el otro auto está adelante y en el mismo carril o cerca
                    if (otroAuto.x > auto.x && Math.abs(otroAuto.y - auto.y) < 30) {
                        distancia = otroAuto.x - (auto.x + auto.width);
                        if (distancia < margenSeguridad) {
                            return true; // Colisión detectada
                        }
                    }
                    break;
                case "izquierda":
                    if (otroAuto.x < auto.x && Math.abs(otroAuto.y - auto.y) < 30) {
                        distancia = auto.x - (otroAuto.x + otroAuto.width);
                        if (distancia < margenSeguridad) {
                            return true;
                        }
                    }
                    break;
                case "abajo":
                    if (otroAuto.y > auto.y && Math.abs(otroAuto.x - auto.x) < 30) {
                        distancia = otroAuto.y - (auto.y + auto.height);
                        if (distancia < margenSeguridad) {
                            return true;
                        }
                    }
                    break;
                case "arriba":
                    if (otroAuto.y < auto.y && Math.abs(otroAuto.x - auto.x) < 30) {
                        distancia = auto.y - (otroAuto.y + otroAuto.height);
                        if (distancia < margenSeguridad) {
                            return true;
                        }
                    }
                    break;
            }
        }
    }
    
    return false; // No hay colisión
}



 
function reiniciarAuto(auto) {
    // Instead of resetting the auto to its initial position,
    // we'll remove it from the autos array
    const index = autos.indexOf(auto);
    if (index > -1) {
        autos.splice(index, 1);
        console.log(`Auto removed. Cars remaining: ${autos.length}`);
    }
}







// Update the moverAuto function to remove cars when they reach the canvas edge
// instead of restarting them
function moverAuto(auto) {
    const carrilInicio = carriles[auto.carrilInicio];
    const carrilDestino = carriles[auto.carrilDestino];
    
    // Guardar posición actual por si hay que revertir movimiento
    const posXAnterior = auto.x;
    const posYAnterior = auto.y;
    
    // Verificar si el auto debe detenerse en el semáforo
    let debeDetenerse = false;
    const distanciaSeguridadAmarillo = 80;
    
    // Determinar qué semáforo afecta a este auto según su dirección y posición
    let semaforoRelevante = '';
    
    if (auto.carrilInicio <= 4) { // Carriles 1-4 (oeste a este)
        semaforoRelevante = 'S1';
    } else if (auto.carrilInicio <= 8) { // Carriles 5-8 (este a oeste)
        semaforoRelevante = 'S3';
    } else if (auto.carrilInicio <= 12) { // Carriles 9-12 (norte a sur)
        semaforoRelevante = 'S2';
    } else { // Carriles 13-16 (sur a norte)
        semaforoRelevante = 'S4';
    }
    
    // Verificar si el semáforo está en rojo o amarillo (y estamos lejos)
    const esSemaforoActivo = (semaforos.fase === parseInt(semaforoRelevante.charAt(1)));
    const estadoSemaforo = esSemaforoActivo ? semaforos.estado : 'rojo';
    
    if (estadoSemaforo === 'rojo') {
        // Si se acerca a la intersección
        if (auto.direccion === "derecha" && auto.x < interseccion.x && auto.x + auto.width >= interseccion.x - 5) {
            debeDetenerse = true;
        } else if (auto.direccion === "izquierda" && auto.x > interseccion.x + interseccion.width && 
                  auto.x <= interseccion.x + interseccion.width + 5) {
            debeDetenerse = true;
        } else if (auto.direccion === "abajo" && auto.y < interseccion.y && auto.y + auto.height >= interseccion.y - 5) {
            debeDetenerse = true;
        } else if (auto.direccion === "arriba" && auto.y > interseccion.y + interseccion.height && 
                  auto.y <= interseccion.y + interseccion.height + 5) {
            debeDetenerse = true;
        }
    } else if (estadoSemaforo === 'amarillo') {
        // Lógica para amarillo (detenerse si está lejos de la intersección)
        if (auto.direccion === "derecha" && auto.x < interseccion.x && 
            auto.x + auto.width >= interseccion.x - distanciaSeguridadAmarillo &&
            auto.x + auto.width < interseccion.x - 20) {
            debeDetenerse = true;
        } else if (auto.direccion === "izquierda" && auto.x > interseccion.x + interseccion.width && 
                  auto.x <= interseccion.x + interseccion.width + distanciaSeguridadAmarillo &&
                  auto.x > interseccion.x + interseccion.width + 20) {
            debeDetenerse = true;
        } else if (auto.direccion === "abajo" && auto.y < interseccion.y && 
                  auto.y + auto.height >= interseccion.y - distanciaSeguridadAmarillo &&
                  auto.y + auto.height < interseccion.y - 20) {
            debeDetenerse = true;
        } else if (auto.direccion === "arriba" && auto.y > interseccion.y + interseccion.height && 
                  auto.y <= interseccion.y + interseccion.height + distanciaSeguridadAmarillo &&
                  auto.y > interseccion.y + interseccion.height + 20) {
            debeDetenerse = true;
        }
    }
    
    if (debeDetenerse) {
        return;
    }

    // Si el auto no ha girado aún
    if (!auto.girado) {
        // Mover según dirección inicial
        switch (auto.direccion) {
            case "derecha":
                auto.x += auto.speed;
                // Detectar si llegamos a la posición X del carril destino
                if (auto.x >= carrilDestino.x && auto.carrilDestino > 8) {
                    decidirGiro(auto);
                }
                // Si el auto pasa la intersección sin girar, eliminarlo en vez de reiniciarlo
                else if (auto.x > canvas.width) {
                    reiniciarAuto(auto);
                    return; // Salir para evitar más procesamiento con un auto eliminado
                }
                break;
                
            case "izquierda":
                auto.x -= auto.speed;
                // Detectar si llegamos a la posición X del carril destino
                if (auto.x <= carrilDestino.x && auto.carrilDestino > 8) {
                    decidirGiro(auto);
                }
                // Si el auto pasa la intersección sin girar, eliminarlo
                else if (auto.x < -auto.width) {
                    reiniciarAuto(auto);
                    return;
                }
                break;
                
            case "abajo":
                auto.y += auto.speed;
                // Detectar si llegamos a la posición Y del carril destino
                if (auto.y >= carrilDestino.y && auto.carrilDestino <= 8) {
                    decidirGiro(auto);
                }
                // Si el auto pasa la intersección sin girar, eliminarlo
                else if (auto.y > canvas.height) {
                    reiniciarAuto(auto);
                    return;
                }
                break;
                
            case "arriba":
                auto.y -= auto.speed;
                // Detectar si llegamos a la posición Y del carril destino
                if (auto.y <= carrilDestino.y && auto.carrilDestino <= 8) {
                    decidirGiro(auto);
                }
                // Si el auto pasa la intersección sin girar, eliminarlo
                else if (auto.y < -auto.height) {
                    reiniciarAuto(auto);
                    return;
                }
                break;
        }
    } 
    // El auto ya giró y está en dirección a su destino
    else {
        switch (auto.direccion) {
            case "derecha":
                auto.x += auto.speed;
                if (auto.x > canvas.width) {
                    reiniciarAuto(auto);
                    return;
                }
                break;
                
            case "izquierda":
                auto.x -= auto.speed;
                if (auto.x < -auto.width) {
                    reiniciarAuto(auto);
                    return;
                }
                break;
                
            case "abajo":
                auto.y += auto.speed;
                if (auto.y > canvas.height) {
                    reiniciarAuto(auto);
                    return;
                }
                break;
                
            case "arriba":
                auto.y -= auto.speed;
                if (auto.y < -auto.height) {
                    reiniciarAuto(auto);
                    return;
                }
                break;
        }
    }
    
    // Verificar colisiones después de mover
    if (detectarColisiones(auto)) {
        // Si hay colisión, revertir el movimiento
        auto.x = posXAnterior;
        auto.y = posYAnterior;
    }
}



// Add this function to display how many cars remain
function mostrarContadorAutos() {
    ctx.fillStyle = "white";
    ctx.font = "16px Arial";
    ctx.fillText(`Autos restantes: ${autos.length}`, 10, 30);
    
    // Mostrar mensaje cuando no queden autos
    if (autos.length === 0) {
        ctx.fillStyle = "rgba(0,0,0,0.7)";
        ctx.fillRect(canvas.width/2 - 150, canvas.height/2 - 40, 300, 80);
        ctx.fillStyle = "white";
        ctx.font = "24px Arial";
        ctx.fillText("Simulación completada", canvas.width/2 - 120, canvas.height/2);
        ctx.font = "16px Arial";
        ctx.fillText("No quedan autos en la simulación", canvas.width/2 - 120, canvas.height/2 + 25);
    }
}







// Modifica el objeto semaforos para incluir tiempos personalizados por fase
const semaforos = {
    fase: 1, // Fases 1, 2, 3, 4
    estado: 'verde', // 'verde', 'amarillo', 'rojo'
    tiempoCambio: {
        verde: 8000,      // 8 segundos en verde (valor por defecto)
        amarillo: 2000,   // 2 segundos en amarillo (valor por defecto)
        
        // Tiempos personalizados por fase (en milisegundos)
        fase1Verde: 8000,
        fase2Verde: 8000,
        fase3Verde: 8000,
        fase4Verde: 8000
    },
    usarTiemposPersonalizados: false,
    ultimoCambio: 0
};






// Función para configurar los controles de tiempo
function configurarControlesTiempo() {
    const tiempoVerde = document.getElementById('tiempoVerde');
    const valorVerde = document.getElementById('valorVerde');
    const tiempoAmarillo = document.getElementById('tiempoAmarillo');
    const valorAmarillo = document.getElementById('valorAmarillo');
    const tiemposPersonalizados = document.getElementById('tiemposPersonalizados');
    
    const tiempoFase1 = document.getElementById('tiempoFase1');
    const valorFase1 = document.getElementById('valorFase1');
    const tiempoFase2 = document.getElementById('tiempoFase2');
    const valorFase2 = document.getElementById('valorFase2');
    const tiempoFase3 = document.getElementById('tiempoFase3');
    const valorFase3 = document.getElementById('valorFase3');
    const tiempoFase4 = document.getElementById('tiempoFase4');
    const valorFase4 = document.getElementById('valorFase4');
    
    // Actualizar tiempos generales
    tiempoVerde.addEventListener('input', function() {
        const valor = parseInt(this.value);
        valorVerde.textContent = valor;
        semaforos.tiempoCambio.verde = valor * 1000; // Convertir a milisegundos
        
        // Actualizar también los valores específicos si no se han personalizado
        if (!semaforos.usarTiemposPersonalizados) {
            semaforos.tiempoCambio.fase1Verde = valor * 1000;
            semaforos.tiempoCambio.fase2Verde = valor * 1000;
            semaforos.tiempoCambio.fase3Verde = valor * 1000;
            semaforos.tiempoCambio.fase4Verde = valor * 1000;
            
            // Actualizar sliders
            tiempoFase1.value = valor;
            valorFase1.textContent = valor;
            tiempoFase2.value = valor;
            valorFase2.textContent = valor;
            tiempoFase3.value = valor;
            valorFase3.textContent = valor;
            tiempoFase4.value = valor;
            valorFase4.textContent = valor;
        }
    });
    
    tiempoAmarillo.addEventListener('input', function() {
        const valor = parseFloat(this.value);
        valorAmarillo.textContent = valor;
        semaforos.tiempoCambio.amarillo = valor * 1000; // Convertir a milisegundos
    });
    
    // Gestionar tiempos específicos por fase
    tiempoFase1.addEventListener('input', function() {
        const valor = parseInt(this.value);
        valorFase1.textContent = valor;
        semaforos.tiempoCambio.fase1Verde = valor * 1000;
    });
    
    tiempoFase2.addEventListener('input', function() {
        const valor = parseInt(this.value);
        valorFase2.textContent = valor;
        semaforos.tiempoCambio.fase2Verde = valor * 1000;
    });
    
    tiempoFase3.addEventListener('input', function() {
        const valor = parseInt(this.value);
        valorFase3.textContent = valor;
        semaforos.tiempoCambio.fase3Verde = valor * 1000;
    });
    
    tiempoFase4.addEventListener('input', function() {
        const valor = parseInt(this.value);
        valorFase4.textContent = valor;
        semaforos.tiempoCambio.fase4Verde = valor * 1000;
    });
    
    // Toggle para usar tiempos personalizados
    tiemposPersonalizados.addEventListener('change', function() {
        semaforos.usarTiemposPersonalizados = this.checked;
    });
}

// Llamar a esta función después de que el DOM esté listo
window.addEventListener('DOMContentLoaded', configurarControlesTiempo);

// Modificar la función actualizarSemaforos para usar tiempos personalizados por fase
function actualizarSemaforos() {
    const tiempoActual = Date.now();
    const tiempoTranscurrido = tiempoActual - semaforos.ultimoCambio;
    
    // Determinar el tiempo de verde según la fase actual
    let tiempoVerde = semaforos.tiempoCambio.verde;
    if (semaforos.usarTiemposPersonalizados) {
        switch(semaforos.fase) {
            case 1: tiempoVerde = semaforos.tiempoCambio.fase1Verde; break;
            case 2: tiempoVerde = semaforos.tiempoCambio.fase2Verde; break;
            case 3: tiempoVerde = semaforos.tiempoCambio.fase3Verde; break;
            case 4: tiempoVerde = semaforos.tiempoCambio.fase4Verde; break;
        }
    }
    
    // Lógica para cambiar el estado de los semáforos
    if (semaforos.estado === 'verde' && tiempoTranscurrido > tiempoVerde) {
        // Cambiar a amarillo
        semaforos.estado = 'amarillo';
        semaforos.ultimoCambio = tiempoActual;
    } 
    else if (semaforos.estado === 'amarillo' && tiempoTranscurrido > semaforos.tiempoCambio.amarillo) {
        // Cambiar a la siguiente fase
        semaforos.estado = 'verde';
        semaforos.fase = (semaforos.fase % 4) + 1; // Ciclo entre 1-4
        semaforos.ultimoCambio = tiempoActual;
    }
}





 

// Función para dibujar semáforos
function dibujarSemaforos() {
    // Posiciones de los semáforos (ajustar según tu diseño)
    const posiciones = {
        S1: { x: interseccion.x - 40, y: interseccion.y - 40 },
        S2: { x: interseccion.x + interseccion.width + 25, y: interseccion.y - 40 },
        S3: { x: interseccion.x + interseccion.width + 25, y: interseccion.y + interseccion.height + 25 },
        S4: { x: interseccion.x - 40, y: interseccion.y + interseccion.height + 25 }
    };
    
    // Determinar el color de cada semáforo
    const colores = {
        S1: 'rojo',
        S2: 'rojo',
        S3: 'rojo',
        S4: 'rojo'
    };
    
    // Solo el semáforo de la fase actual puede estar en verde o amarillo
    colores['S' + semaforos.fase] = semaforos.estado;
    
    // Dibujar cada semáforo
    Object.keys(posiciones).forEach(key => {
        const pos = posiciones[key];
        let color;
        switch(colores[key]) {
            case 'verde': color = "green"; break;
            case 'amarillo': color = "yellow"; break;
            case 'rojo': color = "red"; break;
        }
        
        ctx.fillStyle = color;
        ctx.fillRect(pos.x, pos.y, 15, 15);
        
        // Opcional: etiqueta del semáforo
        ctx.fillStyle = "white";
        ctx.fillText(key, pos.x, pos.y - 5);
    });
}










 
        
// Función para decidir cómo girar en la intersección
function decidirGiro(auto) {
    const carrilDestino = carriles[auto.carrilDestino];
    
    // Marcar como girado para no repetir este proceso
    auto.girado = true;
    
    // Calcular la posición de giro según la dirección actual y el destino
    let puntoGiroX, puntoGiroY;
    
    // Si el auto viene de la izquierda o derecha (carril horizontal)
    if (auto.carrilInicio <= 8) {
        puntoGiroX = carrilDestino.x;
        
        // Si el auto viene de la izquierda
        if (auto.direccion === "derecha") {
            // Verificar si el punto de giro está después de la posición actual
            if (puntoGiroX < auto.x) {
                // Si ya pasamos el punto de giro, vamos al carril destino directamente
                auto.x = puntoGiroX;
            }
        } 
        // Si el auto viene de la derecha
        else if (auto.direccion === "izquierda") {
            // Verificar si el punto de giro está antes de la posición actual
            if (puntoGiroX > auto.x) {
                // Si ya pasamos el punto de giro, vamos al carril destino directamente
                auto.x = puntoGiroX;
            }
        }
        
        // Cambiar la dirección y posición del auto según el carril de destino
        auto.direccion = carrilDestino.direccion;
        
        // Si el destino es un carril vertical, ajustar dimensiones
        if (auto.carrilDestino > 8) {
            [auto.width, auto.height] = [auto.height, auto.width];
        }
    } 
    // Si el auto viene de arriba o abajo (carril vertical)
    else {
        puntoGiroY = carrilDestino.y;
        
        // Si el auto viene de arriba
        if (auto.direccion === "abajo") {
            // Verificar si el punto de giro está después de la posición actual
            if (puntoGiroY < auto.y) {
                // Si ya pasamos el punto de giro, vamos al carril destino directamente
                auto.y = puntoGiroY;
            }
        } 
        // Si el auto viene de abajo
        else if (auto.direccion === "arriba") {
            // Verificar si el punto de giro está antes de la posición actual
            if (puntoGiroY > auto.y) {
                // Si ya pasamos el punto de giro, vamos al carril destino directamente
                auto.y = puntoGiroY;
            }
        }
        
        // Cambiar la dirección y posición del auto según el carril de destino
        auto.direccion = carrilDestino.direccion;
        
        // Si el destino es un carril horizontal, ajustar dimensiones
        if (auto.carrilDestino <= 8) {
            [auto.width, auto.height] = [auto.height, auto.width];
        }
    }
    
    // Ajustar la posición exacta según el carril de destino
    if (auto.carrilDestino <= 8) {
        // Si el destino es horizontal, ajustar Y
        auto.y = carrilDestino.y;
    } else {
        // Si el destino es vertical, ajustar X
        auto.x = carrilDestino.x;
    }
}


 
// Modificar la función mostrarEstadoSemaforos para incluir información de tiempos
function mostrarEstadoSemaforos() {
    const estadoDiv = document.getElementById("estadoSemaforos");
    if (!estadoDiv) {
        const div = document.createElement("div");
        div.id = "estadoSemaforos";
        div.style.position = "absolute";
        div.style.top = "10px";
        div.style.right = "10px";
        div.style.backgroundColor = "rgba(0,0,0,0.7)";
        div.style.color = "white";
        div.style.padding = "10px";
        div.style.borderRadius = "5px";
        document.body.appendChild(div);
    }
    
    // Determinar tiempo restante para el cambio
    const tiempoActual = Date.now();
    const tiempoTranscurrido = tiempoActual - semaforos.ultimoCambio;
    let tiempoTotal = 0;
    
    if (semaforos.estado === 'verde') {
        if (semaforos.usarTiemposPersonalizados) {
            switch(semaforos.fase) {
                case 1: tiempoTotal = semaforos.tiempoCambio.fase1Verde; break;
                case 2: tiempoTotal = semaforos.tiempoCambio.fase2Verde; break;
                case 3: tiempoTotal = semaforos.tiempoCambio.fase3Verde; break;
                case 4: tiempoTotal = semaforos.tiempoCambio.fase4Verde; break;
            }
        } else {
            tiempoTotal = semaforos.tiempoCambio.verde;
        }
    } else { // amarillo
        tiempoTotal = semaforos.tiempoCambio.amarillo;
    }
    
    const tiempoRestante = Math.max(0, (tiempoTotal - tiempoTranscurrido) / 1000).toFixed(1);
    
    document.getElementById("estadoSemaforos").innerHTML = `
        <h3>Estado de Semáforos</h3>
        <p>Fase actual: ${semaforos.fase} (${semaforos.estado})</p>
        <p>Tiempo restante: ${tiempoRestante}s</p>
        <p>S1: ${semaforos.fase === 1 ? semaforos.estado : 'rojo'}</p>
        <p>S2: ${semaforos.fase === 2 ? semaforos.estado : 'rojo'}</p>
        <p>S3: ${semaforos.fase === 3 ? semaforos.estado : 'rojo'}</p>
        <p>S4: ${semaforos.fase === 4 ? semaforos.estado : 'rojo'}</p>
    `;
}



 

// Update the actualizar function to include our new counter
function actualizar() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    dibujarInterseccion();
    dibujarSemaforos();
    actualizarSemaforos();
    dibujarAutos();
    autos.forEach(moverAuto);
    mostrarEstadoSemaforos();
    mostrarContadorAutos(); // Add our new counter display
    
    // Continue the animation loop
    requestAnimationFrame(actualizar);
}



        actualizar();