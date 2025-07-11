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
    <title>LIBROS</title>

    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            font-family: 'Coolvetica', sans-serif;
            font-weight: 100;
        }

        html, body {
            background-color: rgb(247, 247, 247);
        }

        #menu {
            background-color: rgb(213, 213, 213);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        h2 {
            text-align: center;
            margin-top: 30px;
            font-weight: 300;
        }

        label {
            font-weight: 100;
        }

        .img-thumbnail {
            max-width: 100%;
            height: auto;
        }

        #sesUser {
            margin-right: 25px;
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
        <h3>LIBROS</h3>

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

    <!-- NUEVO LIBRO -->
    <h2>NUEVO LIBRO</h2>
    <div class="container mt-4">
        <div class="row">
            <!-- FORMULARIO PARA INSERCION DE LIBROS -->
            <div class="col-lg-8">
                <form class="row g-3">
                    <div class="col-md-6">
                        <label>ISBN:</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Nombre del Libro:</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>Ejemplar:</label>
                        <input type="number" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>Edición:</label>
                        <input type="number" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>Editorial:</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>Año:</label>
                        <input type="number" class="form-control" maxlength="4" oninput="this.value = this.value.slice(0,4);">
                    </div>
                    <div class="col-md-4">
                        <label>Autor:</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>País:</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Clasificación:</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Precio: $</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Asignado a:</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Días a préstamo:</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Etiquetas:</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Estante:</label>
                        <select class="form-select">
                            <option value="1">1</option><option value="2">2</option>
                            <option value="3">3</option><option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label>Descripción:</label>
                        <select class="form-select">
                            <option>EXCELENTE ESTADO</option>
                            <option>BUEN ESTADO</option>
                            <option>ESTADO REGULAR</option>
                            <option>MAL ESTADO</option>
                            <option>MUY MAL ESTADO</option>
                        </select>
                    </div>
                </form>
            </div>

            <!-- PORTADA DEL LIBRO -->
            <div class="col-lg-4 d-flex flex-column align-items-center">
                <img src="https://via.placeholder.com/200x280" alt="PORTADA DEL LIBRO" class="img-thumbnail mb-3">
                <div class="d-flex flex-column gap-2 w-100 px-3">
                    <button class="btn btn-dark w-100"><i class="bi bi-folder2-open"></i> Abrir</button>
                    <button class="btn btn-secondary w-100"><i class="bi bi-camera-fill"></i> Cámara</button>
                </div>
            </div>
        </div>
    </div>

    <!-- BUSCADOR DE LIBROS -->
    <h2 class="mt-5">BUSCADOR DE LIBROS</h2>
    <div class="container mt-3">
        <div class="row mb-3">
            <div class="col-md-4">
                <select class="form-select">
                    <option>Buscar por...</option>
                    <option>ISBN</option>
                    <option>Nombre del Libro</option>
                    <option>Autor</option>
                    <option>Editorial</option>
                    <option>Año</option>
                </select>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" placeholder="Escribe para buscar...">
            </div>
        </div>

        <!-- TABLA DONDE APARECERAN LOS LIBROS Y SE FILTRARAN MEDIANTE EL TIPO QUE SE ELIJA -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-success" >
                    <tr>
                        <th>ISBN</th><th>Nombre</th><th>Ejemplar</th><th>Edición</th>
                        <th>Editorial</th><th>Año</th><th>Autor</th><th>País</th>
                        <th>Clasificación</th><th>Precio</th><th>Asignado a</th>
                        <th>Días</th><th>Etiquetas</th><th>Estante</th><th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí puedes insertar registros desde PHP/MySQL -->
                    <tr>
                        <td>1234567890</td><td>Ejemplo</td><td>1</td><td>2</td>
                        <td>Editorial X</td><td>2024</td><td>Juan Pérez</td><td>México</td>
                        <td>ABC123</td><td>$200</td><td>Alumno A</td>
                        <td>5</td><td>Física, Ciencia</td><td>2</td><td>EXCELENTE ESTADO</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <br><br><br><br><br><br><br><br>

    <!-- Botón Cancelar en esquina inferior derecha -->
    <div style="position: fixed; bottom: 20px; right: 20px;">
        <button class="botonValidacion" onclick="window.location.href='../../index.php'">CANCELAR</button>
    </div>

    <script>
        /* BOTON SALIR */
        const userMenu = document.getElementById('userMenu');
        const dropdown = document.getElementById('dropdown');

        userMenu.addEventListener('click', () => {
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });
    </script>

</body>
</html>
