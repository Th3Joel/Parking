<link rel="stylesheet" href="app/vistas/css/reportes.css">
<div class="animate__animated animate__fadeIn">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><strong>Reportes</strong></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Sistema</a></li>
            <li class="breadcrumb-item active">Reportes</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="card card-primary card-outline">
        <div class="card-header ">

          <div class="title">
            <h3>Tipos</h3>
          </div>

        </div>
        <div class="card-body">
          <div class="container text-center">
            <div class="row align-items-center contenido">
              <div class="col">
              <label class="form-label">Total a pagar de clientes</label>
                <a href="reportes/TopClientes.php" target="_blank" rel="noopener noreferrer">
                  <button class="btn btn-success">Ver</button>
                </a>
              </div>
              <div class="col">
                <div class="formPlanes">
                  <form action="reportes/PlanesPorTiempo.php" target="_blank" method="get">
                  <label class="form-label">Facturacion total por planes</label>
                    <div class="input-group mb-3">
                      <span class="input-group-text">Fecha inicial</span>
                      <input type="date" name="inicio" id="inicio1" class="form-control" required>
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text">Fecha Final</span>
                      <input type="date" name="final" id="final1" class="form-control" required>
                    </div>

                    <button class="btn btn-success" id="btn1">Ver</button>
                  </form>
                </div>

              </div>
              <div class="col">
                <div class="formInspecciones">
                  <form action="reportes/inspecciones.php" target="_blank" method="get">
                  <label class="form-label">Inpecciones por hora y fecha específica</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text">Fecha</span>
                    <input type="date" name="fecha" class="form-control" required>
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">Hora</span>
                    <input type="time" name="hora" class="form-control" required>
                  </div>

                  <button class="btn btn-success">Ver</button>
                  </form>
                </div>

              </div>
              <div class="col">
                <div class="formDetalleSuscripcion">
                  <form action="reportes/Factura.php" target="_blank" method="get">
                  <label class="form-label">Detalle de facturación de la suscripción</label>
                    <select name="id" id="selectSuscripcion" class="form-control mb-2">

                    </select>
                    <button class="btn btn-success">
                      Ver
                    </button>
                  </form>
                </div>
              </div>
              <div class="col">
                <div class="formDetalleEspaciosOn">
                  <form action="reportes/EspaciosOn.php" target="_blank" method="get">
                    <label class="form-label">Estado de espacios</label>
                    <select name="state" id="" class="form-control mb-2">
                      <option value="1">Ocupado</option>
                      <option value="0">Libre</option>
                    </select>
                    <button class="btn btn-success">
                      Ver
                    </button>
                  </form>
                </div>
              </div>
              <div class="col">
                <form action="reportes/RangoInspecciones.php" target="_blank" method="get">
                <label class="form-label">Inspecciones por rango de fechas</label>
                    <div class="input-group mb-3">
                      <span class="input-group-text">Fecha inicial</span>
                      <input type="date" name="inicio" id="inicio2" class="form-control" required>
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text">Fecha Final</span>
                      <input type="date" name="final" id="final2" class="form-control" required>
                    </div>

                    <button class="btn btn-success" id="btn2">Ver</button>
                </form>
              </div>
              <div class="col">
              <form action="reportes/SuscripcionesRango.php" target="_blank" method="get">
                <label class="form-label">Sucripciones por rango de fechas</label>
                    <div class="input-group mb-3">
                      <span class="input-group-text">Fecha inicial</span>
                      <input type="date" name="inicio" id="inicio3" class="form-control" required>
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text">Fecha Final</span>
                      <input type="date" name="final" id="final3" class="form-control" required>
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text">Filtro</span>
                      <select name="filtro" class="form-control" required>
                        <option value="0">Activas</option>
                        <option value="1">Vencidas</option>
                      </select>
                    </div>

                    <button class="btn btn-success" id="btn3">Ver</button>
                </form>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
  </section>

</div>

<script src="app/vistas/js/reportes.js"></script>