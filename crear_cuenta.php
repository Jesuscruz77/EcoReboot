<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>EcoReboot - Crear Cuenta</title>
  <meta content="Plataforma para donación y reciclaje de dispositivos electrónicos" name="description">
  <meta content="reciclaje, electrónicos, donación, sostenibilidad" name="keywords">
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
      width: 100%;
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
    
    /* Register specific styles */
    .register-container {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      padding: 30px;
      max-width: 600px;
      margin: 0 auto;
    }
    
    .login-link {
      margin-top: 20px;
      padding: 15px;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .login-link a {
      color: var(--primary-color);
      font-weight: 500;
      text-decoration: none;
    }
    
    .login-link a:hover {
      color: var(--primary-dark);
      text-decoration: underline;
    }
    
    /* Hero section */
    #hero {
      background-color: var(--secondary-color);
      padding: 100px 0 40px 0;
    }
    
    #hero h1 {
      font-size: 2.5rem;
      color: var(--primary-dark);
      margin-bottom: 15px;
    }
    
    #hero h2 {
      font-size: 1.5rem;
      color: var(--text-color);
    }
    
    /* Alert messages */
    .alert-success {
      background-color: #d4edda;
      color: #155724;
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 5px;
      border: 1px solid #c3e6cb;
    }
    
    .alert-error {
      background-color: #f8d7da;
      color: #721c24;
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 5px;
      border: 1px solid #f5c6cb;
    }
    
    /* Loading and message states */
    .loading {
      display: none;
      text-align: center;
      padding: 10px;
      color: var(--primary-dark);
    }
    
    .error-message {
      display: none;
      color: #dc3545;
      background: #f8d7da;
      border: 1px solid #f5c6cb;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 15px;
    }
    
    .sent-message {
      display: none;
      color: #155724;
      background: #d4edda;
      border: 1px solid #c3e6cb;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 15px;
    }
  </style>
  <script>
    function confirmDonation() {
      return confirm("¿Está seguro de los datos ingresados?");
    }
    
    function validatePassword() {
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirm_password').value;
      
      if (password !== confirmPassword) {
        alert('Las contraseñas no coinciden');
        return false;
      }
      return true;
    }
    
    function validateForm() {
      return validatePassword() && confirmDonation();
    }
  </script>
</head>
<body>
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">
      <h1 class="logo"><a href="index_inicio.html">EcoReboot</a></h1>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="index_inicio.html">Inicio</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
      <h1 class="logo"><a href="index.html" style="font-size: 30px;">EcoReboot</a></h1>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Inicio</a></li>
          <li><a class="nav-link scrollto" href="#about">Informacion</a></li>
          <li><a class="nav-link scrollto" href="donar.php">Donar dispositivo</a></li>
          <li><a class="nav-link scrollto" href="index.html" onclick="return confirm('¿Estás seguro de que deseas cerrar sesión?')">Cerrar sesión</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->

  <section id="contact" class="contact">
    <div class="container">
      <div class="section-title">
        <h2>Crear Cuenta</h2>
        <p>Completa el formulario para registrarte</p>
      </div>
      
      <?php
      // Mostrar mensaje de éxito si existe
      if (isset($_GET['success']) && $_GET['success'] == 'true') {
          echo '<div class="alert alert-success text-center"><i class="bi bi-check-circle me-2"></i>¡Tu registro se ha realizado con éxito!</div>';
      }
      
      // Mostrar mensajes de error si existen
      if (isset($_GET['error'])) {
          $error_message = '';
          switch ($_GET['error']) {
              case 'emptyfields':
                  $error_message = 'Por favor completa todos los campos';
                  break;
              case 'invalidemail':
                  $error_message = 'El correo electrónico no es válido';
                  break;
              case 'usertaken':
                  $error_message = 'El nombre de usuario ya está en uso';
                  break;
              case 'emailtaken':
                  $error_message = 'El correo electrónico ya está registrado';
                  break;
              case 'passwordmismatch':
                  $error_message = 'Las contraseñas no coinciden';
                  break;
              default:
                  $error_message = 'Error al registrar la cuenta';
          }
          echo '<div class="alert alert-error text-center"><i class="bi bi-exclamation-triangle me-2"></i>'.$error_message.'</div>';
      }
      ?>
      
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="register-container">
            <form action="register.php" method="post" role="form" class="php-email-form" onsubmit="return validateForm();">
              <div class="form-group">
                <label for="username"><i class="bi bi-person me-2"></i>Nombre de usuario</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Ingresa tu nombre de usuario" required>
              </div>
              
              <div class="form-group mt-3">
                <label for="phone"><i class="bi bi-telephone me-2"></i>Teléfono</label>
                <input type="tel" class="form-control" name="phone" id="phone" placeholder="Ingresa tu número de teléfono" required>
              </div>
              
              <div class="form-group mt-3">
                <label for="email"><i class="bi bi-envelope me-2"></i>Correo electrónico</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Ingresa tu correo electrónico" required>
              </div>
              
              <div class="form-group mt-3">
                <label for="password"><i class="bi bi-lock me-2"></i>Contraseña</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Crea una contraseña segura" required>
              </div>
              
              <div class="form-group mt-3">
                <label for="confirm_password"><i class="bi bi-lock-fill me-2"></i>Confirmar contraseña</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Repite tu contraseña" required>
              </div>
              
              <div class="loading">Cargando...</div>
              <div class="error-message"></div>
              <div class="sent-message">¡Registro exitoso! Bienvenido a EcoReboot</div>
              
              <div class="text-center mt-4">
                <button type="submit"><i class="bi bi-person-plus me-2"></i>Crear cuenta</button>
                <button type="reset"><i class="bi bi-x-circle me-2"></i>Borrar</button>
              </div>
            </form>
          </div>
          
          <div class="login-link text-center mt-4">
            <p>¿Ya tienes una cuenta? <a href="inicio_sesion.php">Inicia sesión</a></p>
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
    
    // Mostrar mensajes de error/éxito al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
      const urlParams = new URLSearchParams(window.location.search);
      const error = urlParams.get('error');
      const success = urlParams.get('success');
      
      if (error) {
        const errorDiv = document.querySelector('.error-message');
        if (errorDiv) {
          errorDiv.style.display = 'block';
          errorDiv.textContent = document.querySelector('.alert-error')?.textContent || 'Error al registrar la cuenta';
        }
      }
      
      if (success) {
        const successDiv = document.querySelector('.sent-message');
        if (successDiv) {
          successDiv.style.display = 'block';
        }
      }
    });
  </script>
</body>
</html>