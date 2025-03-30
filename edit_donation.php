<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>EcoReboot - Editar Donación</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="assets/img/logo.ico" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root {
      --primary-color: #4caf50;
      --primary-light: #80e27e;
      --primary-dark: #087f23;
      --secondary-color: #dfefe7;
      --text-color: #333333;
      --light-gray: #f8f9fa;
      --dark-gray: #6c757d;
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      color: var(--text-color);
      background-color: #f5f9f7;
    }
    
    h1, h2, h3, h4, h5, h6 {
      font-family: 'Raleway', sans-serif;
    }
    
    /* Header Styling */
    #header {
      transition: all 0.5s;
      z-index: 997;
      padding: 15px 0;
      box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
      background-color: var(--secondary-color);
    }
    
    .logo {
      font-size: 30px;
      margin: 0;
      padding: 0;
      line-height: 1;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
    }
    
    .logo a {
      color: var(--primary-dark);
      text-decoration: none;
    }
    
    .navbar {
      padding: 0;
    }
    
    .navbar ul {
      margin: 0;
      padding: 0;
      display: flex;
      list-style: none;
      align-items: center;
    }
    
    .navbar li {
      position: relative;
      padding: 10px 0 10px 28px;
    }
    
    .navbar a, .navbar a:focus {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0;
      font-family: "Poppins", sans-serif;
      font-size: 18px;
      font-weight: 500;
      color: var(--primary-dark);
      white-space: nowrap;
      transition: 0.3s;
      text-decoration: none;
    }
    
    .navbar a:hover, .navbar .active, .navbar .active:focus, .navbar li:hover > a {
      color: var(--primary-color);
    }
    
    /* Form Styling */
    .contact {
      padding: 60px 0;
    }
    
    .section-title {
      text-align: center;
      padding-bottom: 30px;
      position: relative;
    }
    
    .section-title h2 {
      font-size: 32px;
      font-weight: 700;
      text-transform: uppercase;
      margin-bottom: 20px;
      padding-bottom: 20px;
      position: relative;
      color: var(--primary-dark);
    }
    
    .section-title h2::after {
      content: '';
      position: absolute;
      display: block;
      width: 50px;
      height: 3px;
      background: var(--primary-color);
      bottom: 0;
      left: calc(50% - 25px);
    }
    
    .php-email-form {
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
      padding: 30px;
      background: white;
      border-radius: 10px;
    }
    
    .php-email-form .form-group {
      margin-bottom: 20px;
    }
    
    .php-email-form label {
      font-weight: 500;
      margin-bottom: 10px;
      display: block;
      color: var(--text-color);
    }
    
    .php-email-form input, .php-email-form select, .php-email-form textarea {
      border-radius: 5px;
      box-shadow: none;
      font-size: 14px;
      border: 1px solid #ddd;
      padding: 12px 15px;
    }
    
    .php-email-form input:focus, .php-email-form select:focus, .php-email-form textarea:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
    }
    
    .php-email-form button {
      background: var(--primary-color);
      border: 0;
      padding: 12px 25px;
      color: white;
      transition: 0.4s;
      border-radius: 5px;
      margin: 0 10px;
      font-weight: 500;
    }
    
    .php-email-form button[type="reset"] {
      background: var(--dark-gray);
    }
    
    .php-email-form button:hover {
      background: var(--primary-dark);
    }
    
    .php-email-form button[type="reset"]:hover {
      background: #495057;
    }
    
    /* Footer */
    #footer {
      background: var(--secondary-color);
      padding: 20px 0;
      color: var(--text-color);
      font-size: 14px;
      text-align: center;
    }
    
    #footer .copyright {
      text-align: center;
    }
    
    .back-to-top {
      position: fixed;
      visibility: hidden;
      opacity: 0;
      right: 15px;
      bottom: 15px;
      z-index: 996;
      background: var(--primary-color);
      width: 40px;
      height: 40px;
      border-radius: 50%;
      transition: all 0.4s;
      text-decoration: none;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .back-to-top i {
      font-size: 28px;
      color: white;
    }
    
    .back-to-top:hover {
      background: var(--primary-light);
      color: white;
    }
    
    .back-to-top.active {
      visibility: visible;
      opacity: 1;
    }
    
    /* Responsive */
    @media (max-width: 992px) {
      .navbar a {
        font-size: 16px;
      }
    }
    
    /* Success alert */
    .alert-success {
      background-color: #d4edda;
      color: #155724;
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 5px;
      border: 1px solid #c3e6cb;
    }
    
    /* Donation form container */
    .donation-container {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      padding: 30px;
    }
  </style>
  <script>
    function confirmUpdate() {
      return confirm("¿Estás seguro de que deseas actualizar esta donación?");
    }
  </script>
</head>

<body>
<header id="header" class="fixed-top" style="background-color: #333; color: #fff;">
    <div class="container d-flex align-items-center justify-content-between">
      <div class="logo-container d-flex align-items-center">
        <i class="bi bi-recycle logo-icon me-2" style="color: #5cb874; font-size: 40px"></i>
        <h1 class="logo"><a href="index_inicio.html" style="color: #fff; font-size: 30px;">EcoReboot</a></h1>
        <div class="logo-divider" style="border-left: 2px solid #5cb874; font-size: 30px"></div>
      </div>
      
      <nav id="navbar" class="navbar">
        <ul>
          <li>
            <a class="nav-link" href="index.html" style="color: #fff;">
              <span class="nav-icon"><i class="bi bi-house-door" style="color: #5cb874; font-size: 30px"></i></span>
              <span class="nav-text"  href="donations_list.php" style="font-size: 30px; padding-left: 10px">Atrás</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <section id="hero" class="d-flex align-items-center" style="background-color: var(--secondary-color); padding: 100px 0 40px 0;">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h2>Actualiza los detalles de tu dispositivo donado</h2>
        </div>
      </div>
    </div>
  </section>

  <section id="contact" class="contact">
    <div class="container">
      <div class="section-title">
        <h2>Editar Donación</h2>
        <p>Modifica los campos necesarios y guarda los cambios</p>
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

      <div class="row justify-content-center">
        <div class="col-lg-8 mt-4">
          <div class="donation-container">
            <form method="POST" action="" class="php-email-form" onsubmit="return confirmUpdate();">
              <div class="form-group">
                <label for="tipo_dispositivo"><i class="bi bi-laptop me-2"></i>Tipo de electrodoméstico</label>
                <select class="form-control" name="tipo_dispositivo" id="tipo_dispositivo" required>
                  <?php
                  while ($row = $types->fetch_assoc()) {
                    $selected = ($row['id_tipo_electrodomestico'] == $donation['id_tipo_electrodomestico']) ? 'selected' : '';
                    echo '<option value="'.$row['id_tipo_electrodomestico'].'" '.$selected.'>'.$row['nombre'].'</option>';
                  }
                  ?>
                </select>
              </div>
              
              <div class="form-group mt-3">
                <label for="tipo_condicion"><i class="bi bi-clipboard-check me-2"></i>Estado del dispositivo</label>
                <select class="form-control" name="tipo_condicion" id="tipo_condicion" required>
                  <?php
                  while ($row = $states->fetch_assoc()) {
                    $selected = ($row['id_estado_dispositivo'] == $donation['id_estado_dispositivo']) ? 'selected' : '';
                    echo '<option value="'.$row['id_estado_dispositivo'].'" '.$selected.'>'.$row['nombre'].'</option>';
                  }
                  ?>
                </select>
              </div>
              
              <div class="form-group mt-3">
                <label for="imperfecciones"><i class="bi bi-exclamation-triangle me-2"></i>Imperfecciones o detalles</label>
                <textarea class="form-control" name="imperfecciones" id="imperfecciones" rows="3" required><?php echo $donation['imperfecciones']; ?></textarea>
              </div>
              
              <div class="form-group mt-3">
                <label for="telefono"><i class="bi bi-telephone me-2"></i>Teléfono de contacto</label>
                <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $donation['telefono']; ?>" required>
              </div>
              
              <div class="form-group mt-3">
                <label for="cantidad"><i class="bi bi-calculator me-2"></i>Cantidad</label>
                <input type="number" class="form-control" name="cantidad" id="cantidad" min="1" value="<?php echo $donation['total_dispositivos']; ?>" required>
              </div>
              
              <div class="text-center">
                <button type="submit"><i class="bi bi-save me-2"></i>Actualizar Donación</button>
                <button type="reset"><i class="bi bi-x-circle me-2"></i>Restablecer</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <h3>EcoReboot</h3>
          <p>Dando una segunda vida a los dispositivos electrónicos</p>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <h4>Contáctanos</h4>
          <p>
            <strong>Email:</strong> info@ecoreboot.com<br>
            <strong>Teléfono:</strong> +123 456 7890<br>
          </p>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <h4>Síguenos</h4>
          <div class="social-links mt-3">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>
      <div class="copyright mt-4">
        &copy; Copyright <strong><span>EcoReboot</span></strong>. Todos los derechos reservados
      </div>
    </div>
  </footer>
  
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Back to top button
    const backtotop = document.querySelector('.back-to-top');
    if (backtotop) {
      window.addEventListener('scroll', () => {
        if (window.scrollY > 100) {
          backtotop.classList.add('active');
        } else {
          backtotop.classList.remove('active');
        }
      });
    }
  </script>
</body>
</html>