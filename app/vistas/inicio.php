   <?php
    require "model/inicio.model.php";
    $vehiculos = ModelInicio::Vehiculos();
    $suscripciones = ModelInicio::Suscripciones();
    $clientes = ModelInicio::Clientes();
    $espacios = ModelInicio::Espacios();
   ?>
   <!-- Content Header (Page header) -->
    <div class="animate__animated animate__fadeIn">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Sistema</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

      <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h2><?php echo $vehiculos["total"]; ?></h2>

                <h5>Vehiculos</h5>
              </div>
              <div class="icon">
                <i class="bi bi-truck"></i>
              </div>
              <a href="#" class="small-box-footer btnVehiculos">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h2><?php echo $suscripciones["total"]; ?></h2>

                <h5>Suscripciones</h5>
              </div>
              <div class="icon">
                <i class="bi bi-bar-chart"></i>
              </div>
              <a href="#" class="small-box-footer btnSuscripciones">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h2><?php echo $clientes["total"]; ?></h2>

                <h5>Clientes</h5>
              </div>
              <div class="icon">
                <i class="bi bi-person"></i>
              </div>
              <a href="#" class="small-box-footer btnClientes">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h2><?php echo $espacios["total"]; ?></h2>

                <h5>Espacios</h5>
              </div>
              <div class="icon">
                <i class="bi bi-p-circle"></i>
              </div>
              <a href="#" class="small-box-footer btnEspacios">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">

           
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>

<script src="app/vistas/js/inicio.js"></script>