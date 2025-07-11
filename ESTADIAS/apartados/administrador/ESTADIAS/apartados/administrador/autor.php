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
    <title>Autores</title>

    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            font-family: 'Coolvetica', sans-serif;
            font-weight: 300;
        }

        body {
            background-color: #f7f7f7;
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

        .titulo-seccion {
            margin-top: 30px;
            margin-bottom: 15px;
            
            color: #333;
        }

        table {
            width: 100%;
            background-color: white;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .container-main {
            padding: 30px;
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
        <h3>AUTORES</h3>

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

    <div class="container container-main">
        <h4 class="titulo-seccion">Nuevo Autor(a)</h4>
        <div class="mb-4">
            <input type="text" class="form-control" placeholder="Nombre del autor">
        </div>

        <h4 class="titulo-seccion">Buscar un(a) Autor(a)</h4>
        <div class="mb-4">
            <input type="text" class="form-control" placeholder="Buscar por nombre">
        </div>

        <h4 class="titulo-seccion">Listado de Autores</h4>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Autor(a) </th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí puedes insertar los autores con PHP -->
            </tbody>
        </table>
    </div>

    <!-- Botón Cancelar -->
    <div style="position: fixed; bottom: 20px; right: 20px;">
        <button class="botonValidacion" onclick="window.location.href='../../index.php'">Cancelar</button>
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
