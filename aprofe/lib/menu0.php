<!-- Navigation Bar-->
<header id="topnav">
  <div class="topbar-main">
    <div class="container-fluid">

      <!-- Logo container-->
      <div class="logo hide-phone">
        <!-- Text Logo -->
        <a href="index.html" class="logo">
          <span class="logo-small"><i class="mdi mdi-radar"></i></span>
          <span class="logo-large"><i class="mdi mdi-radar"></i> <?php echo "$abrcole"; ?></span>
        </a>
        <!-- Image Logo -->
        <!--<a href="index.html" class="logo">-->
        <!--<img src="../assets/images/logo_dark.png" alt="" height="24" class="logo-lg">-->
        <!--<img src="../assets/images/logo_sm.png" alt="" height="24" class="logo-sm">-->
        <!--</a>-->

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
            <a href="javascript:void(0);" class="dropdown-item notify-item">
              <i class="mdi mdi-account-star-variant"></i> <span>Profile</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
              <i class="mdi mdi-settings"></i> <span>Settings</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
              <i class="mdi mdi-lock-open"></i> <span>Lock Screen</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
              <i class="mdi mdi-logout"></i> <span>Logout</span>
            </a>
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
        <?php
        for ($i=1; $i <=4 ; $i++) {
          $bq = array("I" , "II","III","IV" );
          echo '<li class="has-submenu">
            <a href="#"><i class="  mdi mdi-numeric-'.$i.'-box-multiple-outline  "></i>Bloque '.$bq[$i-1].'</a>
            <ul class="submenu">';
          require '../../conexion/conexion.php';
          $sql="SELECT materias.idnombremateria, materias.idgrado, materias.seccion, nombrematerias.corto, nombrematerias.nombre FROM `materias` INNER JOIN `nombrematerias` ON materias.idnombremateria=nombrematerias.idnombremateria  WHERE materias.idprofesor='$idusuario'  GROUP BY idnombremateria";
          //echo $usuario;
          $con=mysqli_query($conexion,$sql);
          if ($con) {
            while ($a=mysqli_fetch_array($con)) {
              echo '
                  <li><a href="../notas/?idmateria='.$a['idnombremateria'].'&bloque='.$i.'&materia='.$a['nombre'].'">'.$a['corto'].'</a></li>';
            }
          }else {
            echo "Error ".mysqli_errno($conexion).": ".mysqli_error($conexion);
          }
          echo '</ul>
        </li>';
          require '../../conexion/cerrar_conexion.php';
        }
         ?>

        <li class="has-submenu">
          <a href="../listados/"><i class="  mdi mdi-account-multiple  "></i>Asesor</a>
          <ul class="submenu">
            <li><a href="../listados/">Bloque I</a></li>
            <li><a href="../listados/">Bloque II</a></li>
            <li><a href="../listados/">Bloque III</a></li>
            <li><a href="../listados/">Bloque IV</a></li>

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
