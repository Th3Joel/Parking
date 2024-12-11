<?php
$_SESSION['token'] = bin2hex(random_bytes(32));
?>

<link rel="stylesheet" type="text/css" href="app/vistas/css/login.css">
<link rel="stylesheet" type="text/css" href="app/asset/animate/main.css">
<script type="text/javascript" src="app/asset/sweetAlert/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" type="text/css" href="app/asset/sweetAlert/dist/sweetalert2.min.css">
<link rel="stylesheet" type="text/css" href="app/asset/bootstrap/boot.css">
<script src="app/asset/bootstrap/boot.js"></script>
<script type="text/javascript" src="app/vistas/js/login.js"></script>

<body style="background-image: url('app/vistas/img/login-parking.jpg');
              ">
  <div id="exe" style="display: none;"></div>
  <!-- partial:index.partial.html -->

  <body class="align animate__animated animate__fadeIn">

    <div class="grid">

      <form method="post" class="form login" onsubmit="session(); return false;">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
        <header class="login__header">
          <h3 class="login__title">PARKING</h3>
        </header>

        <div class="login__body">

          <div class="form__field">
            <input type="user" name="user" placeholder="Usuario" required>
          </div>

          <div class="form__field">
            <input type="password" name="passwd" placeholder="Contraseña" required>
          </div>

        </div>


        <footer class="login__footer" align="center">
          <div style="width:100%;"><button class="btn btn-primary" id="btn" style="width:200px;">Iniciar sesión</button></div>


        </footer>


      </form>

    </div>

  </body>