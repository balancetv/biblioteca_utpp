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

// INSERTAR DEPENDENCIA
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['direccionId'], $_POST['id'], $_POST['nombre']) && !isset($_POST['buscar'])) {
    $direccionId = intval($_POST['direccionId']);
    $id = intval($_POST['id']);
    $nombre = $conexion->real_escape_string($_POST['nombre']);

    $conexion->query("INSERT INTO dependencias (dependenciaId, nombre, direccionId) VALUES ('$id', '$nombre', '$direccionId')");
}

// CONSULTAR DIRECCIONES PARA SELECT
$direcciones = [];
$consultaDirs = $conexion->query("SELECT direccionId, nombreDireccion FROM direcciones");
while ($fila = $consultaDirs->fetch_assoc()) {
    $direcciones[] = $fila;
}

// CONSULTAR DEPENDENCIAS
$dependencias = [];
$busqueda = "";
$filtro = "";

if (isset($_POST['buscar'])) {
    $busqueda = $conexion->real_escape_string($_POST['buscar']);
    $filtro = "WHERE d.nombre LIKE '%$busqueda%' OR d.dependenciaId LIKE '%$busqueda%' OR dr.nombreDireccion LIKE '%$busqueda%'";
}

$sql = "SELECT d.dependenciaId, d.nombre, dr.nombreDireccion 
        FROM dependencias d 
        JOIN direcciones dr ON d.direccionId = dr.direccionId 
        $filtro 
        ORDER BY d.dependenciaId ASC";
$resultado = $conexion->query($sql);
if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $dependencias[] = $fila;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>DEPENDENCIAS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        * { font-family: 'Coolvetica', sans-serif; font-weight: 300; }
        body { background-color: #f7f7f7; }
        #menu {
            background-color: rgb(213, 213, 213);
            padding: 20px; display: flex;
            justify-content: space-between; align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .botonValidacion {
            margin: 10px; padding: 15px 25px;
            border-radius: 20px; border: none;
            background-color: rgb(63, 63, 63); color: white;
            box-shadow: 0 7px 12px rgba(0, 0, 0, 0.1);
            font-size: 1rem;
        }
        .botonValidacion:hover {
            background-color: rgb(54, 54, 54);
            transform: translateY(-3px);
        }
        .titulo-seccion { margin-top: 30px; margin-bottom: 20px; color: #333; }
        table {
            width: 100%; background-color: white;
            border-collapse: collapse; margin-top: 20px;
        }
        th, td {
            padding: 12px; border: 1px solid #ddd;
            text-align: left;
        }
        th { background-color: #f2f2f2; }
        .container-main { padding: 30px; }
        label { font-weight: 500; margin-top: 10px; }
        select, input[type="text"], input[type="number"] {
            margin-bottom: 15px;
        }
        .form-section {
            background-color: #ffffff;
            padding: 20px; border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>
<nav id="menu">
    <img src="https://utpp.sonora.edu.mx//images/2024/05/15/utpp_logo-svg-a-color.svg" height="50" alt="UTPP" />
    <h3>DEPENDENCIAS</h3>
    <div style="position: relative;">
        <div id="userMenu" style="cursor: pointer; user-select: none; border: 2px solid black; padding: 5px 10px; border-radius: 5px 10px; box-shadow: 0 8px 16px rgba(0,0,0,0.15);">
            <h5 id="userID" style="margin: 0;"><?php echo htmlspecialchars($_SESSION['usuario']); ?></h5>
        </div>
        <div id="dropdown" style="display:none; position:absolute; right: 0; background-color: white; border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 8px 16px rgba(0,0,0,0.15); z-index: 1000;">
            <a href="../../logout.php" style="
                text-align: center; width: 80px; display: block;
                padding: 5px 10px; color: white;
                background-color: rgb(255, 85, 85);
                text-decoration: none; border-radius: 10px 5px;
                font-size: 0.8rem;"
                onmouseover="this.style.backgroundColor='rgb(235, 78, 78)'"
                onmouseout="this.style.backgroundColor='rgb(180,50,50)'">SALIR</a>
        </div>
    </div>
</nav>

<div class="container container-main">
    <div class="form-section">
        <h4 class="titulo-seccion">Nueva Dependencia</h4>
        <form method="POST" action="">
            <div class="row">
                <div class="col-md-6">
                    <label for="direccionId">Dirección</label>
                    <select class="form-select" name="direccionId" required>
                        <option selected disabled>Seleccione una dirección</option>
                        <?php foreach ($direcciones as $dir): ?>
                            <option value="<?php echo $dir['direccionId']; ?>">
                                <?php echo htmlspecialchars($dir['nombreDireccion']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="id">ID Dependencia</label>
                    <input type="number" name="id" class="form-control" placeholder="Ej. 101" required />
                </div>
                <div class="col-md-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre de la dependencia" required />
                </div>
            </div>
            <div class="text-end mt-3">
                <button type="submit" class="botonValidacion">Guardar</button>
            </div>
        </form>
    </div>

    <h4 class="titulo-seccion">Buscar Dependencia</h4>
    <form method="POST" action="">
        <div class="mb-4">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar por dirección, ID o nombre" value="<?php echo htmlspecialchars($busqueda); ?>" />
        </div>
        <button type="submit" class="btn btn-secondary">Buscar</button>
    </form>

    <h4 class="titulo-seccion">Listado de Dependencias</h4>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Dirección</th>
            <th>ID</th>
            <th>Dependencia</th>
        </tr>
        </thead>
        <tbody>
        <?php if (count($dependencias) > 0): ?>
            <?php foreach ($dependencias as $dep): ?>
                <tr>
                    <td><?php echo htmlspecialchars($dep['nombreDireccion']); ?></td>
                    <td><?php echo htmlspecialchars($dep['dependenciaId']); ?></td>
                    <td><?php echo htmlspecialchars($dep['nombre']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3">No se encontraron dependencias.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
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
