<!-- Navigation Bar-->
<header id="topnav">
  <div class="topbar-main">
    <div class="container-fluid">

      <!-- Logo container-->
      <div class="logo hide-phone">
        <!-- Text Logo -->
        <!--<a href="index.html" class="logo">-->
        <!--  <span class="logo-small"><i class="mdi mdi-radar"></i></span>-->
        <!--  <span class="logo-large"><i class="mdi mdi-radar"></i> </span>-->
        <!--</a>-->
        <!-- Image Logo -->
        <a href="index.html" class="logo">

        <span class="logo-large"><img src="<?php echo "$logodocb"; ?>" alt="" height="24" class="logo-lg"></i> <?php echo "$abrcole"; ?></span>
        <!--<img src="../assets/images/logo_sm.png" alt="" height="24" class="logo-sm">-->
        </a>

      </div>
      <!-- End Logo container-->


      <div class="menu-extras topbar-custom">

        <ul class="list-inline float-right mb-0">

          <li class="menu-item list-inline-item">
            <!-- Mobile menu toggle-->
            <a class="navbar-toggle nav-link">
              <div class="lines">
                <span></span>
                <span></span>
                <span></span>
              </div>
            </a>
            <!-- End mobile menu toggle-->
          </li>

          <li class="list-inline-item dropdown notification-list ">
            <a class="nav-link dropdown-toggle waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
            aria-haspopup="false" aria-expanded="false">
            <img src="<?php echo $fpshared; ?>" alt="user" class="rounded-circle">
          </a>
          <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
            <!-- item-->
            <div class="dropdown-item noti-title">
              <h5 class="text-overflow"><small class="text-white"><?php echo "$abrcole"; ?></small> </h5>
            </div>

            <!-- item-->
          <!--  <a href="javascript:void(0);" class="dropdown-item notify-item">
              <i class="mdi mdi-account-star-variant"></i> <span>Profile</span>
            </a>-->

            <!-- item-->

          </div>
        </li>

      </ul>
      <ul class="list-inline menu-left mb-0 col-6 col-sm-4 col-md-4">
        <li class=" app-search " >

            <form role="search" class="">
              <input type="text" placeholder="Buscar..." class="form-control col-12 col-sm-12 col-md-12">
              <a href=""><i class="fa fa-search"></i></a>
            </form>

        </li>
      </ul>
    </div>
    <!-- end menu-extras -->

    <div class="clearfix"></div>

  </div> <!-- end container -->
</div>
<!-- end topbar-main -->

<div class="navbar-custom">
  <div class="container-fluid">
    <div id="navigation">
      <!-- Navigation Menu-->
      <ul class="navigation-menu">



        <li class="has-submenu">
          <a  href="../main/"><i class="ti-home"></i>Inicio</a>
        </li>

        <li class="has-submenu">
          <a href="../alumnos/"><i class="  ti-user  "></i>Alumnos</a>
          <ul class="submenu">
            <li><a href="../alumnos/">Agregar/Editar</a></li>
            <li><a href="../listados/asignar.php">Asignar Sección</a></li>
            <li><a href="../listados/">Ver Listados</a></li>
          </ul>
        </li>
        <li class="has-submenu">
          <a href="#"><i class="ti-clipboard"></i>Calificaciones</a>
          <ul class="submenu">
            <li><a href="../notas/">Por Alumno</a></li>
            <li><a href="../notas/grado.php">Por Grado</a></li>
            <li><a href="../notas/cuadro.php">Cuadro de Honor</a></li>
            <li><a href="../notas/cp.php">Con Clases Perdidas</a></li>
          </ul>
        </li>
        <li class="has-submenu">
          <a href="#"><i class="  ti-settings  "></i>Ajustes</a>
          <ul class="submenu">
            <li><a href="../profesores/">Profesores</a></li>
            <li><a href="../materias/">Materias</a></li>
            <li><a href="../grados/">Grados</a></li>
            <li><a href="../asignarmaterias/">Asignar Materias</a></li>
            <li><a href="../asesores/">Asesores</a></li>
            <li><a href="../usuariosprofesores/">Cuentas Profesores</a></li>
          </ul>
        </li>
        <li class="has-submenu">
          <a href="../main/close.php"><i class=" ti-power-off "></i>Salir</a>
        </li>

      </ul>

      <!-- End navigation menu -->
    </div> <!-- end #navigation -->
  </div> <!-- end container -->
</div> <!-- end navbar-custom -->
</header>
<!-- End Navigation Bar-->
