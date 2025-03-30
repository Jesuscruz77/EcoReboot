<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>EcoReboot - Lista de Donaciones</title>
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
          <li><a class="nav-link scrollto" href="index.html" style="font-size: 30px;" onclick="return confirm('¿Estás seguro de que deseas cerrar sesión?')">Cerrar sesion</a></li>
          <li><a class="nav-link scrollto active" href="donations_list.php" style="font-size: 30px;">Donaciones</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header>

  <section id="donations" class="donations">
    <div class="container">
      <div class="section-title">
        <h2>Lista de Donaciones</h2>
      </div>

      <?php
include 'db.php';

// Verificar si se realizó alguna acción
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'delete') {
        $id = intval($_GET['id']);
        $conn->query("DELETE FROM Donaciones WHERE id_donacion = $id");
        echo '<div class="alert alert-success">¡Donación eliminada con éxito!</div>';
    } elseif ($action == 'edit') {
        $id = intval($_GET['id']);
        header("Location: edit_donation.php?id=$id");
    }
}

// Consultar donaciones y ordenar por ID
$result = $conn->query("SELECT d.id_donacion, u.nombre AS usuario, t.nombre AS tipo, e.nombre AS estado, d.fecha, d.imperfecciones, d.telefono, d.total_dispositivos
                        FROM Donaciones d
                        JOIN Usuarios u ON d.id_usuario = u.id_usuario
                        JOIN Tipo_Electrodomestico t ON d.id_tipo_electrodomestico = t.id_tipo_electrodomestico
                        JOIN Estado_Dispositivo e ON d.id_estado_dispositivo = e.id_estado_dispositivo
                        ORDER BY d.id_donacion ASC");

if ($result->num_rows > 0) {
    echo '<table class="table table-striped">';
    echo '<thead><tr><th>ID</th><th>Usuario</th><th>Tipo</th><th>Estado</th><th>Fecha</th><th>Imperfecciones</th><th>Teléfono</th><th>Cantidad</th><th>Acciones</th></tr></thead>';
    echo '<tbody>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>'.$row['id_donacion'].'</td>';
        echo '<td>'.$row['usuario'].'</td>';
        echo '<td>'.$row['tipo'].'</td>';
        echo '<td>'.$row['estado'].'</td>';
        echo '<td>'.$row['fecha'].'</td>';
        echo '<td>'.$row['imperfecciones'].'</td>';
        echo '<td>'.$row['telefono'].'</td>';
        echo '<td>'.$row['total_dispositivos'].'</td>';
        echo '<td>
                <a href="?action=edit&id='.$row['id_donacion'].'" class="btn btn-success btn-sm" onclick="return confirm(\'¿Estás seguro de que deseas editar esta donación?\')">Editar</a>
                <a href="?action=delete&id='.$row['id_donacion'].'" class="btn btn-danger btn-sm" onclick="return confirm(\'¿Estás seguro de que deseas eliminar esta donación?\')">Eliminar</a>
              </td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo '<div class="alert alert-info">No hay donaciones registradas.</div>';
}
?>

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
