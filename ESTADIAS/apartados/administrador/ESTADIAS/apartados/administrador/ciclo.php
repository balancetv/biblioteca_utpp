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

// Insertar ciclo
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['nuevo_ciclo'], $_POST['estatus_ciclo'])) {
    $nuevoCiclo = $conexion->real_escape_string($_POST['nuevo_ciclo']);
    $estatusCiclo = $conexion->real_escape_string($_POST['estatus_ciclo']);
    $conexion->query("INSERT INTO ciclo (ciclo, estatus) VALUES ('$nuevoCiclo', '$estatusCiclo')");
}

// Insertar periodo
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['periodo'], $_POST['estatus_periodo'], $_POST['ciclo_id'])) {
    $periodo = $conexion->real_escape_string($_POST['periodo']);
    $estatusPeriodo = $conexion->real_escape_string($_POST['estatus_periodo']);
    $cicloId = intval($_POST['ciclo_id']);
    $conexion->query("INSERT INTO periodo (cicloId, periodo, estatusPeriodo) VALUES ($cicloId, '$periodo', '$estatusPeriodo')");
}

// Obtener ciclos
$ciclos = [];
$resCiclo = $conexion->query("SELECT * FROM ciclo ORDER BY cicloId DESC");
if ($resCiclo && $resCiclo->num_rows > 0) {
    while ($fila = $resCiclo->fetch_assoc()) {
        $ciclos[] = $fila;
    }
}

// Obtener periodos
$periodos = [];
$resPeriodo = $conexion->query("SELECT p.*, c.ciclo FROM periodo p JOIN ciclo c ON p.cicloId = c.cicloId ORDER BY p.periodoId DESC");
if ($resPeriodo && $resPeriodo->num_rows > 0) {
    while ($fila = $resPeriodo->fetch_assoc()) {
        $periodos[] = $fila;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>CICLOS Y PERIODOS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        * { font-family: 'Coolvetica', sans-serif; font-weight: 300; }
        body { background-color: #f7f7f7; }
        #menu {
            background-color: rgb(213, 213, 213);
            padding: 20px; display: flex; justify-content: space-between;
            align-items: center; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .botonValidacion {
            margin: 10px; padding: 20px; width: 120px; border-radius: 20px;
            border: none; background-color: rgb(63, 63, 63); color: white;
            box-shadow: 0 7px 12px rgba(0, 0, 0, 0.1);
        }
        .botonValidacion:hover {
            background-color: rgb(54, 54, 54);
            transform: translateY(-4px);
        }
        .titulo-seccion { margin-top: 30px; margin-bottom: 15px; color: #333; }
        table { width: 100%; background-color: white; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f2f2f2; }
        .container-main { padding: 30px; }
    </style>
</head>
<body>
    <nav id="menu">
        <img src="https://utpp.sonora.edu.mx//images/2024/05/15/utpp_logo-svg-a-color.svg" height="50" alt="UTPP" />
        <h3>CICLOS Y PERIODOS</h3>
        <div style="position: relative;">
            <div id="userMenu" style="cursor: pointer; user-select: none; border: 2px solid black; padding: 5px 10px; border-radius: 5px 10px; box-shadow: 0 8px 16px rgba(0,0,0,0.15);">
                <h5 id="userID" style="margin: 0;"><?php echo htmlspecialchars($_SESSION['usuario']); ?></h5>
            </div>
            <div id="dropdown" style="display:none; position:absolute; right: 0; background-color: white; border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 8px 16px rgba(0,0,0,0.15); z-index: 1000;">
                <a href="../../logout.php" style="text-align: center; width: 80px; display: block;
                    padding: 5px 10px; color: white;
                    background-color: rgb(255, 85, 85); text-decoration: none;
                    border-radius: 10px 5px; font-size: 0.8rem;"
                    onmouseover="this.style.backgroundColor='rgb(235, 78, 78)'"
                    onmouseout="this.style.backgroundColor='rgb(180,50,50)'">SALIR</a>
            </div>
        </div>
    </nav>

    <div class="container container-main">
        <h4 class="titulo-seccion">Nuevo Ciclo</h4>
        <form method="POST">
            <div class="mb-3">
                <input type="text" name="nuevo_ciclo" class="form-control" placeholder="Ciclo (ej. 2025-1)" required />
            </div>
            <div class="mb-4">
                <select name="estatus_ciclo" class="form-select" required>
                    <option value="" disabled selected>Estatus</option>
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>
            </div>
            <button type="submit" class="botonValidacion">Guardar Ciclo</button>
        </form>

        <h4 class="titulo-seccion">Nuevo Periodo</h4>
        <form method="POST">
            <div class="mb-3">
                <input type="text" name="periodo" class="form-control" placeholder="Periodo (ej. Enero-Junio)" required />
            </div>
            <div class="mb-3">
                <select name="ciclo_id" class="form-select" required>
                    <option value="" disabled selected>Seleccione un ciclo</option>
                    <?php foreach ($ciclos as $c): ?>
                        <option value="<?php echo $c['cicloId']; ?>"><?php echo $c['ciclo']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4">
                <select name="estatus_periodo" class="form-select" required>
                    <option value="" disabled selected>Estatus del periodo</option>
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>
            </div>
            <button type="submit" class="botonValidacion">Guardar Periodo</button>
        </form>

        <h4 class="titulo-seccion">Listado de Ciclos</h4>
        <table class="table table-hover">
            <thead>
                <tr><th>ID</th><th>Ciclo</th><th>Estatus</th></tr>
            </thead>
            <tbody>
                <?php foreach ($ciclos as $c): ?>
                    <tr>
                        <td><?php echo $c['cicloId']; ?></td>
                        <td><?php echo $c['ciclo']; ?></td>
                        <td><?php echo $c['estatus']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h4 class="titulo-seccion">Listado de Periodos</h4>
        <table class="table table-hover">
            <thead>
                <tr><th>ID</th><th>Ciclo</th><th>Periodo</th><th>Estatus</th></tr>
            </thead>
            <tbody>
                <?php foreach ($periodos as $p): ?>
                    <tr>
                        <td><?php echo $p['periodoId']; ?></td>
                        <td><?php echo $p['ciclo']; ?></td>
                        <td><?php echo $p['periodo']; ?></td>
                        <td><?php echo $p['estatusPeriodo']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div style="position: fixed; bottom: 20px; right: 20px;">
        <button class="botonValidacion" onclick="window.location.href='../../index.php'">Cancelar</button>
    </div>

    <br><br><br><br>

    <script>
        const userMenu = document.getElementById('userMenu');
        const dropdown = document.getElementById('dropdown');
        userMenu.addEventListener('click', () => {
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });
    </script>
</body>
</html>

<?php $conexion->close(); ?>
