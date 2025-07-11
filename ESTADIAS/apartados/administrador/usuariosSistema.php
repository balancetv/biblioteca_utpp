<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.html");
    exit();
}

$conexion = new mysqli("utpplib.ddns.net", "Luison", "particularmenteLuis12+1", "biblioteca");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$direcciones = $conexion->query("SELECT direccionId, nombreDireccion FROM direcciones");
$dependenciasData = $conexion->query("SELECT dependenciaId, nombre, direccionId FROM dependencias");
$dependenciasPorDireccion = [];
while ($row = $dependenciasData->fetch_assoc()) {
    $dependenciasPorDireccion[$row['direccionId']][] = $row;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $direccionId = $_POST['direccion'];
    $dependenciaId = $_POST['dependencia'];
    $usuario = $_POST['usuario'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];
    $nivel = $_POST['nivel_usuario'];
    $estatus = $_POST['estatus'];
    $fecha = date("Y-m-d");

    $sql = "INSERT INTO usuarios (direccionId, dependenciaId, usuario, nombre_usuario, contrasena, nivel, estatus, fecha_registro)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iissssss", $direccionId, $dependenciaId, $usuario, $nombre_usuario, $contrasena, $nivel, $estatus, $fecha);
    $stmt->execute();
}

$consulta = "SELECT u.usuario, u.nombre_usuario, u.nivel, u.estatus, u.fecha_registro,
                    d.nombreDireccion AS direccion, dp.nombre AS departamento
             FROM usuarios u
             JOIN direcciones d ON u.direccionId = d.direccionId
             JOIN dependencias dp ON u.dependenciaId = dp.dependenciaId";
$resultado = $conexion->query($consulta);
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>USUARIOS DEL SISTEMA</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            * { font-family: 'Cal Sans', sans-serif; font-weight: 200; }
            html, body { height: 100%; overflow-x: hidden; background-color: rgb(247, 247, 247); }
            #menu {
                width: 100vw; height: 100px; background-color: rgb(213, 213, 213);
                display: flex; justify-content: space-between; align-items: center;
                padding: 0 20px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }
            .botonValidacion {
                margin: 10px; padding: 20px; width: 120px;
                border-radius: 20px; border: none;
                background-color: rgb(63, 63, 63); color: white;
                box-shadow: 0 7px 12px rgba(0, 0, 0, 0.1);
            }
            .botonValidacion:hover {
                cursor: pointer; background-color: rgb(54, 54, 54);
                transform: translateY(-4px);
            }
            .contenedorPrincipal {
                display: flex; justify-content: space-between; align-items: stretch;
                padding: 40px; gap: 30px; flex-wrap: wrap;
            }
            .formularioPersonal {
                flex: 1; background: white; padding: 30px;
                border-radius: 16px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            }
            .formularioPersonal h4 {
                margin-bottom: 20px; color: #2c3e50;
            }
            #userID { font-size: 17px; }
            #userIDOUT { font-size: 15px; }
            #searchButtonDiv {
                width: 36px; 
                height: 36px; 
                background-color: black; 
                display: flex; 
                align-items: center; 
                justify-content: center; 
                border-radius: 5px;
            }
            @media (max-width: 768px) {
                .contenedorPrincipal { flex-direction: column; align-items: center; }
            }
        </style>
    </head>
    <body>
        <nav id="menu">
            <img src="https://utpp.sonora.edu.mx/images/2024/05/15/utpp_logo-svg-a-color.svg" height="50">
            <h3>USUARIOS DEL SISTEMA</h3>
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

        <div class="container mt-5">
            <h2>Registrar Usuario</h2>
            <form class="row g-3" method="POST">
                <div class="col-md-4">
                    <label>Dirección</label>
                    <select name="direccion" id="direccion" class="form-select" onchange="cargarDependencias()" required>
                        <option value="">Selecciona una dirección</option>
                        <?php while ($dir = $direcciones->fetch_assoc()): ?>
                            <option value="<?= $dir['direccionId'] ?>"><?= htmlspecialchars($dir['nombreDireccion']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label>Dependencia</label>
                    <select name="dependencia" id="dependencia" class="form-select" required>
                        <option value="">Selecciona una dependencia</option>
                    </select>
                </div>

                <div class="col-md-4"><label>Usuario</label><input type="text" name="usuario" class="form-control" required></div>
                <div class="col-md-4"><label>Nombre del Usuario</label><input type="text" name="nombre_usuario" class="form-control" required></div>
                <div class="col-md-4"><label>Contraseña</label><input type="password" name="contrasena" class="form-control" required></div>
                <div class="col-md-4">
                    <label>Nivel del Usuario</label>
                    <select class="form-select" name="nivel_usuario" required>
                        <option value="">Selecciona nivel</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Personal">Personal</option>
                        <option value="Invitado">Invitado</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Estatus</label>
                    <select class="form-select" name="estatus" required>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success">Guardar Usuario</button>
                </div>
            </form>

            <h3 class="mt-5">Usuarios Registrados</h3>
            <table class="table table-bordered mt-3">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Dirección</th>
                        <th>Departamento</th>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Nivel</th>
                        <th>Estatus</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php if ($resultado && $resultado->num_rows > 0): ?>
                        <?php while ($fila = $resultado->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($fila['direccion']) ?></td>
                                <td><?= htmlspecialchars($fila['departamento']) ?></td>
                                <td><?= htmlspecialchars($fila['usuario']) ?></td>
                                <td><?= htmlspecialchars($fila['nombre_usuario']) ?></td>
                                <td><?= htmlspecialchars($fila['nivel']) ?></td>
                                <td><?= htmlspecialchars($fila['estatus']) ?></td>
                                <td><?= htmlspecialchars($fila['fecha_registro']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="7">No hay usuarios registrados.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Botón Cancelar -->
        <div style="position: fixed; bottom: 20px; right: 20px;">
            <button class="botonValidacion" onclick="window.location.href='../../index.php'">CANCELAR</button>
        </div>

        <script>
            const dependencias = <?php echo json_encode($dependenciasPorDireccion); ?>;
            function cargarDependencias() {
                const direccionId = document.getElementById("direccion").value;
                const dependenciaSelect = document.getElementById("dependencia");
                dependenciaSelect.innerHTML = '<option value="">Selecciona una dependencia</option>';
                if (dependencias[direccionId]) {
                    dependencias[direccionId].forEach(dep => {
                        const option = document.createElement("option");
                        option.value = dep.dependenciaId;
                        option.textContent = dep.nombre;
                        dependenciaSelect.appendChild(option);
                    });
                }
            }

            const userMenu = document.getElementById('userMenu');
            const dropdown = document.getElementById('dropdown');
                userMenu.addEventListener('click', () => {
                    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
                });
        </script>
    </body>
</html>
