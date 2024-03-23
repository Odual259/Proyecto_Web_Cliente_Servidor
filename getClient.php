<?php
include "connection.php"; // Incluye el archivo de conexión a la base de datos

// Verifica si se ha recibido un ID de cliente válido en la solicitud
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $clientId = $_GET['id'];

    // Prepara la consulta para obtener los datos del cliente con el ID proporcionado
    $sql = "SELECT * FROM clients WHERE ID_Client = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $clientId);

    // Ejecuta la consulta
    if ($stmt->execute()) {
        // Obtiene el resultado de la consulta
        $result = $stmt->get_result();
        
        // Verifica si se encontró un cliente con el ID proporcionado
        if ($result->num_rows > 0) {
            // Obtiene los datos del cliente y los devuelve como un objeto JSON
            $clientData = $result->fetch_assoc();
            echo json_encode($clientData);
        } else {
            // Si no se encuentra ningún cliente con el ID proporcionado, devuelve un mensaje de error
            echo json_encode(array("error" => "No se encontró ningún cliente con el ID proporcionado."));
        }
    } else {
        // Si ocurre un error al ejecutar la consulta, devuelve un mensaje de error
        echo json_encode(array("error" => "Error al obtener los datos del cliente."));
    }

    // Cierra la declaración y la conexión a la base de datos
    $stmt->close();
    $conn->close();
} else {
    // Si no se proporciona un ID de cliente válido, devuelve un mensaje de error
    echo json_encode(array("error" => "No se proporcionó un ID de cliente válido."));
}
?>
