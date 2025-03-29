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
  <script src="https://unpkg.com/@zxing/library@0.18.6"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
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

      <!-- Botones de exportación -->
      <div class="mb-3">
        <button class="btn btn-success" onclick="exportPDF()">
          <i class="bi bi-file-pdf"></i> Exportar PDF
        </button>
        <button class="btn btn-success" onclick="exportExcel()">
          <i class="bi bi-file-spreadsheet"></i> Exportar Excel
        </button>
      </div>

      <?php
      include 'db.php';

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

      $result = $conn->query("SELECT d.id_donacion, u.nombre AS usuario, t.nombre AS tipo, e.nombre AS estado, d.fecha, d.imperfecciones, d.telefono, d.total_dispositivos
                              FROM Donaciones d
                              JOIN Usuarios u ON d.id_usuario = u.id_usuario
                              JOIN Tipo_Electrodomestico t ON d.id_tipo_electrodomestico = t.id_tipo_electrodomestico
                              JOIN Estado_Dispositivo e ON d.id_estado_dispositivo = e.id_estado_dispositivo
                              ORDER BY d.id_donacion ASC");

      if ($result->num_rows > 0) {
          echo '<table class="table table-striped" id="donationsTable">';
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
                      <a href="?action=edit&id='.$row['id_donacion'].'" class="btn btn-success btn-sm" onclick="return confirm(\'¿Editar esta donación?\')">Editar</a>
                      <a href="?action=delete&id='.$row['id_donacion'].'" class="btn btn-danger btn-sm" onclick="return confirm(\'¿Eliminar esta donación?\')">Eliminar</a>
                      <div class="dropdown d-inline">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="codeDropdown'.$row['id_donacion'].'" data-bs-toggle="dropdown" aria-expanded="false">
                          Generar Código
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="codeDropdown'.$row['id_donacion'].'">
                          <li><button class="dropdown-item" onclick="generarCodigoBarras('.$row['id_donacion'].', \''.$row['tipo'].'\', \''.$row['fecha'].'\')">Código de Barras</button></li>
                          <li><button class="dropdown-item" onclick="generarCodigoQR('.$row['id_donacion'].', \''.$row['tipo'].'\', \''.$row['fecha'].'\')">Código QR</button></li>
                        </ul>
                      </div>
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

  <!-- Modal para códigos -->
  <div class="modal fade" id="codeModal" tabindex="-1" aria-labelledby="codeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="codeModalLabel">Código</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body text-center">
          <p id="codeInfo"></p>
          <img id="codeImage" class="code-img" src="" alt="Código">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" onclick="printCode()">Imprimir</button>
        </div>
      </div>
    </div>
  </div>

  <a href="#" class="back-to-top"><i class="bi bi-arrow-up-short"></i></a>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/js/main.js"></script>
  
  <script>
    // Funciones para generación de códigos
    function generarCodigoBarras(id, tipo, fecha) {
      let data = `ID:${id} | Tipo:${tipo} | Fecha:${fecha}`;
      let url = `https://barcode.tec-it.com/barcode.ashx?data=${encodeURIComponent(data)}&code=Code128&translate-esc=on&dpi=96`;
      mostrarCodigoEnModal(url, "Código de Barras");
    }

    function generarCodigoQR(id, tipo, fecha) {
      let data = `ID:${id} | Tipo:${tipo} | Fecha:${fecha}`;
      let url = `https://barcode.tec-it.com/barcode.ashx?data=${encodeURIComponent(data)}&code=QRCode&translate-esc=on&eclevel=L`;
      mostrarCodigoEnModal(url, "Código QR");
    }

    function mostrarCodigoEnModal(url, titulo) {
      document.getElementById("codeModalLabel").textContent = titulo;
      document.getElementById("codeImage").src = url;
      new bootstrap.Modal(document.getElementById('codeModal')).show();
    }

    function printCode() {
      const codeImage = document.getElementById('codeImage').src;
      const codeType = document.getElementById('codeModalLabel').textContent;
      
      const printWindow = window.open('', '_blank');
      printWindow.document.write(`
        <html><head><title>${codeType} - EcoReboot</title>
        <style>body { text-align: center; } img { max-width: 100%; }</style></head>
        <body><h2>${codeType}</h2><img src="${codeImage}"></body></html>
      `);
      printWindow.document.close();
      printWindow.print();
    }

    // Funciones de exportación
    function exportPDF() {
      const { jsPDF } = window.jspdf;
      const doc = new jsPDF({ orientation: 'landscape' });
      
      doc.autoTable({
          html: '#donationsTable',
          theme: 'grid',
          headStyles: { fillColor: [34, 139, 34] },
          styles: { font: 'helvetica', fontSize: 12 },
          margin: { top: 20 },
          didDrawPage: function (data) {
              doc.text('Lista de Donaciones - EcoReboot', 15, 10);
          }
      });
      
      doc.save(`donaciones_${new Date().toISOString().slice(0,10)}.pdf`);
    }

    function exportExcel() {
      const table = document.querySelector('#donationsTable');
      const wb = XLSX.utils.table_to_book(table, { sheet: "Donaciones" });
      XLSX.writeFile(wb, `donaciones_${new Date().toISOString().slice(0,10)}.xlsx`);
    }
  </script>
</body>
</html>