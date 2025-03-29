<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>EcoReboot - Editar Donación</title>
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
</head>
<body>
  <header id="header" class="d-flex align-items-center" style="background-color: #dfefe7;">
    <div class="container d-flex align-items-center">
      <h1 class="logo me-auto"><a href="index_inicio.html">EcoReboot</a></h1>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="donations_list.php" style="font-size: 30px;">Atrás</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header>

  <section id="edit_donation" class="donations">
    <div class="container">
      <div class="section-title">
        <h2>Editar Donación</h2>
      </div>

      <?php
      include 'db.php';

      // Obtener ID de la donación
      $id = intval($_GET['id']);

      // Consultar donación
      $result = $conn->query("SELECT * FROM Donaciones WHERE id_donacion = $id");
      $donation = $result->fetch_assoc();

      // Consultar tipos de dispositivos
      $types = $conn->query("SELECT id_tipo_electrodomestico, nombre FROM Tipo_Electrodomestico");

      // Consultar estados de dispositivos
      $states = $conn->query("SELECT id_estado_dispositivo, nombre FROM Estado_Dispositivo");

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Actualizar donación
        $tipo_dispositivo = intval($_POST['tipo_dispositivo']);
        $tipo_condicion = intval($_POST['tipo_condicion']);
        $imperfecciones = $_POST['imperfecciones'];
        $telefono = $_POST['telefono'];
        $cantidad = intval($_POST['cantidad']);

        $conn->query("UPDATE Donaciones SET 
          id_tipo_electrodomestico = $tipo_dispositivo, 
          id_estado_dispositivo = $tipo_condicion, 
          imperfecciones = '$imperfecciones', 
          telefono = '$telefono', 
          total_dispositivos = $cantidad 
          WHERE id_donacion = $id");

        echo '<div class="alert alert-success">¡Donación actualizada con éxito!</div>';
      }
      ?>

      <form method="POST" action="">
        <div class="mb-3">
          <label for="tipo_dispositivo" class="form-label">Tipo de Dispositivo</label>
          <select class="form-select" id="tipo_dispositivo" name="tipo_dispositivo" required>
            <?php
            while ($row = $types->fetch_assoc()) {
              $selected = ($row['id_tipo_electrodomestico'] == $donation['id_tipo_electrodomestico']) ? 'selected' : '';
              echo '<option value="'.$row['id_tipo_electrodomestico'].'" '.$selected.'>'.$row['nombre'].'</option>';
            }
            ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="tipo_condicion" class="form-label">Estado</label>
          <select class="form-select" id="tipo_condicion" name="tipo_condicion" required>
            <?php
            while ($row = $states->fetch_assoc()) {
              $selected = ($row['id_estado_dispositivo'] == $donation['id_estado_dispositivo']) ? 'selected' : '';
              echo '<option value="'.$row['id_estado_dispositivo'].'" '.$selected.'>'.$row['nombre'].'</option>';
            }
            ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="imperfecciones" class="form-label">Imperfecciones</label>
          <textarea class="form-control" id="imperfecciones" name="imperfecciones" required><?php echo $donation['imperfecciones']; ?></textarea>
        </div>
        <div class="mb-3">
          <label for="telefono" class="form-label">Teléfono</label>
          <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $donation['telefono']; ?>" required>
        </div>
        <div class="mb-3">
          <label for="cantidad" class="form-label">Cantidad de Dispositivos</label>
          <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo $donation['total_dispositivos']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Donación</button>
      </form>
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
