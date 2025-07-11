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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>REPORTES</title>

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
      background-color: #f4f4f4;
    }

    #menu {
      width: 100%;
      height: 100px;
      background-color: rgb(213, 213, 213);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 20px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h2, h3, h4, label {
      margin-bottom: 10px;
      color: #333;
    }

    select, input[type="date"], input[type="text"] {
      padding: 10px;
      margin: 5px 0 15px 0;
      border-radius: 10px;
      border: 1px solid #ccc;
      width: 100%;
      display: block;
    }

    .radio-group {
      display: flex;
      flex-direction: column;
      margin: 10px 0 20px 0;
    }

    .radio-option {
      display: flex;
      align-items: center;
      margin-bottom: 8px;
    }

    .radio-option input[type="radio"] {
      margin-right: 10px;
    }

    .section {
      background-color: white;
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0 5px 10px rgba(0,0,0,0.05);
      width: 100%;
      box-sizing: border-box;
    }

    .botonImprimir {
      margin-top: 20px;
      padding: 10px;
      width: 100%;
      border-radius: 10px;
      border: none;
      background-color: rgb(63, 63, 63);
      color: white;
      font-size: 14px;
      box-shadow: 0 7px 12px rgba(0, 0, 0, 0.1);
    }

    .botonImprimir:hover {
      cursor: pointer;
      background-color: rgb(54, 54, 54);
      transform: translateY(-2px);
    }

    .contenedor-flex {
      display: flex;
      justify-content: space-between;
      gap: 20px;
      padding: 20px;
    }

    .contenedor-flex .section {
      flex: 1;
    }

    @media (max-width: 1024px) {
      .contenedor-flex {
        flex-direction: column;
      }

      .contenedor-flex .section {
        width: 100%;
      }
    }

    @media print {
      body * {
        visibility: hidden;
      }
      .printable {
        visibility: visible;
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
      }
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
            <img src="https://utpp.sonora.edu.mx//images/2024/05/15/utpp_logo-svg-a-color.svg" height="50" alt="UTPP Logo">
            <h2>REPORTES</h2>
            <div>
                <h4><?php echo $_SESSION['usuario']; ?></h4>
            </div>
        </nav>

        <div class="contenedor-flex">
            <!-- Sección 1 -->
            <div class="section" id="periodo">
                <h3>Bitácora por período</h3>
                <label>Ciclo:</label>
                <select>
                    <option>2022</option><option>2023</option><option>2024</option><option>2025</option>
                </select>
                <label>Período:</label>
                <select>
                    <option>ENE - ABR</option><option>MAY - AGO</option><option>SEP - DIC</option>
                </select>
                <button class="botonImprimir" onclick="imprimirSeccion('periodo')">Imprimir</button>
            </div>

            <!-- Sección 2 -->
            <div class="section" id="rangoEspecifico">
                <h3>Rango de fecha</h3>
                <label>Del:</label>
                <input type="date" id="fechaInicio">
                <label>Al:</label>
                <input type="date" id="fechaFin">
                <div class="radio-group">
                    <div class="radio-option"><input type="radio" name="tipoReporte" checked> General</div>
                    <div class="radio-option"><input type="radio" name="tipoReporte"> Autor más consultado</div>
                    <div class="radio-option"><input type="radio" name="tipoReporte"> Carrera</div>
                    <div class="radio-option"><input type="radio" name="tipoReporte"> Libro más usado</div>
                </div>
                <button class="botonImprimir" onclick="imprimirSeccion('rangoEspecifico')">Imprimir</button>
            </div>

            <!-- Sección 3 -->
            <div class="section" id="porUsuario">
                <h3>Bitácora por usuario</h3>
                <label>Del:</label>
                <input type="date" id="fechaInicioU">
                <label>Al:</label>
                <input type="date" id="fechaFinU">
                    <div class="radio-group">
                        <div class="radio-option"><input type="radio" name="tipoUsuario" checked> Administrativo/Docente</div>
                        <div class="radio-option"><input type="radio" name="tipoUsuario"> Alumno</div>
                    </div>
                <label>Buscar por nombre:</label>
                <input type="text" placeholder="Nombre del usuario...">
                <button class="botonImprimir" onclick="imprimirSeccion('porUsuario')">Imprimir</button>
            </div>
        </div>

        <script>
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('fechaInicio').value = today;
            document.getElementById('fechaFin').value = today;
            document.getElementById('fechaInicioU').value = today;
            document.getElementById('fechaFinU').value = today;

            function imprimirSeccion(id) {
            const contenido = document.getElementById(id).cloneNode(true);
            contenido.classList.add('printable');
            const ventana = window.open('', '', 'height=600,width=800');
            ventana.document.write('<html><head><title>Imprimir</title><style>');
            ventana.document.write('body { font-family: Cal Sans; padding: 20px; }');
            ventana.document.write('</style></head><body>');
            ventana.document.body.appendChild(contenido);
            ventana.document.write('</body></html>');
            ventana.document.close();
            ventana.focus();
            ventana.print();
            ventana.close();
            }
        </script>

        <!-- Botón Cancelar en esquina inferior derecha -->
        <div style="position: absolute; bottom: 20px; right: 20px;">
           <button class="botonValidacion" onclick="window.location.href='../../index.php'">CANCELAR</button>
        </div>
    </body>
</html>
