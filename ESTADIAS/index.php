<?php
session_start(); exit();

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SISTEMA BIBLIOTECA</title>

    <!-- 
    ============================================================
    ===== FRONT-END DEVELOPED BY LUIS REY RAMIREZ MONTIJO  =====
    ===================== 06-MAY-2025 ==========================
    -->
    
    <!-- Bootstrap CDN for the icons and css of the system  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-..." crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- icon of the lash -->
    <link rel="icon" href="logo biblioteca.png"/>

    <!-- css link for the style -->
    <link rel="stylesheet" href="style.css"/>

    <style>
      * {
        font-family: 'Coolvetica';
      }
      #userID {
        font-size: 17px;
      }

      #userIDOUT {
        font-size: 15px;
      }

      a:hover {
        color: rgb(42, 158, 142);
      }

      li a:hover {
        color: rgb(42, 158, 142);
      }

        /* Animación para dropdown */
      #dropdown {
        position: absolute;
        right: 0;
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
      }

      #dropdown.show {
        opacity: 1;
        visibility: visible;
      }

      #dropdown a {
        text-align: center;
        width: 80px;
        display: block;
        padding: 5px 10px;
        color: white;
        background-color: rgb(255, 85, 85);
        text-decoration: none;
        border-radius: 10px 5px;
        font-size: 0.8rem;
        transition: background-color 0.3s ease;
      }

      #dropdown a:hover {
        background-color: rgb(235, 78, 78);
      }


    </style>
