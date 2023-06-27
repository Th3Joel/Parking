<?php
require "model/config.model.php";
$perfil = ConfigModelo::MostrarPerfil($_SESSION['id'],5);
$empresa = ConfigModelo::MostrarEmpresa();
?>


<!--Main-->
<link rel="stylesheet" type="text/css" href="app/vistas/css/adminlte.min.css">
<link rel="stylesheet" type="text/css" href="app/asset/bootstrap/boot.css">

<script type="text/javascript" src="app/asset/bootstrap/boot.js"></script>


<script type="text/javascript" src="app/vistas/js/adminlte.js"></script>
<!-- BootStrap Icons-->
  <link rel="stylesheet" type="text/css" href="app/asset/booticon/font/bootstrap-icons.css">

  <link rel="stylesheet" type="text/css" href="app/vistas/css/plantilla.css">
<!--Awesome Font-->
<link rel="stylesheet" type="text/css" href="app/asset/fontawesome-free/css/all.min.css">
<!--Animate-->
<link rel="stylesheet" type="text/css" href="app/asset/animate/main.css">
<!--SwallAlert-->
<script type="text/javascript" src="app/asset/sweetAlert/dist/sweetalert2.all.min.js"></script>
   <link rel="stylesheet" type="text/css" href="app/asset/sweetAlert/dist/sweetalert2.min.css">
   <!--DataTables-->
   <link rel="stylesheet" type="text/css" href="app/asset/DataTables/datatables.min.css">
   <script type="text/javascript" src="app/asset/DataTables/datatables.min.js"></script>
    <!--DataTables-->

<link rel="stylesheet" type="text/css" href="app/asset/DataTables/Responsive-2.4.0/css/responsive.bootstrap.min.css">
<script type="text/javascript" src="app/asset/DataTables/Responsive-2.4.0/js/responsive.bootstrap.min.js"></script>
 <script type="text/javascript" src="app/asset//DataTables/Responsive-2.4.0/js/dataTables.responsive.min.js"></script>
 <script type="text/javascript" src="app/asset/DataTables/Scroller-2.1.0/js/dataTables.scroller.min.js"></script>
 <link rel="stylesheet" type="text/css" href="app/asset/DataTables/Scroller-2.1.0/css/scroller.bootstrap.min.css">

 <!--nuemral -->
 <script type="text/javascript" src="app/vistas/js/numeral.js"></script>

<body class="hold-transition sidebar-mini layout-fixed animate__animated animate__fadeIn"><div id="joel" style="display:none;"></div>

<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <!--<img class="animation__shake" src="app/vistas/img/logoEmpresa.png"  style="margin-bottom: 30px;width: 200px;" alt="AdminLTELogo" height="80" width="80">-->

<?php include "app/vistas/img/loader.php"; ?>

  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
</ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="brand-link elevation-4">
      <!--<img src="app/vistas/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">-->
      <h2 class="elevation-3 brand-image" style="color:white; opacity: .8;margin-top: 1px;margin-left: 17px"><?php echo substr($empresa["nombre"], 0, 1); ?></h2>
      <span class="brand-text font-weight-light"><?php echo $empresa["nombre"]; ?></span>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-1 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $perfil["img"]; ?>" class="elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a style="color:white;"><?php echo $perfil["nombre"]; ?></a>
          <a class="d-block" style="text-decoration: none;">
          <?php echo $perfil["tipo"]; ?>
        </a>
        </div>

        <div style="align-items: center;display: flex;margin-left: 30px;">
          <img src="app/vistas/img/logout.png" style="width:28px;cursor: pointer;" id="btnSalir">  
       </div>


      </div>

      <!-- Sidebar Menu -->

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

               <?php 
                
               if ($perfil["tipo"] == "Administrador") {
                 echo '
                
          <li class="nav-item">
            <a id="btnInicio" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
           
          

          <li  class="nav-item">
            <a class="nav-link" id="btnClientes">
              <i class="nav-icon bi bi-person-badge-fill"></i>
              <p>Clientes</p>
            </a>
          </li>

          <li  class="nav-item">
            <a class="nav-link" id="btnEspacios">
              <i class="nav-icon bi bi-p-circle"></i>
              <p>Espacios</p>
            </a>
          </li>

          <li  class="nav-item">
            <a class="nav-link" id="btnVehiculos">
              <i class="nav-icon bi bi-truck"></i>
              <p>Vehículos</p>
            </a>
          </li>

           <li  class="nav-item">
            <a class="nav-link" id="btnInspeccion">
              <i class="nav-icon bi bi-check-circle"></i>
              <p>Inspecciones</p>
            </a>
          </li>

          <li  class="nav-item">
            <a class="nav-link" id="btnSuscripcion">
              <i class="nav-icon bi bi-cash-stack"></i>
              <p>Suscripciones</p>
            </a>
          </li>

          <li  class="nav-item">
            <a class="nav-link" id="btnReportes">
              <i class="nav-icon bi bi-clipboard-data"></i>
              <p>Reportes</p>
            </a>
          </li>

          <li class="nav-item">
            <a id="sistema" class="nav-link">
              <i class=" nav-icon bi bi-android"></i>
              <p>
                Sistema
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

            <li class="nav-item">
              <a id="btnPlanes" class="nav-link">
                <i class=" nav-icon bi bi-bookmark-star"></i>
                <p>
                  Planes Suscripción
                </p>
              </a>
            </li>

              <li class="nav-item">
                <a id="btnUsers" class="nav-link">
                  <i class="bi bi-person nav-icon"></i>
                  <p>Usuarios</p>
                </a>
              </li>

              

            <li class="nav-item">
              <a id="btnConfig" class="nav-link">
                <i class=" nav-icon bi bi-gear"></i>
                <p>
                  Configuración
                </p>
              </a>
            </li>

            </ul>
          </li>
 
          ';}
          ?>

          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Widgets
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>

          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="app">


  
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2022-2023</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

</body>

  <script type="text/javascript" src="app/vistas/js/plantilla.js"></script>
