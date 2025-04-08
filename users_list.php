<?php
// Iniciamos el buffer de salida al principio del script
ob_start();
include 'db.php';

// Procesamos las acciones antes de cualquier salida HTML
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'delete') {
        $id = intval($_GET['id']);
        $conn->query("DELETE FROM usuarios WHERE id_usuario = $id");
        // Guardamos el mensaje en una variable para mostrarlo después
        $mensaje = '<div class="alert alert-success">¡Usuario eliminado con éxito!</div>';
    } elseif ($action == 'edit') {
        $id = intval($_GET['id']);
        header("Location: edit_user.php?id=$id");
        exit(); // Importante: terminamos la ejecución aquí
    }
}

// Obtenemos los datos de la base de datos
$result = $conn->query("SELECT u.id_usuario, u.nombre, u.telefono, u.correo, 
                        r.nombre as rol, u.id_rol_usuario
                        FROM usuarios u
                        JOIN rol_usuarios r ON u.id_rol_usuario = r.id_rol_usuario
                        ORDER BY u.id_usuario ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>EcoReboot - Lista de Usuarios</title>
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
  <script src="https://unpkg.com/@zxing/library@0.18.6"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
  
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
    
    /* Section Styling */
    .users {
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
    
    /* Table Styling */
    .table-container {
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
      padding: 30px;
      background: white;
      border-radius: 10px;
      margin-bottom: 30px;
    }
    
    .table {
      width: 100%;
      margin-bottom: 1rem;
      color: var(--text-color);
      border-collapse: collapse;
    }
    
    .table th {
      background-color: var(--primary-color);
      color: white;
      font-weight: 500;
      padding: 12px 15px;
      text-align: left;
    }
    
    .table td {
      padding: 12px 15px;
      border-bottom: 1px solid #dee2e6;
    }
    
    .table-striped tbody tr:nth-of-type(odd) {
      background-color: rgba(0, 0, 0, 0.02);
    }
    
    .table-hover tbody tr:hover {
      background-color: rgba(0, 0, 0, 0.04);
    }
    
    /* Button Styling */
    .btn {
      border-radius: 5px;
      padding: 8px 20px;
      font-weight: 500;
      transition: all 0.3s;
      border: none;
    }
    
    .btn-success {
      background-color: var(--primary-color);
      color: white;
    }
    
    .btn-success:hover {
      background-color: var(--primary-dark);
    }
    
    .btn-danger {
      background-color: #dc3545;
      color: white;
    }
    
    .btn-danger:hover {
      background-color: #c82333;
    }
    
    .btn-primary {
      background-color: #0d6efd;
      color: white;
    }
    
    .btn-primary:hover {
      background-color: #0b5ed7;
    }
    
    .btn-info {
      background-color: #0dcaf0;
      color: white;
    }
    
    .btn-info:hover {
      background-color: #0da8d0;
    }
    
    .btn-sm {
      padding: 5px 10px;
      font-size: 14px;
    }
    
    /* Alert Styling */
    .alert {
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 5px;
    }
    
    .alert-success {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }
    
    .alert-info {
      background-color: #d1ecf1;
      color: #0c5460;
      border: 1px solid #bee5eb;
    }
    
    /* Modal Styling */
    .modal-content {
      border-radius: 10px;
      border: none;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    
    .modal-header {
      background-color: var(--primary-color);
      color: white;
      border-radius: 10px 10px 0 0;
    }
    
    .modal-title {
      font-weight: 600;
    }
    
    .btn-close {
      filter: invert(1);
    }
    
    .code-img {
      max-width: 100%;
      height: auto;
      margin: 20px 0;
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
    
    /* Export buttons container */
    .export-buttons {
      margin-bottom: 30px;
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }
    
    /* Dropdown styling */
    .dropdown-menu {
      border-radius: 5px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      border: none;
    }
    
    .dropdown-item {
      padding: 8px 15px;
      font-size: 14px;
      color: var(--text-color);
    }
    
    .dropdown-item:hover {
      background-color: var(--light-gray);
      color: var(--primary-dark);
    }
    
    /* Estilos para el dropdown de filtrado */
    .dropdown-menu {
      padding: 15px;
    }
    
    .filter-section {
      margin-bottom: 20px;
    }
    
    .filter-section h5 {
      color: var(--primary-dark);
      margin-bottom: 15px;
      font-weight: 600;
    }
    
    .form-label {
      font-weight: 500;
      color: var(--dark-gray);
    }
    
    .form-select, .form-control {
      border-radius: 5px;
      border: 1px solid #ced4da;
      padding: 8px 12px;
    }
    
    .form-select:focus, .form-control:focus {
      border-color: var(--primary-light);
      box-shadow: 0 0 0 0.25rem rgba(76, 175, 80, 0.25);
    }
    
    /* Responsive */
    @media (max-width: 992px) {
      .navbar a {
        font-size: 16px;
      }
      
      .table-responsive {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
      }
    }
</style>
</head>
<body>
<header id="header" class="fixed-top" style="background-color: #333; color: #fff;">
  <div class="container d-flex align-items-center justify-content-between">
    <div class="logo-container d-flex align-items-center">
      <i class="bi bi-recycle logo-icon me-2" style="color: #5cb874; font-size: 40px"></i>
      <h1 class="logo"><a href="#" style="color: #fff; font-size: 30px;">EcoReboot</a></h1>
      <div class="logo-divider" style="border-left: 2px solid #5cb874; font-size: 30px"></div>
    </div>
    
    <nav id="navbar" class="navbar">
      <ul>
        <li>
          <a class="nav-link" href="index.html" style="color: #fff;">
            <span class="nav-icon"><i class="bi bi-house-door" style="color: #5cb874; font-size: 30px"></i></span>
            <span class="nav-text" style="font-size: 30px; padding-left: 10px"href="index.html" onclick="return confirm('¿Estás seguro de que deseas cerrar sesión?')">Cerrar sesión</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</header>

  <section id="users" class="users">
    <div class="container">
      <div class="section-title">
        <h2>Lista de Usuarios</h2>
      </div>

      <div class="export-buttons">
        <!--<button class="btn btn-success" onclick="exportPDF()">
          <i class="bi bi-file-pdf"></i> Exportar PDF
        </button>
        <button class="btn btn-success" onclick="exportExcel()">
          <i class="bi bi-file-spreadsheet"></i> Exportar Excel
        </button> -->
        <a href="donations_list.php" class="btn btn-warning">
            <i class="bi bi-recycle"></i> Ver Donaciones
        </a>
        <div class="dropdown d-inline-block">
          <button class="btn btn-info dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-funnel"></i> Filtrar Usuarios
          </button>
          <div class="dropdown-menu p-3" aria-labelledby="filterDropdown" style="min-width: 300px;">
            <form id="filterForm">
              <div class="mb-3">
                <label for="filterRole" class="form-label">Rol de usuario</label>
                <select class="form-select" id="filterRole">
                  <option value="">Todos los roles</option>
                  <?php
                  $roles = $conn->query("SELECT * FROM rol_usuarios");
                  while ($role = $roles->fetch_assoc()) {
                    echo '<option value="'.$role['id_rol_usuario'].'">'.$role['nombre'].'</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-primary btn-sm" onclick="applyFilters()">
                  <i class="bi bi-check-circle"></i> Aplicar
                </button>
                <button type="button" class="btn btn-secondary btn-sm" onclick="resetFilters()">
                  <i class="bi bi-arrow-counterclockwise"></i> Limpiar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="table-container">
        <?php
        // Mostramos el mensaje de éxito si existe
        if (isset($mensaje)) {
            echo $mensaje;
        }

        if ($result->num_rows > 0) {
            echo '<div class="table-responsive">';
            echo '<table class="table table-striped table-hover" id="usersTable">';
            echo '<thead><tr><th>ID</th><th>Nombre</th><th>Teléfono</th><th>Correo</th><th>Rol</th></tr></thead>';
            echo '<tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>'.$row['id_usuario'].'</td>';
                echo '<td>'.$row['nombre'].'</td>';
                echo '<td>'.$row['telefono'].'</td>';
                echo '<td>'.$row['correo'].'</td>';
                echo '<td data-role-id="'.$row['id_rol_usuario'].'">'.$row['rol'].'</td>';
                
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        } else {
            echo '<div class="alert alert-info">No hay usuarios registrados.</div>';
        }
        ?>
      </div>
    </div>
  </section>

  <footer id="footer">
    <div class="container">
      <div class="copyright">
        <strong><span>EcoReboot</span></strong> &copy; 2023. Todos los derechos reservados.
      </div>
    </div>
  </footer>

  <a href="#" class="back-to-top"><i class="bi bi-arrow-up-short"></i></a>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/js/main.js"></script>
  
  <script>
    // Funciones de exportación
    function exportPDF() {
      const { jsPDF } = window.jspdf;
      const doc = new jsPDF({ 
        orientation: 'landscape',
        unit: 'mm'
      });
      
      // Título del documento
      doc.setFont('Raleway', 'normal');
      doc.setFontSize(20);
      doc.setTextColor(8, 127, 35); // Color primary-dark
      doc.text('Lista de Usuarios - EcoReboot', 105, 15, { align: 'center' });
      
      // Fecha de generación
      doc.setFont('Poppins', 'normal');
      doc.setFontSize(12);
      doc.setTextColor(51, 51, 51); // Color text-color
      doc.text(`Generado el: ${new Date().toLocaleDateString()}`, 105, 22, { align: 'center' });
      
      // Tabla de datos
      doc.autoTable({
        html: '#usersTable',
        startY: 30,
        theme: 'grid',
        headStyles: { 
          fillColor: [76, 175, 80], // primary-color
          textColor: 255,
          fontStyle: 'bold',
          fontSize: 12
        },
        bodyStyles: {
          fontSize: 10,
          textColor: [51, 51, 51] // text-color
        },
        styles: { 
          font: 'Poppins',
          fontSize: 10,
          cellPadding: 3,
          overflow: 'linebreak'
        },
        margin: { top: 30 },
        didDrawPage: function (data) {
          // Pie de página
          doc.setFontSize(10);
          doc.setTextColor(150);
          doc.text(`Página ${data.pageCount}`, data.settings.margin.left, doc.internal.pageSize.height - 10);
        }
      });
      
      doc.save(`Usuarios_EcoReboot_${new Date().toISOString().slice(0,10)}.pdf`);
    }

    function exportExcel() {
      const table = document.querySelector('#usersTable');
      const wb = XLSX.utils.table_to_book(table, { 
        sheet: "Usuarios",
        raw: true
      });
      
      // Agregar título y fecha
      XLSX.utils.sheet_add_aoa(wb.Sheets["Usuarios"], [
        ["EcoReboot - Lista de Usuarios"],
        [`Generado el: ${new Date().toLocaleDateString()}`],
        [""] // Espacio en blanco
      ], { origin: "A1" });
      
      // Establecer anchos de columna
      if (!wb.Sheets["Usuarios"]["!cols"]) wb.Sheets["Usuarios"]["!cols"] = [];
      for (let i = 0; i < 6; i++) {
        wb.Sheets["Usuarios"]["!cols"][i] = { wch: i === 0 ? 5 : (i === 5 ? 25 : 15) };
      }
      
      XLSX.writeFile(wb, `Usuarios_EcoReboot_${new Date().toISOString().slice(0,10)}.xlsx`);
    }

    // Funciones de filtrado
    function applyFilters() {
      const role = document.getElementById('filterRole').value;
      
      // Ocultar todas las filas primero
      document.querySelectorAll('#usersTable tbody tr').forEach(row => {
        row.style.display = 'none';
      });
      
      // Mostrar solo las filas que coincidan con los filtros
      document.querySelectorAll('#usersTable tbody tr').forEach(row => {
        const rowRole = row.cells[4].getAttribute('data-role-id') || '';
        
        const roleMatch = !role || rowRole === role;
        
        if (roleMatch) {
          row.style.display = '';
        }
      });
      
      // Cerrar el dropdown
      const dropdown = new bootstrap.Dropdown(document.getElementById('filterDropdown'));
      dropdown.hide();
    }

    function resetFilters() {
      document.getElementById('filterRole').value = '';
      
      // Mostrar todas las filas
      document.querySelectorAll('#usersTable tbody tr').forEach(row => {
        row.style.display = '';
      });
    }
  </script>
</body>
</html>
<?php
// Limpiamos el buffer al final del script
ob_end_flush();
?>