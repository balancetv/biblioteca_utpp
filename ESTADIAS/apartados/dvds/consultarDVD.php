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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>CONSULTA DVD</title>

    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        * {
            font-family: 'Coolvetica', sans-serif;
            font-weight: 100;
        }

        body {
            background-color: #f7f7f7;
        }

        #menu {
            background-color: #dedede;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .container-main {
            padding: 40px;
            background-color: #fff;
            border-radius: 15px;
            margin-top: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .botonValidacion {
            padding: 10px 20px;
            border-radius: 15px;
            border: none;
            background-color: #343a40;
            color: white;
            transition: 0.2s ease-in-out;
        }

        .botonValidacion:hover {
            background-color: #1d2124;
            transform: translateY(-2px);
        }

        .vista-previa {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 15px;
            margin-top: 15px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .vista-previa i {
            font-size: 2rem;
            color: #0d6efd;
        }

        select.form-select {
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <nav id="menu">
        <img src="https://utpp.sonora.edu.mx//images/2024/05/15/utpp_logo-svg-a-color.svg" height="50" alt="UTPP" />
        <h3>CONSULTA DE DVDS</h3>
        <div style="position: relative;">
            <div id="userMenu" style="cursor: pointer; user-select: none; border: 2px solid black; padding: 5px 10px; border-radius: 5px 10px; box-shadow: 0 8px 16px rgba(0,0,0,0.15);">
                <h5 style="margin: 0;"><?php echo htmlspecialchars($_SESSION['usuario']); ?></h5>
            </div>
            <div id="dropdown" style="display:none; position:absolute; right: 0; background-color: white; border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 8px 16px rgba(0,0,0,0.15); z-index: 1000;">
                <a href="../../logout.php" style="text-align: center; width: 80px; display: block; padding: 5px 10px; color: white; background-color: rgb(255, 85, 85); text-decoration: none; border-radius: 10px 5px; font-size: 0.8rem;" onmouseover="this.style.backgroundColor='rgb(235, 78, 78)'" onmouseout="this.style.backgroundColor='rgb(180,50,50)'">
                    SALIR
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="container-main">
            <h4 class="mb-4">Listado de DVDs</h4>

            <!-- Filtros -->
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <label class="form-label mb-0">Carrera:</label>
                    <select class="form-select" style="min-width: 200px;">
                        <option value="">Todas</option>
                        <option>Contaduría</option>
                        <option>Desarrollo de Negocios</option>
                        <option>Gastronomía</option>
                        <option>Mantenimiento</option>
                        <option>Minería</option>
                        <option>Paramédico</option>
                        <option>Tecnologías de la Información</option>
                    </select>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <label class="form-label mb-0">Buscar:</label>
                    <input type="text" class="form-control" placeholder="Buscar por nombre o proyecto..." style="min-width: 250px;" />
                </div>
            </div>

            <!-- Tabla -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Proyecto</th>
                            <th>Alumno</th>
                            <th>Carrera</th>
                            <th>Archivo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Sistema de Inventario</td>
                            <td>Ana Gómez</td>
                            <td>Tecnologías de la Información</td>
                            <td><i class="bi bi-file-earmark-pdf text-danger"></i> inventario.pdf</td>
                            <td>
                                <button class="btn btn-sm btn-primary"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>Restaurante Verde</td>
                            <td>Luis Méndez</td>
                            <td>Gastronomía</td>
                            <td><i class="bi bi-file-earmark-pdf text-danger"></i> menu_verde.pdf</td>
                            <td>
                                <button class="btn btn-sm btn-primary"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <!-- Puedes agregar más filas aquí -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Botón Cancelar -->
    <div style="position: fixed; bottom: 20px; right: 20px;">
        <button class="botonValidacion" onclick="window.location.href='../../index.php'">Cancelar</button>
    </div>

    <!-- Scripts -->
    <script>
        // Mostrar/ocultar dropdown de usuario
        const userMenu = document.getElementById('userMenu');
        const dropdown = document.getElementById('dropdown');
        userMenu.addEventListener('click', () => {
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });

        // Vista previa de archivo + eliminar
        const fileInput = document.getElementById('fileInput');
        const filePreview = document.getElementById('filePreview');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');
        const removeFile = document.getElementById('removeFile');

        fileInput.addEventListener('change', () => {
            const file = fileInput.files[0];
            if (file) {
                filePreview.style.display = 'flex';
                fileName.textContent = file.name;
                fileSize.textContent = `${(file.size / 1024).toFixed(2)} KB`;
            } else {
                filePreview.style.display = 'none';
            }
        });

        removeFile.addEventListener('click', () => {
            fileInput.value = '';
            filePreview.style.display = 'none';
        });
    </script>
</body>
</html>
