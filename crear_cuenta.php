<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>EcoReboot</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logo.ico" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Green
  * Template URL: https://bootstrapmade.com/green-free-one-page-bootstrap-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <script>
        function confirmDonation() {
          return confirm("¿Está seguro de los datos ingresados?");
        }
      </script>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center" style="background-color: #dfefe7;;">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.html">EcoReboot</a></h1>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="index.html" style="font-size: 30px;">Inicio</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container text-center">
        <div class="section-title">
            <h2>Crear cuenta</h2>
        </div>
        <?php
          if (isset($_GET['success']) && $_GET['success'] == 'true') {
            echo '<div class="alert alert-success">¡Tu registro se ha realizado con éxito!</div>';
          }
        ?>
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-8 mt-5 mt-lg-0">
                <form action="register.php" method="post" role="form" class="php-email-form" onsubmit="return confirmDonation();">
                    <div class="form-group">
                        <label for="username">Nombre de usuario</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="phone">Teléfono</label>
                        <input type="text" class="form-control" name="phone" id="phone" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="email">Correo electrónico</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="confirm_password">Confirmar contraseña</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                    </div>
                    <div class="loading d-none">Cargando...</div>  <!--Elemento para mostrar estado de carga -->
                    <div class="error-message d-none"></div>  <!--Elemento para mostrar errores -->
                    <div class="sent-message d-none">Mensaje enviado</div>  <!--Elemento para mostrar mensaje de éxito -->
                    <div class="text-center">
                        <button type="submit">Crear cuenta</button>
                        <button type="reset">Borrar</button>
                    </div>
                </form>
                
            </div>

            <div class="col-lg-8 mt-5 mt-lg-0">
                <div class="create-account text-center">
                    <br><br>
                    <p>¿Ya tienes una cuenta? <a href="inicio_sesion.php">Inicia sesion</a></p>
                </div>
            </div>
        </div>

    </div>
</section><!-- End Contact Section -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      </div>
      <div class="copyright">
        &copy; Copyright <strong><span>EcoReboot</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <!--<script src="assets/vendor/php-email-form/validate.js"></script>-->

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>

</html>