</head>
<body>
  <nav id="menu">
    <img src="https://utpp.sonora.edu.mx//images/2024/05/15/utpp_logo-svg-a-color.svg" height="50" alt="UTPP">
    <h2>SISTEMA DE ADMINISTRACIÓN DE BIBLIOTECA</h2>
    <div style="position: relative;">
      <div id="userMenu" style="cursor: pointer; border: 2px solid black; padding: 5px 10px; border-radius: 5px 10px;">
        <h4 id="userID" style="margin: 0;">
          <?php echo $_SESSION['usuario']?>
        </h4>
      </div>
      <div id="dropdown" class="dropdown-content">
        <a href="logout.php">SALIR</a>
      </div>
    </div>
  </nav>

  <div id="contenido">
    <?php if ($_SESSION['nivel'] === 'Personal'): ?>
      <div class="card" onclick="openModal('modalBiblioteca')">
        <img src="logosParaElSistemaDeBiblioteca/biblioteca.png" alt="Biblioteca">
        <h3>BIBLIOTECA</h3>
      </div>
      <div class="card" onclick="openModal('modalSupervisor')">
        <img src="logosParaElSistemaDeBiblioteca/supervisor.png" alt="Supervisor">
        <h3>SUPERVISOR</h3>
      </div>
    <?php endif; ?>

    <?php if ($_SESSION['nivel'] === 'Administrador'): ?>
      <div class="card" onclick="openModal('modalAdministrador')">
        <img src="logosParaElSistemaDeBiblioteca/administrador.png" alt="Administrador">
        <h3>ADMINISTRADOR</h3>
      </div>
    <?php endif; ?>

    <div class="card" onclick="openModal('modalDVDs')">
      <img src="logosParaElSistemaDeBiblioteca/DVD.png" alt="DVDs">
      <h3>DVDS</h3>
    </div>
    <div class="card" onclick="openModal('modalAyuda')">
      <img src="logosParaElSistemaDeBiblioteca/ayuda.png" alt="Ayuda">
      <h3>AYUDA</h3>
    </div>
  </div>

  <?php if ($_SESSION['nivel'] === 'Administrador'): ?>
  <!-- MODAL ADMINISTRADOR -->
  <div id="modalAdministrador" class="modal">
    <<div class="modal-content">
        <span class="close" onclick="closeModal('modalAdministrador')">&times;</span>
        <h3>ADMINISTRADOR &nbsp;&nbsp;&nbsp;<i class="bi bi-person-workspace"></i></h3>
        <ul>
          <!-- ADMINISTRACION DE USUARIOS -->
          <li class="toggleable" onclick="toggleSubmenu('submenuUsuariosAdmin')">
            ADMINISTRACION DE USUARIOS &nbsp;&nbsp;&nbsp;<i class="bi bi-people-fill"></i>
          </li>
          <ul id="submenuUsuariosAdmin" class="submenu">
            <a href="apartados/administrador/alumnos.php"><li>ALUMNOS</li></a>
            <a href="apartados/administrador/personalUTPP.php"><li>PERSONAL UTPP</li></a>
            <a href="apartados/administrador/usuariosSistema.php"><li>USUARIOS SISTEMA</li></a>
          </ul>

          <!-- ADMINISTRACION DE LIBROS -->
          <li class="toggleable" onclick="toggleSubmenu('submenuLibrosAdmin')">
            ADMINISTRACION DE LIBROS &nbsp;&nbsp;&nbsp;<i class="bi bi-book-half"></i>
          </li>
          <ul id="submenuLibrosAdmin" class="submenu">
            <a href="apartados/administrador/libros.php"><li>LIBROS &nbsp;&nbsp;&nbsp;<i class="bi bi-book-fill"></i></li></a>
            <a href="apartados/administrador/autor.php"><li>AUTOR &nbsp;&nbsp;&nbsp;<i class="bi bi-pencil-fill"></i></li></a>
            <a href="apartados/administrador/clasificacion.php"><li>CLASIFICACION &nbsp;&nbsp;&nbsp;<i class="bi bi-diagram-2-fill"></i></li></a>
            <a href="apartados/administrador/editorial.php"><li>EDITORIAL &nbsp;&nbsp;&nbsp;<i class="bi bi-pencil-square"></i></li></a>
            <a href="apartados/administrador/pais.php"><li>PAIS &nbsp;&nbsp;&nbsp;<i class="bi bi-geo-alt-fill"></i></li></a>
            <a href="apartados/administrador/estante.php"><li>ESTANTE &nbsp;&nbsp;&nbsp;<i class="bi bi-bookshelf"></i></li></a>
          </ul>

          <!-- UTILIDADES -->
          <li class="toggleable" onclick="toggleSubmenu('submenuUtilidades')">
            UTILIDADES &nbsp;&nbsp;&nbsp;<i class="bi bi-person-fill-gear"></i>
          </li>
          <ul id="submenuUtilidades" class="submenu">
            <a href="apartados/administrador/carreras.php"><li>CARRERAS &nbsp;&nbsp;&nbsp;<i class="bi bi-mortarboard-fill"></i></li></a>
            <a href="apartados/administrador/ciclo.php"><li>CICLO  &nbsp;&nbsp;&nbsp;<i class="bi bi-calendar3-fill"></i></li></a>
            <a href="apartados/administrador/dependencia.php"><li>DEPENDENCIAS  &nbsp;&nbsp;&nbsp;<i class="bi bi-diagram-3-fill"></i></li></a>
            <a href="apartados/administrador/direcciones.php"><li>DIRECCIONES  &nbsp;&nbsp;&nbsp;<i class="bi bi-building-fill"></i></li></a>
          </ul>
        </ul>
      </div>
  </div>
  <?php endif; ?>

  <?php if ($_SESSION['nivel'] === 'Personal'): ?>
  <!-- MODAL BIBLIOTECA -->
  <div id="modalBiblioteca" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('modalBiblioteca')">&times;</span>
      <h3>BIBLIOTECA <i class="bi bi-book-fill"></i></h3>
      <ul>
        <li><a href="apartados/biblioteca/prestamo.php">PRESTAMO &nbsp;&nbsp;&nbsp;<i class="bi bi-plus-circle-fill"></i></a></li>
        <li><a href="apartados/biblioteca/devolucion.php">DEVOLUCION &nbsp;&nbsp;&nbsp;<i class="bi bi-dash-circle-fill"></i></a></li>
        <li><a href="apartados/biblioteca/deudores.php">DEUDORES &nbsp;&nbsp;&nbsp;<i class="bi bi-exclamation-circle-fill"></i></a></li>
        <li><a href="apartados/biblioteca/reportes.php">REPORTES &nbsp;&nbsp;&nbsp;<i class="bi bi-exclamation-triangle-fill"></i></a></li>
        <li><a href="apartados/biblioteca/suscripciones.php">SUSCRIPCIONES &nbsp;&nbsp;&nbsp;<i class="bi bi-info-circle-fill"></i></a></li>
      </ul>
    </div>
  </div>

  <!-- MODAL SUPERVISOR -->
  <div id="modalSupervisor" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('modalSupervisor')">&times;</span>
        <h3>SUPERVISOR &nbsp;&nbsp;&nbsp;<i class="bi bi-person-square"></i></h3>
            <ul>
                <li class="toggleable" onclick="toggleSubmenu('submenuUsuarios')">
                ADMINISTRACION DE USUARIOS &nbsp;&nbsp;&nbsp;<i class="bi bi-people-fill"></i>
                </li>
                <ul id="submenuUsuarios" class="submenu">
                  <a href="apartados/supervisor/alumnos.php"><li>ALUMNOS &nbsp;&nbsp;&nbsp;<i class="bi bi-people-fill"></i></li></a>
                </ul>

                <li class="toggleable" onclick="toggleSubmenu('submenuLibros')">
                ADMINISTRACION DE LIBROS &nbsp;&nbsp;&nbsp;<i class="bi bi-book-half"></i>
                </li>
                <ul id="submenuLibros" class="submenu">
                <a href="apartados/supervisor/libros.php"><li>LIBROS &nbsp;&nbsp;&nbsp;<i class="bi bi-book-fill"></i></li></a>
                <a href="apartados/supervisor/autor.php"><li>AUTOR &nbsp;&nbsp;&nbsp;<i class="bi bi-pencil-fill"></i></li></a>
                <a href="apartados/supervisor/clasificacion.php"><li>CLASIFICACION &nbsp;&nbsp;&nbsp;<i class="bi bi-files"></i></li></a>
                <a href="apartados/supervisor/editorial.php"><li>EDITORIAL &nbsp;&nbsp;&nbsp;<i class="bi bi-grid"></i></li></a>
                <a href="apartados/supervisor/pais.php"><li>PAIS &nbsp;&nbsp;&nbsp;<i class="bi bi-geo-alt-fill"></i></li></a>
                </ul>
            </ul>
        </div>
  </div>
  <?php endif; ?>

  <!-- MODAL DVDS (Todos los niveles) -->
  <div id="modalDVDs" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('modalDVDs')">&times;</span>
      <h3>DVDS &nbsp;&nbsp;&nbsp;<i class="bi bi-disc-fill"></i></h3>
      <ul>
        <a href="apartados/dvds/nuevoDVD.php"><li>NUEVO DVD &nbsp;&nbsp;&nbsp;<i class="bi bi-disc-fill"></i></li></a>
        <a href="apartados/dvds/consultarDVD.php"><li>CONSULTAR DVD &nbsp;&nbsp;&nbsp;<i class="bi bi-search"></i></li>
      </ul></a>
    </div>
  </div>

  <!-- MODAL AYUDA (Todos los niveles) -->
  <div id="modalAyuda" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('modalAyuda')">&times;</span>
      <h3>AYUDA <i class="bi bi-question-lg"></i></h3>
      <ul>
        <li>ACERCA DE <i class="bi bi-info-square-fill"></i></li>
      </ul>
    </div>
  </div>

  <!-- SCRIPT PARA MODALES -->
    <script>
      function openModal(id) {
        document.getElementById(id).style.display = "block";
      }
      function closeModal(id) {
        document.getElementById(id).style.display = "none";
      }
      // Cerrar modales al hacer clic fuera
      window.onclick = function(event) {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
          if (event.target === modal) {
            modal.style.display = "none";
          }
        });
      };

      function toggleSubmenu(id) {
      const submenu = document.getElementById(id);
      submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
      }

      function closeModal(id) {
        document.getElementById(id).style.display = 'none';
      }

      function closeAllModals() {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
          modal.style.display = 'none';
        });
      }

      // Escucha la tecla ESC
      document.addEventListener('keydown', function(event) {
        if (event.key === "Escape" || event.key === "Esc") {
          closeAllModals();
        }
      });


      const userMenu = document.getElementById('userMenu');
      const dropdown = document.getElementById('dropdown');

      userMenu.addEventListener('click', () => {
        dropdown.classList.toggle('show');
      });

      // Cerrar el menú si se hace clic fuera de él
      document.addEventListener('click', (event) => {
        if (!userMenu.contains(event.target) && !dropdown.contains(event.target)) {
          dropdown.classList.remove('show');
        }
      });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QF2ZgI4uMIfYzXQ1WTPnVXjYysDLxKqkTOdAzLlDp0UJiz3nI2/tMHoB2kUYT47N" crossorigin="anonymous"></script>
</body>
</html>
