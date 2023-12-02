<?php

$servername = "localhost";
$username = "facebook";
$password = "f4c3b00k";
$dbname = "facebook";

// Agregar las librerías de DataTables y Bootstrap
echo '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">';
echo '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap5.min.css">';
echo '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.3/css/select.bootstrap5.min.css">';
echo '<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">';


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query para obtener los datos de la tabla usuarios
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

// Crear la tabla con DataTables
echo '<div class="container p-3">';
echo '<table id="tabla-usuarios" class="table table-striped table-bordered">';
echo '<thead><tr><th>ID</th><th>Email</th><th>Password</th></tr></thead>';
echo '<tbody>';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr><td>' . $row["id"] . '</td><td>' . $row["email"] . '</td><td>' . $row["password"] . '</td></tr>';
    }
}
echo '</tbody>';
echo '</table>';
echo '</div>';


echo '<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>';
echo '<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>';
echo '<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>';
echo '<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap5.min.js"></script>';
echo '<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>';
// Inicializar DataTables
echo '<script type="text/javascript">';
echo '$(document).ready( function () { $("#tabla-usuarios").DataTable({';
echo '    "paging": true,';
echo '    "pageLength": 10,';
echo '    "lengthChange": false,';
echo '    "searching": false,';
echo '    "ordering": true,';
echo '    "info": true,';
echo '    "autoWidth": false,';
echo '    "responsive": true,';
echo '    "language": {';
echo '        "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"';
echo '    },';
echo '    "dom": "Bfrtip",';
echo '    "buttons": [';
echo '        {';
echo '            "extend": "excelHtml5",';
echo '            "text": "Exportar a Excel",';
echo '            "className": "btn btn-success"';
echo '        }';
echo '    ]';
echo '}); } );';
echo '</script>';

$conn->close();
