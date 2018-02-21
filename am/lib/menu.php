<!-- Navigation Bar-->
<header id="topnav">
  <div class="topbar-main">
    <div class="container-fluid">

      <!-- Logo container-->
      <div class="logo">
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

          <li class="list-inline-item dropdown notification-list">
            <a class="nav-link dropdown-toggle waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
            aria-haspopup="false" aria-expanded="false">
            <img src="../<?php echo $fpshared; ?>" alt="user" class="rounded-circle">
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
          <a  href="../main/colegios.php"><i class=" ti-layers "></i>Colegios</a>
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
