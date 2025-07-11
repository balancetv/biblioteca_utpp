<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DEVOLUCION</title>

        <!--
    
    

        ============================================================
        ===== FRONT-END DEVELOPED BY LUIS REY RAMIREZ MONTIJO  =====
        ===================== 06-MAY-2025 ==========================
    
    
    
        -->

        
        <style>
            /* FUENTE DE LETRA */
        * {
            font-family: 'Cal Sans', sans-serif;
            font-weight: 200;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            overflow-x: hidden; /* Evita scroll horizontal */
        }

        .cal-sans-regular {
            font-family: "Cal Sans", sans-serif;
            font-weight: 200;
            font-style: normal;
        }
        #menu {      
            top: 0;                
            left: 0;               
            width: 100vw;          
            height: 100px;         
            background-color: rgb(213, 213, 213);
            display: flex;
            justify-content: space-between;
            align-items: center;   
            padding: 0 20px;               
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .botonValidacion {
            margin: 10px;
            padding: 20px;
            width: 120px;
            height: auto;
            border-radius: 20px;
            border: none;
            background-color: rgb(63, 63, 63);
            color: white;
            box-shadow: 0 7px 12px rgba(0, 0, 0, 0.1);
        }

        .botonValidacion:hover {
            cursor: pointer;
            background-color: rgb(54, 54, 54);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-4px);
        }

         .tab-container {
        position: relative;
        height: 48px;
        margin-top: 20px;
        border-bottom: 2px solid #ccc;
        }

        .tab {
            width: 250px;
            display: flex;
            justify-content: center;
            position: absolute;
            top: 0;
            transform: translateX(-50%);
            border-radius: 8px 8px 0 0;
            padding: 10px 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: white;
        }

        .tab[data-tab="tab1"] {
        left: 25%;
        background-color: rgb(228, 228, 228);
        color: black;
        }

        .tab[data-tab="tab2"] {
        left: 75%;
        background-color: rgb(228, 228, 228);
        color: black;
        }

        .tab.active {
        background-color: rgb(131, 131, 131);
        color: white;
        }

        .tab-content {
        display: none;
        padding: 20px;
        background: white;
        animation: fadeIn 0.4s ease;
        margin: 0 auto;
        max-width: 800px;
        }

        .tab-content.active {
            display: flex;
            aling-items: center;
            justify-content: center;
        }
        </style>
    </head>
    <body>
        <nav id="menu">
            <img src="https://utpp.sonora.edu.mx//images/2024/05/15/utpp_logo-svg-a-color.svg" height="50" alt="&nbsp;&nbsp;&nbsp;UTPP">
            <h2>DEVOLUCION</h2>
            <div>
                <h4><?php echo $_SESSION['usuario']; ?></h4>
            </div>
        </nav>
         <!-- Contenedor de pestañas -->
        <div class="tab-container">
            <div class="tab active" data-tab="tab1">POR ALUMNO</div>
            <div class="tab" data-tab="tab2">POR ISBN</div>
        </div>

        <!-- Contenido de las pestañas -->
        <!-- Contenido de las pestañas -->
        <div id="tab1" class="tab-content active">
            <!-- Contenedor general para POR ALUMNO -->
            <div style="display: flex; flex-direction: column; gap: 30px; width: 100%;">
                
                <!-- Sección del alumno -->
                <div class="alumno-section" style="display: flex; gap: 20px; width: 100%;">
                    <!-- Foto del alumno -->
                    <div style="width: 200px; height: 250px; background-color: #eee; display: flex; align-items: center; justify-content: center;">
                        <img src="" alt="FOTO ALUMNO" style="max-width: 100%; max-height: 100%;">
                    </div>

                    <!-- Datos del alumno -->
                    <div style="flex: 2;">
                        <h2>DATOS DEL ALUMNO</h2>
                        <form action="">
                            <label for="numControl">NUMERO DE CONTROL:</label><br>
                            <input type="number" id="numControl" name="numControl" style="width: 180px; padding: 5px;">
                        </form>
                        <h3>NOMBRE COMPLETO: <p>X X X X</p></h3>
                        <h3>TSU / LICENCIATURA: <p>X X X X</p></h3>
                    </div>
                </div>

                <!-- Sección del libro -->
                <div style="display: flex; gap: 20px; align-items: flex-start;">
                    <!-- Portada del libro -->
                    <div style="width: 200px; height: 250px; background-color: #eee; display: flex; align-items: center; justify-content: center;">
                        <img src="" alt="PORTADA LIBRO" style="max-width: 100%; max-height: 100%;">
                    </div>

                    <!-- Datos del libro -->
                    <div style="flex: 1;">
                        <h2 style="margin-top: 0;">DATOS DEL LIBRO</h2>
                        <div style="display: grid; grid-template-columns: auto auto auto; gap: 10px 40px;">
                        <!-- Fila 1 -->
                        <div><strong>ISBN:</strong><br>XXXX</div>
                        <div><strong>EJEMPLAR:</strong><br>XXXX</div>
                        <div><strong>FECHA DE PRÉSTAMO:</strong><br>XXXX</div>
                        
                        <!-- Fila 2 -->
                        <div><strong>NOMBRE DEL LIBRO:</strong><br>XXXX</div>
                        <div></div>
                        <div><strong>FECHA DE ENTREGA:</strong><br>XXXX</div>

                        <!-- Fila 3 -->
                        <div><strong>EDICIÓN:</strong><br>XXXX</div>
                        <div><strong>EDITORIAL:</strong><br>XXXX</div>
                        <div><strong>AUTOR:</strong><br>XXXX</div>
                        
                        <!-- Fila 4 -->
                        <div><strong>PAÍS:</strong><br>XXXX</div>
                        <div><strong>AÑO:</strong><br>XXXX</div>
                        <div><strong>CLASIFICACIÓN:</strong><br>XXXX</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="tab2" class="tab-content">
            <!-- Contenedor general para POR ALUMNO -->
            <div style="display: flex; flex-direction: column; gap: 30px; width: 100%;">
                <!-- Sección del libro -->
                <div style="display: flex; gap: 20px; align-items: flex-start;">
                    <!-- Portada del libro -->
                    <div style="width: 200px; height: 250px; background-color: #eee; display: flex; align-items: center; justify-content: center;">
                        <img src="" alt="PORTADA LIBRO" style="max-width: 100%; max-height: 100%;">
                    </div>

                    <!-- Datos del libro -->
                    <div style="flex: 1;">
                        <h2 style="margin-top: 0;">DATOS DEL LIBRO</h2>
                        <div style="display: grid; grid-template-columns: auto auto auto; gap: 10px 40px;">
                        <!-- Fila 1 -->
                        <div><strong>ISBN:</strong><br><form action=""><input style="padding: 5px;" width="100"type="numeric"></form></div>
                        <div><strong>EJEMPLAR:</strong><br>XXXX</div>
                        <div><strong>FECHA DE PRÉSTAMO:</strong><br>XXXX</div>
                        
                        <!-- Fila 2 -->
                        <div><strong>NOMBRE DEL LIBRO:</strong><br>XXXX</div>
                        <div></div>
                        <div><strong>FECHA DE ENTREGA:</strong><br>XXXX</div>

                        <!-- Fila 3 -->
                        <div><strong>EDICIÓN:</strong><br>XXXX</div>
                        <div><strong>EDITORIAL:</strong><br>XXXX</div>
                        <div><strong>AUTOR:</strong><br>XXXX</div>
                        
                        <!-- Fila 4 -->
                        <div><strong>PAÍS:</strong><br>XXXX</div>
                        <div><strong>AÑO:</strong><br>XXXX</div>
                        <div><strong>CLASIFICACIÓN:</strong><br>XXXX</div>
                        </div>
                    </div>
                </div>
                
                <!-- Sección del alumno -->
                <div class="alumno-section" style="display: flex; gap: 20px; width: 100%;">
                    <!-- Foto del alumno -->
                    <div style="width: 200px; height: 250px; background-color: #eee; display: flex; align-items: center; justify-content: center;">
                        <img src="" alt="FOTO ALUMNO" style="max-width: 100%; max-height: 100%;">
                    </div>

                    <!-- Datos del alumno -->
                    <div style="flex: 2;">
                        <h2>DATOS DEL ALUMNO</h2>
                        <h3>NUMERO DE CONTROL: <p>X X X X</p></h3>
                        <h3>NOMBRE COMPLETO: <p>X X X X</p></h3>
                        <h3>TSU / LICENCIATURA: <p>X X X X</p></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Script para control de pestañas -->
        <script>
            const tabs = document.querySelectorAll('.tab');
            const contents = document.querySelectorAll('.tab-content');

            tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Quitar clases activas
                tabs.forEach(t => t.classList.remove('active'));
                contents.forEach(c => c.classList.remove('active'));

                // Activar la pestaña y el contenido correspondiente
                tab.classList.add('active');
                document.getElementById(tab.dataset.tab).classList.add('active');
            });
            });
        </script>

            <!-- Botón Cancelar en esquina inferior derecha -->
            <div style="position: absolute; bottom: 20px; right: 20px;">
                <button class="botonValidacion" onclick="window.location.href='../../index.php'">CANCELAR</button>
            </div>
    </body>
</html>