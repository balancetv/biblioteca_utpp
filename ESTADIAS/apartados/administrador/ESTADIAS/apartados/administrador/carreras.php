<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.html");
    exit();
}

// CONEXIÓN
$conexion = new mysqli("utpplib.ddns.net", "Luison", "particularmenteLuis12+1", "biblioteca");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// INSERTAR CARRERA
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'], $_POST['nombre'], $_POST['dependencia_id'])) {
    $id = intval($_POST['id']);
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $dependencia_id = intval($_POST['dependencia_id']);

    $conexion->query("INSERT INTO carreras (carreraId, nombreCarrera, dependenciaId) VALUES ($id, '$nombre', $dependencia_id)");
}



// CONSULTAR CARRERAS CON NOMBRE DE LA DEPENDENCIA
$carreras = [];
$sql = "SELECT c.carreraId, c.nombreCarrera, d.nombre AS nombreDependencia
        FROM carreras c
        JOIN dependencias d ON c.dependenciaId = d.dependenciaId
        ORDER BY c.carreraId DESC";
$resultado = $conexion->query($sql);
if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $carreras[] = $fila;
    }
}

// OBTENER DEPENDENCIAS PARA EL SELECT
$dependencias = [];
$resDep = $conexion->query("SELECT dependenciaId, nombre FROM dependencias ORDER BY nombre ASC");
if ($resDep && $resDep->num_rows > 0) {
    while ($dep = $resDep->fetch_assoc()) {
        $dependencias[] = $dep;
    }
}
?>

<!-- EL MISMO HTML DE TU PLANTILLA -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>CARRERAS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        * { font-family: 'Coolvetica', sans-serif; font-weight: 300; }
        body { background-color: #f7f7f7; }
        #menu {
            background-color: rgb(213, 213, 213);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .botonValidacion {
            margin: 10px; padding: 20px; width: 120px; border-radius: 20px;
            border: none; background-color: rgb(63, 63, 63); color: white;
            box-shadow: 0 7px 12px rgba(0, 0, 0, 0.1);
        }
        .botonValidacion:hover {
            cursor: pointer;
            background-color: rgb(54, 54, 54);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-4px);
        }
        .titulo-seccion { margin-top: 30px; margin-bottom: 15px; color: #333; }
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
        th { background-color: #f2f2f2; }
        .container-main { padding: 30px; }
        .scroll-table-container {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <nav id="menu">
        <img src="https://utpp.sonora.edu.mx//images/2024/05/15/utpp_logo-svg-a-color.svg" height="50" alt="UTPP" />
        <h3>CARRERAS</h3>
        <div style="position: relative;">
            <div id="userMenu" style="cursor: pointer; user-select: none; border: 2px solid black; padding: 5px 10px; border-radius: 5px 10px; box-shadow: 0 8px 16px rgba(0,0,0,0.15);">
                <h5 id="userID" style="margin: 0;"><?php echo htmlspecialchars($_SESSION['usuario']); ?></h5>
            </div>
            <div id="dropdown" style="display:none; position:absolute; right: 0; background-color: white; border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 8px 16px rgba(0,0,0,0.15); z-index: 1000;">
                <a href="../../logout.php" style="
                    text-align: center;
                    width: 80px;
                    display: block;
                    padding: 5px 10px;
                    color: white;
                    background-color: rgb(255, 85, 85);
                    text-decoration: none;
                    border-radius: 10px 5px;
                    font-size: 0.8rem;"
                    onmouseover="this.style.backgroundColor='rgb(235, 78, 78)'"
                    onmouseout="this.style.backgroundColor='rgb(180,50,50)'">SALIR</a>
            </div>
        </div>
    </nav>

    <div class="container container-main">
        <h4 class="titulo-seccion">Nueva Carrera</h4>
        <form method="POST" action="">
            <div class="mb-3">
                <input type="number" name="id" class="form-control" placeholder="ID de la carrera (manual)" required />
            </div>
            <div class="mb-3">
                <input type="text" name="nombre" class="form-control" placeholder="Nombre de la carrera" required />
            </div>
            <div class="mb-4">
                <select name="dependencia_id" class="form-select" required>
                    <option value="" disabled selected>Seleccione una dependencia</option>
                    <?php foreach ($dependencias as $dep): ?>
                        <option value="<?php echo $dep['dependenciaId']; ?>"><?php echo htmlspecialchars($dep['nombre']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="botonValidacion">Guardar</button>
        </form>

        <h4 class="titulo-seccion">Listado de Carreras</h4>
        <div class="scroll-table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Carrera</th>
                        <th>Dependencia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($carreras as $carrera): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($carrera['carreraId']); ?></td>
                            <td><?php echo htmlspecialchars($carrera['nombreCarrera']); ?></td>
                            <td><?php echo htmlspecialchars($carrera['nombreDependencia']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div style="position: fixed; bottom: 20px; right: 20px;">
        <button class="botonValidacion" onclick="window.location.href='../../index.php'">Cancelar</button>
    </div>

    <script>
        const userMenu = document.getElementById('userMenu');
        const dropdown = document.getElementById('dropdown');
        userMenu.addEventListener('click', () => {
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });
    </script>
</body>
</html>
