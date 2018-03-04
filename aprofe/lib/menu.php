<!-- Navigation Bar-->
<header id="topnav">
  <div class="topbar-main">
    <div class="container-fluid">

      <!-- Logo container-->
      <div class="logo">
        <!-- Text Logo -->
        <!--<a href="index.html" class="logo">-->
        <!--  <span class="logo-small"><i class="mdi mdi-radar"></i></span>-->
        <!--  <span class="logo-large"><i class="mdi mdi-radar"></i> </span>-->
        <!--</a>-->
        <!-- Image Logo -->
        <a href="www.inmedcoop.com" class="logo">

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
            <a class="nav-link dropdown-toggle waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
              <img src="../../assets/images/users/user.jpg" alt="user" class="rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
              <!-- item-->
              <div class="dropdown-item noti-title">
                <h5 class="text-overflow"><small class="text-white"><?php echo "$abrcole"; ?></small> </h5>
              </div>


              <a href="../setpass/" class="dropdown-item notify-item">
                <i class="ti-key"></i> <span>Contraseña</span>
              </a>
            <!--  <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="ti-settings"></i> <span>Ajustes</span>
              </a>
              <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="ti-key"></i> <span>Auxiliar</span>
              </a>-->
              <a href="../main/close.php" class="dropdown-item notify-item">
                <i class="ti-power-off"></i> <span>Salir</span>
              </a>
            </div>
          </li>

        </ul>
      </div>
      <!-- end menu-extras -->

      <div class="clearfix"></div>

    </div>
    <!-- end container -->
  </div>
  <!-- end topbar-main -->

  <div class="navbar-custom">
    <div class="container-fluid">
      <div id="navigation">
        <!-- Navigation Menu-->
        <ul class="navigation-menu">
          <li class="has-submenu">
            <a href="../main/"><i class="ti-home"></i>Inicio</a>
          </li>
          <li class="has-submenu">
            <a href="#"><i class=" ti-pencil-alt "></i>Tareas</a>
            <ul class="submenu">
              <!--<li><a href="# disabled" >Tareas Virtuales</a></li>-->
              <li><a href="../notasxactividad/">Calificar Actividad</a></li>
            </ul>
          </li>
          <!--<li class="has-submenu">
          <a  href="#"><i class=" ti-write "></i>Documentos</a>
        </li>-->
        <li class="has-submenu">
          <a href="#"><i class=" ti-view-grid "></i>Registros</a>
          <ul class="submenu">
            <li><a href="../notas/">Cuadros de Registro</a></li>
            <li><a href="../notasasesores/">Cuadros de Asesor</a></li>
            <!--<li><a href="#">Desempeño del alumno</a></li>-->
            <!---<li><a href="#">No Promovidos</a></li>-->
          </ul>
        </li>

        <li class="has-submenu">
        <a href="../apoyo/"><i class=" ti-notepad "></i>Material de Apoyo</a>
      </li>

      <li class="has-submenu">
        <a href="../nube/"><i class="  ti-cloud "></i>Nube</a>
      </li>

    </ul>

    <!-- End navigation menu -->
  </div>
  <!-- end #navigation -->
</div>
<!-- end container -->
</div>
<!-- end navbar-custom -->
</header>
<!-- End Navigation Bar-->
