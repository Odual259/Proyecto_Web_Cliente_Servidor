<?php
include "connection.php"; // Incluye el archivo de conexión a la base de datos 

$sql = "SELECT Process, Due_date FROM processes";
$result = $conn->query($sql);
$data = array();

while ($row = $result->fetch_assoc()) {
    $data[] = array(
        'Process' => $row['Process'],
        'Due_date' => $row['Due_date']
    );
}
echo json_encode($data);
