<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALUMNOS</title>

    <!--
    ============================================================
    ===== FRONT-END DEVELOPED BY LUIS REY RAMIREZ MONTIJO  =====
    ===================== 06-MAY-2025 ==========================
    -->

    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            font-family: 'Cal Sans', sans-serif;
            font-weight: 200;
        }

        html, body {
            height: 100%;
            overflow-x: hidden;
            background-color:rgb(247, 247, 247);
        }

        #menu {
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

        .contenedorPrincipal {
            display: flex;
            justify-content: space-between;
            align-items: stretch;
            padding: 40px;
            gap: 30px;
            flex-wrap: wrap;
        }

        .formularioAlumno {
            flex: 2;
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .formularioAlumno h3 {
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .fotoAlumno {
            flex: 1;
            background: white;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
        }

        .fotoAlumno img {
            width: 100%;
            height: auto;
            max-height: 300px;
            object-fit: cover;
            border-radius: 5px;
            border: 2px solid #ccc;
            margin-bottom: 15px;
        }

        .fotoAlumno button {
            margin: 5px;
        }

        @media (max-width: 768px) {
            .contenedorPrincipal {
                flex-direction: column;
                align-items: center;
            }
        }

        .tabla-foto {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }

        #searchButtonDiv {
            width: 36px; 
            height: 36px; 
            background-color: black; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            border-radius: 5px;
        }

        h2 {
            margin-top: 30px;
            margin-bottom: -10px;
            text-align: center;
        }
        #userID {
        font-size: 17px;
        }

        #userIDOUT {
        font-size: 15px;
        }

    </style>
</head>
<body>
    <nav id="menu">
        <img src="https://utpp.sonora.edu.mx//images/2024/05/15/utpp_logo-svg-a-color.svg" height="50" alt="&nbsp;&nbsp;&nbsp;UTPP">
        <h3>ALUMNOS</h3>

        <div style="position: relative;">
            <div id="userMenu" style="cursor: pointer; user-select: none; border: 2px solid black ; padding: 5px 10px; border-radius: 5px 10px;box-shadow: 0 8px 16px rgba(0,0,0,0.15);">
                <h5 id="userID"style="margin: 0;"><?php echo $_SESSION['usuario']; ?></h5>
            </div>

            <div id="dropdown" style="display:none;position:absolute;right: 0;background-color: white;border: 1px solid #ccc;border-radius: 10px;box-shadow: 0 8px 16px rgba(0,0,0,0.15);z-index: 1000;">
                <a href="../../logout.php" style="
                    text-align: center;
                    width: 80px;
                    display: block;
                    padding: 5px 10px;
                    color: white;
                    background-color: rgb(255, 85, 85);
                    text-decoration: none;
                    border-radius: 10px 5px;
                    font-size: 0.8rem;
                " onmouseover="this.style.backgroundColor='rgb(235, 78, 78)'" onmouseout="this.style.backgroundColor='rgb(180,50,50)'">
                    SALIR
                </a>
            </div>
        </div>
    </nav>

    <H2>NUEVO ALUMNO</H2>

    <div class="contenedorPrincipal">
        <!-- Formulario Datos del Alumno -->
        <div class="formularioAlumno">
            <h4>Datos del Alumno</h4>
            <form class="row g-3">
                <div class="col-md-4">
                    <label>Numero de Control</label>
                    <input type="text" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Nombre</label>
                    <input type="text" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Apellido Paterno</label>
                    <input type="text" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Apellido Materno</label>
                    <input type="text" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Sexo</label>
                    <select class="form-select">
                        <option value="Masc">Masculino</option>
                        <option value="Fem">Femenino</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Teléfono</label>
                    <input type="text" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Correo</label>
                    <input type="email" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Carrera</label>
                    <input type="text" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Estatus</label>
                    <select class="form-select">
                        <option value="">Activo</option>
                        <option value="">Suspendido</option>
                    </select>
                </div>
            </form>
        </div>

        <!-- Foto y Botones -->
        <div class="fotoAlumno">
            <img src="" alt="FOTO ALUMNO">
            <div>
                <button class="btn btn-dark">
                    <i class="bi bi-folder2-open"></i> Abrir
                </button>
                <button class="btn btn-secondary">
                    <i class="bi bi-camera-fill"></i> Cámara
                </button>
            </div>
        </div>
    </div>

    <H2>BUSCADOR DE ALUMNOS</H2>

    <!-- Tabla de Datos del Alumno -->
    <div class="container mt-5">
        <h3 class="mb-3">Listado de Alumnos</h3>

        <!-- Buscador con ícono centrado -->
        <div class="mb-3 d-flex align-items-center" style="gap: 10px;">
            <div id="searchButtonDiv">
                <i id="searchButton" class="bi bi-search" style="color: white;"></i>
            </div>
            <input type="text" id="buscador" class="form-control" placeholder="Buscar por matrícula o nombre...">
        </div>





        <div class="table-responsive">
            <div class="table-responsive" style="max-height: 320px; overflow-y: auto;">
            <table class="table table-bordered table-striped align-middle" id="tablaAlumnos">
                <thead class="table-dark" style="position: sticky; top: 0; z-index: 10;">
                    <tr>
                        <th scope="col">Foto</th>
                        <th scope="col">Numero de Control</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido Paterno</th>
                        <th scope="col">Apellido Materno</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Carrera</th>
                        <th scope="col">Estatus</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="fotos/0001.jpg" alt="Juan" class="tabla-foto"></td>
                        <td>23304002</td>
                        <td>Juan</td>
                        <td>Pérez</td>
                        <td>López</td>
                        <td>M</td>
                        <td>6621234567</td>
                        <td>juan.perez@example.com</td>
                        <td>TI</td>
                        <td>Activo</td>
                    </tr>
                    <tr>
                        <td><img src="fotos/0001.jpg" alt="Juan" class="tabla-foto"></td>
                        <td>23314256</td>
                        <td>Juan</td>
                        <td>Pérez</td>
                        <td>López</td>
                        <td>M</td>
                        <td>6621234567</td>
                        <td>juan.perez@example.com</td>
                        <td>TI</td>
                        <td>Activo</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br><br><br><br><br><br>
    

    <!-- Botón Cancelar en esquina inferior derecha -->
    <div style="position: fixed; bottom: 20px; right: 20px;">
        <button class="botonValidacion" onclick="window.location.href='../../index.php'">CANCELAR</button>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script Buscador -->
    <script>
        document.getElementById('buscador').addEventListener('keyup', function () {
            const filtro = this.value.toLowerCase();
            const filas = document.querySelectorAll('#tablaAlumnos tbody tr');

            filas.forEach(fila => {
                const matricula = fila.children[1].textContent.toLowerCase(); // ID
                const nombre = fila.children[2].textContent.toLowerCase(); // Nombre
                const coincide = matricula.includes(filtro) || nombre.includes(filtro);
                fila.style.display = coincide ? '' : 'none';
            });
        });

        /* BOTON SALIR */
        const userMenu = document.getElementById('userMenu');
        const dropdown = document.getElementById('dropdown');

        userMenu.addEventListener('click', () => {
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });
    </script>
</body>
</html>
