<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>EcoReboot</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="assets/img/logo.ico" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Poppins" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <script>
    function confirmDonation() {
      return confirm("¿Estás seguro de que deseas registrar este dispositivo?");
    }
  </script>
</head>
<body>
  <header id="header" class="d-flex align-items-center" style="background-color: #dfefe7;">
    <div class="container d-flex align-items-center">
      <h1 class="logo me-auto"><a href="index_inicio.html">EcoReboot</a></h1>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="index_inicio.html" style="font-size: 30px;">Inicio</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header>

  <section id="contact" class="contact">
    <div class="container text-center">
        <div class="section-title">
            <h2>Donar dispositivo</h2>
        </div>
        <?php
        if (isset($_GET['success']) && $_GET['success'] == 'true') {
            echo '<div class="alert alert-success">¡Tu donación se ha registrado con éxito!</div>';
        }
        ?>
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-8 mt-5 mt-lg-0">
                <form id="donationForm" method="post" role="form" class="php-email-form" action="save_donation.php" onsubmit="return confirmDonation();">
                    <div class="form-group">
                      <label for="tipo_dispositivo">Tipo de electrodoméstico</label>
                      <select class="form-control" name="tipo_dispositivo" id="tipo_dispositivo" required>
                        <?php
                        include 'db.php';
                        $result = $conn->query("SELECT id_tipo_electrodomestico, nombre FROM Tipo_Electrodomestico");
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="'.$row['id_tipo_electrodomestico'].'">'.$row['nombre'].'</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group mt-3">
                      <label for="tipo_condicion">Estado del dispositivo</label>
                      <select class="form-control" name="tipo_condicion" id="tipo_condicion" required>
                        <?php
                        $result = $conn->query("SELECT id_estado_dispositivo, nombre FROM Estado_Dispositivo");
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="'.$row['id_estado_dispositivo'].'">'.$row['nombre'].'</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="imperfecciones">Imperfecciones</label>
                        <textarea class="form-control" name="imperfecciones" id="imperfecciones" rows="3"></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label for="locacion">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" class="form-control" name="cantidad" id="cantidad" required>
                    </div>
                    <div class="my-3">
                        <div class="loading">Cargando...</div>
                        <div class="error-message"></div>
                    </div>
                    <div class="text-center">
                        <button type="submit">Donar dispositivo</button>
                        <button type="reset">Borrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </section>

  <footer id="footer">
    <div class="container">
      <div class="copyright">
        <strong><span>EcoReboot</span></strong>
      </div>
    </div>
  </footer>
  <a href="#" class="back-to-top"><i class="bi bi-arrow-up-short"></i></a>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>
