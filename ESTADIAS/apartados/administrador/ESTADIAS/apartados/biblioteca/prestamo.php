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
    <title>PRESTAMO</title>

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

        .botonBuscar {
            width: 115px;
            height: 22px;
            border-radius: 7px;
            border: none;
            background-color: rgb(0, 139, 74);
            color: white;
        }

        #formularioPrestamo {
            display: flex;
            width: 100%;
            height: calc(100vh - 100px); /* Para usar toda la pantalla menos el menú */
        }

        #datosAlumnos,
        #datosLibros {
            width: 50%;
            padding: 20px;
            overflow-y: auto;
            border-right: 1px solid #ddd;
        }

        #datosLibros {
            border-right: none;
            border-left: 1px solid #ddd;
        }

        #datosAlumnos h3,
        #datosLibros h3 {
            text-align: center;
            background-color:rgb(2, 160, 139);
            color: white;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        #datosAlumnos img,
        #datosLibros img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 10px auto;
            border-radius: 10px;
        }

        #numero, #numeroTarjeta{
            padding-left: 2px;
            width: auto;
        }

        .continuar {
            width: 85px;
            border-radius: 7px;
            border: none;
            background-color: rgb(2, 160, 139); 
            color: white;
        }

        .continuar:hover {
            cursor: pointer;
            background-color: rgb(0, 204, 177)
        }
    </style>
</head>
<body>
    <nav id="menu">
        <img src="https://utpp.sonora.edu.mx//images/2024/05/15/utpp_logo-svg-a-color.svg" height="50" alt="&nbsp;&nbsp;&nbsp;UTPP">
        <h2>PRESTAMO</h2>
        <div>
            <h4>
                <?php echo $_SESSION['usuario']; ?>
            </h4>
        </div>
    </nav>

    <!-- FORMULARIO PRINCIPAL -->
    <div id="formularioPrestamo">
        
        <div id="datosAlumnos">
            <h3>DATOS DEL ALUMNO</h3>
            <hr><br>
            <form action="">
                <!-- SE INSERTA EL NUMERO DE CONTROL DEL ALUMNO PARA LA BUSQUEDA DE DATOS -->
                <label for="numeroDeControl">Numero de Control:</label>
                <input type="text" id="numero" maxlength="8" pattern="\d{8}" placeholder="12345678" inputmode="numeric" autocomplete="off">
                <button type="submit" class="continuar" disabled>BUSCAR</button>
                <button type="submit" class="continuar" disabled>CONFIRMAR</button>
                <button type="submit" class="continuar" disabled>AGREGAR</button>
            </form>
            <!-- SE MUESTRA LA FOTOGRAFIA DEL ALUMNO -->
            <img id="fotoAlumno" src="" alt="FOTO ALUMNO">
            <!-- SE MUESTRA EL NOMBRE COMPLETO DEL ALUMNO -->
            <h4>NOMBRE COMPLETO DEL ALUMNO:</h4>
            <h6>X X X X</h6><br>
            <!-- SE MUESTRA EL NOMBRE DE LA CARRERA DEL ALUMNO-->
            <h4>TSU/LICENCIATURA</h4>
            <h6>X X X X</h6><br>
            <!-- SE MUESTRA EL CORREO DEL ALUMNO -->
            <h4>CORREO:</h4>
            <h6>X X X X</h6>
        </div>
        <div id="datosLibros">
            <h3>DATOS DEL LIBRO</h3>
            <hr><br>
            <form id="miFormulario" action="">
                <!-- SE INSERTA EL ISBN DEL LIBRO PARA LA BUSQUEDA DE DATOS -->
                <label for="librosISBN">ISBN del Libro</label>
                <input type="text" id="numeroTarjeta" name="numeroTarjeta" autocomplete="off" placeholder="123-" inputmode="numeric">
                <button type="submit" class="continuar" disabled>BUSCAR</button>
                <button type="submit" class="continuar" disabled>CONFIRMAR</button>
                <button type="submit" class="continuar" disabled>AGREGAR</button>
            </form>
            <!-- SE MUESTRA LA PORTADA DEL LIBRO -->
            <img id="portadaLibro" src="" alt="PORTADA LIBRO">
            <!-- SE MUESTRA EL NOMBRE DEL LIBRO -->
            <h4>NOMBRE DEL LIBRO:</h4>
            <h6>X X X X</h6><br>
            <!-- SE MUESTRA EL EJEMPLAR DEL LIBRO-->
            <h4>EJEMPLAR:</h4>
            <h6>X X X X</h6><br>
            <!-- SE MUESTRA LA CLASISIFICACION DEL LIBRO -->
            <h4>CLASIFICACION:</h4>
            <h6>X X X X</h6><br>
            <!-- SE DESPLIEGA UNA LISTA PARA EL NUMERO DE DIAS A PRESTAR -->
            <h4>DIAS A PRESTAR:</h4>
            <select name="diasPrestamo" id="diasPrestamo">
            <option value="2">2 días</option>
            <option value="4">4 días</option>
            <option value="6">6 días</option>
            <option value="8">8 días</option>
            <option value="10">10 días</option>
            </select>
        </div>

    </div>


    <script>
        // VALIDACIÓN DEL NÚMERO DE CONTROL (alumno)
        const numeroControl = document.getElementById('numero');
        const botonAlumno = document.querySelector('#datosAlumnos button');

        numeroControl.addEventListener('input', () => {
            numeroControl.value = numeroControl.value.replace(/\D/g, '');

            if (numeroControl.value.length > 8) {
                numeroControl.value = numeroControl.value.slice(0, 8);
            }

            botonAlumno.disabled = numeroControl.value.length !== 8;
        });

        numeroControl.form.addEventListener('submit', function (e) {
            if (numeroControl.value.length !== 8) {
                e.preventDefault();
                alert('El número debe tener exactamente 8 dígitos.');
            }
        });

        // FORMATEO DEL ISBN: guion automático tras los 3 dígitos, luego el usuario puede poner lo que quiera (guiones incluidos)
        const numeroTarjeta = document.getElementById('numeroTarjeta');

        numeroTarjeta.addEventListener('input', () => {
            let valor = numeroTarjeta.value.replace(/[^0-9\-]/g, ''); // permite números y guiones

            // Si ya tiene un guion tras los primeros 3 dígitos, no hace nada
            if (!valor.match(/^\d{3}-/)) {
                valor = valor.replace(/-/g, ''); // quita guiones si están mal colocados
                if (valor.length > 3) {
                    valor = valor.slice(0, 3) + '-' + valor.slice(3);
                }
            }

            numeroTarjeta.value = valor;
        });
    </script>


    <!-- Botón Cancelar en esquina inferior derecha -->
    <div style="position: absolute; bottom: 20px; right: 20px;">
        <button class="botonValidacion" onclick="window.location.href='../../index.php'">CANCELAR</button>
    </div>
</body>
</html>
