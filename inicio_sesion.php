<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>EcoReboot - Iniciar Sesión</title>
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
   background-color: #333; /* Fondo oscuro */
   color: #fff;
   font-family: "Raleway", sans-serif;
   display: flex;
   justify-content: space-between;
   align-items: center;
   padding: 10px 20px;
   border-bottom: 2px solid #5cb874; /* Línea verde para estilo */
    }

    #header a {
      color: #fff;
      text-decoration: none;
      margin: 0 10px;
      font-size: 14px;
    }

    #header a:hover {
      color: #5cb874; /* Color destacado al pasar */
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
    
    /* Login specific styles */
    .login-container {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      padding: 30px;
      max-width: 600px;
      margin: 0 auto;
    }
    
    .create-account {
      margin-top: 20px;
      padding: 15px;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .create-account a {
      color: var(--primary-color);
      font-weight: 500;
      text-decoration: none;
    }
    
    .create-account a:hover {
      color: var(--primary-dark);
      text-decoration: underline;
    }
    
    /* Hero Section Enhancements */
    /* Añade estas personalizaciones de color */
    :root {
      --bs-primary: #4caf50; /* Verde principal */
      --bs-primary-rgb: 76, 175, 80;
      --bs-primary-dark: #087f23; /* Verde oscuro */
    }

    .bg-primary-light {
      background-color: #d4edda !important; /* Tono claro del verde */
    }

    .text-primary {
      color: var(--bs-primary) !important;
    }

    .text-primary-dark {
      color: var(--bs-primary-dark) !important;
    }

    .btn-primary {
      background-color: var(--bs-primary);
      border-color: var(--bs-primary);
    }

    .btn-primary:hover {
      background-color: var(--bs-primary-dark);
      border-color: var(--bs-primary-dark);
    }

    .btn-outline-primary {
      color: var(--bs-primary);
      border-color: var(--bs-primary);
    }

    .btn-outline-primary:hover {
      background-color: var(--bs-primary);
      border-color: var(--bs-primary);
      color: white;
    }
    #hero {
      background: linear-gradient(135deg, rgba(223, 239, 231, 0.95) 0%, rgba(255, 255, 255, 0.98) 100%),
                  url('assets/img/electronics-bg.jpg') center center/cover;
      padding: 160px 0 80px;
      position: relative;
      overflow: hidden;
    }

    .hero-content {
      position: relative;
      z-index: 2;
    }

    .title-divider {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 1rem;
      margin: 1.5rem 0;
    }

    .title-divider .line {
      width: 60px;
      height: 2px;
      background: var(--primary-color);
    }

    .title-divider i {
      font-size: 1.8rem;
    }

    .hero-image-container {
      max-width: 400px;
      border-radius: 20px;
      overflow: hidden;
      transform: perspective(1000px) rotateY(-10deg);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
      transition: transform 0.5s ease;
    }

    .hero-image-container:hover {
      transform: perspective(1000px) rotateY(0deg);
    }

    .gradient-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(45deg, rgba(76, 175, 80, 0.1) 0%, rgba(223, 239, 231, 0.05) 100%);
    }

    .animated-img {
      animation: float 4s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-20px); }
    }

    @media (max-width: 992px) {
      #hero {
        padding: 100px 0 60px;
        text-align: center;
      }
      
      .hero-image-container {
        margin-top: 40px;
        transform: none;
        max-width: 300px;
      }
      
      .title-divider {
        justify-content: center;
      }
      
      .hero-cta {
        flex-direction: column;
        gap: 1rem;
      }
    }

    @media (max-width: 768px) {
      #hero h1 {
        font-size: 2.5rem;
      }
      
      #hero p {
        font-size: 1.1rem;
      }
    }
    
    /* Error message styling */
    .error-message {
      display: none;
      color: #dc3545;
      background: #f8d7da;
      border: 1px solid #f5c6cb;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 15px;
    }
    
    .loading {
      display: none;
      color: var(--primary-dark);
      text-align: center;
      padding: 10px;
    }
  </style>
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
            <span class="nav-text" style="font-size: 30px; padding-left: 10px">Inicio</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</header>

  <!-- Hero Section -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative">
      <div class="row gy-5">
        <div class="col-lg-7 d-flex flex-column justify-content-center text-center text-lg-start">
          <div class="hero-content">
            <div class="badge-container mb-4">
              <span class="badge bg-primary-light text-primary-dark rounded-pill px-4 py-2">
                <i class="bi bi-recycle me-2"></i>Gestión Responsable
              </span>
            </div>
            <h1 class="display-4 fw-bold mb-4">Bienvenido a <span class="text-primary-dark">EcoReboot</span></h1>
            <div class="title-divider mb-4">
              <div class="line"></div>
              <i class="bi bi-cpu-fill text-primary"></i>
              <div class="line"></div>
            </div>
            <p class="lead mb-5">Accede a tu cuenta para gestionar donaciones, seguir el proceso de reciclaje y contribuir a un futuro tecnológico sostenible.</p>
            <div class="hero-cta d-flex gap-3 justify-content-center justify-content-lg-start">
              <a href="#contact" class="btn btn-primary btn-lg px-5">
                <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
              </a>
              <a href="crear_cuenta.php" class="btn btn-outline-primary btn-lg px-4">
                <i class="bi bi-person-plus me-2"></i>Crear Cuenta
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-5 d-flex align-items-center justify-content-center">
          <div class="hero-image-container position-relative">
            <img src="assets/img/logo.jpg" alt="Ilustración reciclaje electrónico" class="img-fluid animated-img">
            <div class="gradient-overlay"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="contact" class="contact">
    <div class="container">
      <div class="section-title">
        <h2>Iniciar Sesión</h2>
        <p>Ingresa tus credenciales para acceder a tu cuenta</p>
      </div>
      
      <?php
      // Mostrar mensaje de error si existe
      if (isset($_GET['error'])) {
          $error_message = '';
          switch ($_GET['error']) {
              case 'emptyfields':
                  $error_message = 'Por favor completa todos los campos';
                  break;
              case 'wrongpassword':
              case 'invalidcredentials':
                  $error_message = 'Usuario o contraseña incorrectos';
                  break;
              case 'nouser':
                  $error_message = 'No existe una cuenta con ese usuario';
                  break;
              default:
                  $error_message = 'Error al iniciar sesión';
          }
          echo '<div class="error-message text-center mb-4"><i class="bi bi-exclamation-triangle me-2"></i>'.$error_message.'</div>';
      }
      ?>
      
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="login-container">
            <form action="login.php" method="post" role="form" class="php-email-form">
              <div class="form-group">
                <label for="email"><i class="bi bi-person me-2"></i>Usuario</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Ingresa tu nombre de usuario" required>
              </div>
              
              <div class="form-group mt-3">
                <label for="password"><i class="bi bi-lock me-2"></i>Contraseña</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Ingresa tu contraseña" required>
              </div>
              
              <div class="my-3">
                <div class="loading">Cargando...</div>
                <div class="error-message"></div>
              </div>
              
              <div class="text-center mt-4">
                <button type="submit"><i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión</button>
                <button type="reset"><i class="bi bi-x-circle me-2"></i>Borrar</button>
              </div>
            </form>
          </div>
          
          <div class="create-account text-center mt-4">
            <p>¿No tienes una cuenta? <a href="crear_cuenta.php">Crear una cuenta</a></p>
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
    
    // Mostrar mensajes de error/éxito
    document.addEventListener('DOMContentLoaded', function() {
      const urlParams = new URLSearchParams(window.location.search);
      const error = urlParams.get('error');
      const success = urlParams.get('success');
      
      if (error) {
        const errorDiv = document.querySelector('.error-message');
        if (errorDiv) {
          errorDiv.style.display = 'block';
        }
      }
    });
  </script>
</body>
</html>