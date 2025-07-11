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
    <title>PERSONAL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
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
            flex: 2; background: white; padding: 30px;
            border-radius: 16px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .formularioPersonal h4 {
            margin-bottom: 20px; color: #2c3e50;
        }
        .fotoPersonal {
            flex: 1; background: white; padding: 20px;
            border-radius: 16px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
        }
        .fotoPersonal img {
            width: 100%; height: auto; max-height: 300px;
            object-fit: cover; border-radius: 5px;
            border: 2px solid #ccc; margin-bottom: 15px;
        }
        .fotoPersonal button { margin: 5px; }
        @media (max-width: 768px) {
            .contenedorPrincipal { flex-direction: column; align-items: center; }
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
    </style>
</head>
<body>
    <nav id="menu">
        <img src="https://utpp.sonora.edu.mx//images/2024/05/15/utpp_logo-svg-a-color.svg" height="50">
        <h3>PERSONAL UTPP</h3>
        <div style="position: relative;">
            <div id="userMenu" style="cursor: pointer; user-select: none; border: 2px solid black; padding: 5px 10px; border-radius: 5px 10px; box-shadow: 0 8px 16px rgba(0,0,0,0.15);">
                <h5 id="userID" style="margin: 0;"><?php echo $_SESSION['usuario']; ?></h5>
            </div>
            <div id="dropdown" style="display:none;position:absolute;right: 0;background-color: white;border: 1px solid #ccc;border-radius: 10px;box-shadow: 0 8px 16px rgba(0,0,0,0.15);z-index: 1000;">
                <a href="../../logout.php" style="text-align: center;width: 80px;display: block;padding: 5px 10px;color: white;background-color: rgb(255, 85, 85);text-decoration: none;border-radius: 10px 5px;font-size: 0.8rem;" onmouseover="this.style.backgroundColor='rgb(235, 78, 78)'" onmouseout="this.style.backgroundColor='rgb(180,50,50)'">SALIR</a>
            </div>
        </div>
    </nav>

    <h2 style="text-align: center; margin: 30px 0 -10px;">REGISTRO DE PERSONAL</h2>

    <div class="contenedorPrincipal">
        <!-- Formulario Datos del Personal -->
        <div class="formularioPersonal">
            <h4>Datos Personales</h4>
            <form class="row g-3">
                <div class="col-md-4"><label>ID</label><input type="text" class="form-control"></div>
                <div class="col-md-4"><label>Nombre</label><input type="text" class="form-control"></div>
                <div class="col-md-4"><label>Apellido Paterno</label><input type="text" class="form-control"></div>
                <div class="col-md-4"><label>Apellido Materno</label><input type="text" class="form-control"></div>
                <div class="col-md-4"><label>Fecha de Nacimiento</label><input type="date" class="form-control"></div>
                <div class="col-md-4">
                    <label>Sigla de Profesión</label>
                    <select class="form-select">
                        <option value="">Selecciona una opción</option>
                        <option value="Ing.">Ing. - Ingeniero(a)</option>
                        <option value="Lic.">Lic. - Licenciado(a)</option>
                        <option value="Arq.">Arq. - Arquitecto(a)</option>
                        <option value="Dr.">Dr. - Doctor</option>
                        <option value="Dra.">Dra. - Doctora</option>
                        <option value="Mtro.">Mtro. - Maestro</option>
                        <option value="Mtra.">Mtra. - Maestra</option>
                        <option value="C.P.">C.P. - Contador Público</option>
                        <option value="Q.F.B.">Q.F.B. - Químico Farmacéutico Biólogo</option>
                        <option value="Q.B.P.">Q.B.P. - Químico Bacteriólogo Parasitólogo</option>
                        <option value="L.A.E.">L.A.E. - Lic. en Administración de Empresas</option>
                        <option value="L.C.C.">L.C.C. - Lic. en Ciencias de la Comunicación</option>
                        <option value="L.D.">L.D. - Lic. en Derecho</option>
                        <option value="L.E.F.">L.E.F. - Lic. en Educación Física</option>
                        <option value="L.I.">L.I. - Lic. en Informática</option>
                        <option value="L.P.">L.P. - Lic. en Psicología</option>
                        <option value="L.M.">L.M. - Lic. en Mercadotecnia</option>
                        <option value="L.E.">L.E. - Lic. en Economía</option>
                        <option value="L.T.S.">L.T.S. - Lic. en Trabajo Social</option>
                        <option value="M.D.">M.D. - Médico Cirujano</option>
                        <option value="E.N.F.">E.N.F. - Enfermero(a)</option>
                        <option value="Nut.">Nut. - Nutriólogo(a)</option>
                        <option value="Biól.">Biól. - Biólogo(a)</option>
                        <option value="Q.">Q. - Químico(a)</option>
                        <option value="Fís.">Fís. - Físico(a)</option>
                        <option value="Mat.">Mat. - Matemático(a)</option>
                        <option value="T.S.U.">T.S.U. - Técnico Superior Universitario</option>
                        <option value="Téc.">Téc. - Técnico(a)</option>
                        <option value="Vet.">Vet. - Veterinario(a)</option>
                        <option value="Prof.">Prof. - Profesor</option>
                        <option value="Profa.">Profa. - Profesora</option>
                        <option value="Ped.">Ped. - Pedagogo(a)</option>
                        <option value="Fil.">Fil. - Filósofo(a)</option>
                        <option value="Ant.">Ant. - Antropólogo(a)</option>
                        <option value="Soc.">Soc. - Sociólogo(a)</option>
                        <option value="Adm.">Adm. - Administrador(a)</option>
                        <option value="L.A.">L.A. - Lic. en Administración</option>
                        <option value="D.G.">D.G. - Diseñador Gráfico</option>
                        <option value="I.T.I.">I.T.I. - Ing. en Tecnologías de la Información</option>
                        <option value="Crim.">Crim. - Criminólogo(a)</option>
                    </select>
                </div>
                <div class="col-md-4"><label>Teléfono</label><input type="text" class="form-control"></div>
                <div class="col-md-4"><label>Correo</label><input type="email" class="form-control"></div>

                <h4 class="mt-4">Datos Institucionales</h4>
                <div class="col-md-4"><label>Pertenece</label><input type="text" class="form-control"></div>
                <div class="col-md-4"><label>Organigrama</label><input type="text" class="form-control"></div>
                <div class="col-md-4"><label>Área</label><input type="text" class="form-control"></div>
                <div class="col-md-4"><label>Carrera</label><input type="text" class="form-control"></div>
                <div class="col-md-4"><label>Estatus</label>
                    <select class="form-select">
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
            </form>
        </div>

        <!-- Foto y Botones -->
        <div class="fotoPersonal">
            <img src="" alt="FOTO PERSONAL">
            <div>
                <button class="btn btn-dark"><i class="bi bi-folder2-open"></i> Abrir</button>
                <button class="btn btn-secondary"><i class="bi bi-camera-fill"></i> Cámara</button>
            </div>
        </div>
    </div>

        <!-- Tabla de Personal Registrado -->
    <div class="container mt-4 mb-5">
        <h2 class="mb-3" style="text-align: center;">Buscador de Personal</h2>

        <!-- Buscador con ícono centrado -->
        <div class="mb-3 d-flex align-items-center" style="gap: 10px;">
            <div id="searchButtonDiv">
                <i id="searchButton" class="bi bi-search" style="color: white;"></i>
            </div>
            <input type="text" id="buscador" class="form-control" placeholder="Buscar por nombre...">
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="tablaPersonal">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Profesión</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Pertenece</th>
                        <th>Organigrama</th>
                        <th>Área</th>
                        <th>Carrera</th>
                        <th>Estatus</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <!-- Registro de ejemplo -->
                    <tr>
                        <td>001</td>
                        <td>Juan</td>
                        <td>Pérez</td>
                        <td>Gómez</td>
                        <td>1985-06-15</td>
                        <td>Ing.</td>
                        <td>6621234567</td>
                        <td>juan.perez@utpp.edu.mx</td>
                        <td>División Académica</td>
                        <td>Subdirección</td>
                        <td>Ingeniería</td>
                        <td>Tecnologías de la Información</td>
                        <td>Activo</td>
                    </tr>
                    <!-- Puedes agregar más registros desde PHP o JS -->
                </tbody>
            </table>
        </div>
    </div>


    <!-- Botón Cancelar -->
    <div style="position: fixed; bottom: 20px; right: 20px;">
        <button class="botonValidacion" onclick="window.location.href='../../index.php'">CANCELAR</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const userMenu = document.getElementById('userMenu');
        const dropdown = document.getElementById('dropdown');
        userMenu.addEventListener('click', () => {
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });
    </script>
</body>
</html>
