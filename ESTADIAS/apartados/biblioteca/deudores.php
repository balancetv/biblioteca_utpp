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
        <title>DEUDORES</title>

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
            background-color: rgb(42, 158, 142);   
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

        #listaDeudores {
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }

        #contenedor {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.18);
            width: 90%;
            max-width: 1000px;
        }

        #contenedor h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #34495e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        thead tr:first-child {
            background-color:rgb(125, 9, 28);
            color: #ffffff;
        }

        thead tr:nth-child(2) {
            background-color: #ecf0f1;
            color: #2c3e50;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
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
    </style>
    </head>
    <body>
        <nav id="menu">
            <img src="https://utpp.sonora.edu.mx//images/2024/05/15/utpp_logo-svg-a-color.svg" height="50" alt="&nbsp;&nbsp;&nbsp;UTPP">
            <h2>DEUDORES</h2>
            <div>
                <h4><?php echo $_SESSION['usuario']; ?></h4>
            </div>
        </nav>

        <div id="listaDeudores">
            
            <div id="contenedor">
                <h2>LISTA DE DEUDORES</h2>
                    <div id="tabla">
                        <table>
                            <thead>
                                <tr>
                                    <th>NUMERO&nbsp;&nbsp;&nbsp;DE&nbsp;&nbsp;&nbsp;CONTROL</th>
                                    <th>NOMBRE&nbsp;&nbsp;&nbsp;COMPLETO</th>
                                    <th>CARRERA</th>
                                    <th>ISBN</th>
                                    <th>NOMBRE&nbsp;&nbsp;&nbsp;DEL&nbsp;&nbsp;&nbsp;LIBRO</th>
                                </tr>
                                <tr>
                                    <th>12345678</th>
                                    <th>X X X X</th>
                                    <th>X X X X</th>
                                    <th>X X X X</th>
                                    <th>X X X X</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
            </div>
        </div>

        <!-- Botón Cancelar en esquina inferior derecha -->
        <div style="position: absolute; bottom: 20px; right: 20px;">
            <button class="botonValidacion" onclick="window.location.href='../../index.php'">IR A INICIO</button>
        </div>

    </body>
</html>