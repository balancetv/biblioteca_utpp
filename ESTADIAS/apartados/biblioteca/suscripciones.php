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
    <title>SUSCRIPCIONES</title>

    <!--
    ============================================================
    ===== FRONT-END DEVELOPED BY LUIS REY RAMIREZ MONTIJO  =====
    ===================== 06-MAY-2025 ==========================
    -->

    <style>
        * {
            font-family: 'Cal Sans', sans-serif;
            font-weight: 200;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            overflow-x: hidden;
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

        .formularioContenedor {
            margin: 40px auto;
            padding: 30px;
            max-width: 800px;
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }

        .formularioContenedor h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #2c3e50;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .filaFormulario {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .filaFormulario div {
            flex: 1;
            min-width: 200px;
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: 500;
            color: #34495e;
            margin-bottom: 5px;
        }

        input, select {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .tablaSuscripciones {
            max-width: 1000px;
            margin: 0 auto 60px auto;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #f3f3f3;
        }
    </style>
</head>
<body>
    <nav id="menu">
        <img src="https://utpp.sonora.edu.mx//images/2024/05/15/utpp_logo-svg-a-color.svg" height="50" alt="&nbsp;&nbsp;&nbsp;UTPP">
        <h2>SUSCRIPCIONES</h2>
        <div>
            <h4><?php echo $_SESSION['usuario']; ?></h4>
        </div>
    </nav>

    <div class="formularioContenedor">
        <h2>DATOS DE SUSCRIPCIÓN</h2>
        <form action="">
            <div class="filaFormulario">
                <div>
                    <label for="">Nombre</label>
                    <input type="text">
                </div>
                <div>
                    <label for="">Página</label>
                    <input type="text">
                </div>
            </div>

            <div class="filaFormulario">
                <div>
                    <label for="">Fecha de suscripción</label>
                    <input type="date">
                </div>
                <div>
                    <label for="">Fecha de vencimiento</label>
                    <input type="date">
                </div>
            </div>

            <div class="filaFormulario">
                <div>
                    <label for="">Estado</label>
                    <select>
                        <option value="">Activo</option>
                        <option value="">Suspendido</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

    <hr style="margin: 40px 0; border: none; border-top: 2px solid #ccc;">

    <h2 style="text-align: center; margin-bottom: 20px;">USUARIOS SUSCRITOS</h2>
    <div class="tablaSuscripciones">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Página</th>
                    <th>Fecha de Suscripción</th>
                    <th>Vence</th>
                    <th>Estatus</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Aquí se mostrará información desde la base de datos más adelante
                ?>
                <tr>
                    <td>Juan Pérez</td>
                    <td>example.com</td>
                    <td>2025-06-01</td>
                    <td>2025-12-01</td>
                    <td>Activo</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Botón Cancelar en esquina inferior derecha -->
    <div style="position: absolute; bottom: 20px; right: 20px;">
        <button class="botonValidacion" onclick="window.location.href='../../index.php'">CANCELAR</button>
    </div>
</body>
</html>
