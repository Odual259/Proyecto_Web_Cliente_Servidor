<?php
include "connection.php"; // Incluye el archivo de conexión a la base de datos

session_start(); // Inicia la sesión
$usuario = $_SESSION["users"]; // Obtiene el usuario de la sesión

// Verifica si se envió el formulario para insertar o actualizar datos en la base de datos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["client-name"])) {
    // Obtén los datos del formulario
    $clientName = $_POST["client-name"];
    $complexity = $_POST["complexity"];
    $engagement = $_POST["engagement"];
    $clientStatus = $_POST["client-status"];
    
    if(isset($_POST["client-id"]) && !empty($_POST["client-id"])) {
        // Si se proporciona un ID de cliente, la solicitud es para actualizar un cliente existente
        $clientId = $_POST["client-id"];
        $sql = "UPDATE clients SET Client_Name=?, Complexity=?, Engagement=?, Client_Status=? WHERE ID_Client=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $clientName, $complexity, $engagement, $clientStatus, $clientId);
    } else {
        // Si no se proporciona un ID de cliente, la solicitud es para insertar un nuevo cliente
        $sql = "INSERT INTO clients (Client_Name, Complexity, Engagement, Client_Status) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $clientName, $complexity, $engagement, $clientStatus);
    }

    // Ejecuta la consulta
    if ($stmt->execute()) {
        // Redirige al usuario a la página de clientes después de completar la acción
        header("Location: clients.php");
        exit(); // Termina el script para evitar ejecución adicional
    } else {
        echo "Error al guardar los datos: " . $stmt->error;
    }

    // Cierra la declaración
    $stmt->close();
}

// Verificar si se envió una solicitud de eliminación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $clientIdToDelete = $_POST["delete"];

    // Evitar la inyección de SQL utilizando una declaración preparada
    $deleteSql = "DELETE FROM clients WHERE ID_Client = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("i", $clientIdToDelete);

    // Ejecutar la consulta de eliminación
    if ($deleteStmt->execute()) {
        // Redirige al usuario a la página de clientes después de completar la acción
        header("Location: clients.php");
        exit(); // Termina el script para evitar ejecución adicional
    } else {
        echo "Error al eliminar el cliente: " . $deleteStmt->error;
    }

    // Cerrar la declaración de eliminación
    $deleteStmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Clients</title>
    <link rel="stylesheet" type="text/css" href="Styles/styles.css">
    <script src="formManagement.js"></script>
</head>

<body>

<header id="headerMenu">
    <a href="index.php">
        <img id="logoDarkBackgrounds" src="https://1000logos.net/wp-content/uploads/2023/03/KPMG-logo.png"
        alt="KDN Project Management Tool">
    </a>
    <h1>KDN Project Management Tool</h1>
</header>

<?php include "menu.php"; ?>

<h2>Registered Clients</h2>

<button id="add-client-btn" class="form-open">Add Client</button>

<div id="overlay"></div>
    <div id="insert-form-container" style="display: none;">
        <h3>Insertar/Editar Cliente</h3>
        <form id="client-form" method="POST" action="">
            <input type="hidden" id="client-id" name="client-id">
            <label for="client-name">Client Name:</label>
            <input type="text" id="client-name" name="client-name" required>

            <label for="complexity">Complexity:</label>
            <input type="text" id="complexity" name="complexity" required>

            <label for="engagement">Engagement:</label>
            <input type="text" id="engagement" name="engagement" required>

            <label for="client-status">Client Status:</label>
            <input type="text" id="client-status" name="client-status" required>

            <button type="submit" id="save-btn">Guardar</button>
            <button type="button" id="cancel-btn">Cancelar</button>
        </form>
    </div>
</div>

<div id="container">    
    <table>
        <tr>
            <th>Client ID</th>
            <th>Client Name</th>
            <th>Complexity</th>
            <th>Engagement</th>
            <th>Client Status</th>
            <th>Actions</th>
        </tr>
        <?php
             // Consulta SQL para obtener todos los clientes
            $sql = "SELECT * FROM clients";
            $result = $conn->query($sql);

            // Verifica si hay resultados
            if ($result->num_rows > 0) {
                // Itera sobre los resultados y muestra cada cliente en una fila de la tabla
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row["ID_Client"] ?></td>
                        <td><?php echo $row["Client_Name"] ?></td>
                        <td><?php echo $row["Complexity"] ?></td>
                        <td><?php echo $row["Engagement"] ?></td>
                        <td><?php echo $row["Client_Status"] ?></td>
                        <td class="buttonAction">
                        <td class="buttonAction">
                        <button class="edit-btn" data-id="<?php echo $row["ID_Client"] ?>"><i class="fas fa-edit"></i>Edit</button>
                        <button class="delete-btn" data-id="<?php echo $row["ID_Client"] ?>"><i class="fas fa-trash"></i>Delete</button>
                        </td>
                        </td>
                    </tr>
                <?php }
            } else {
                echo "<tr><td colspan='6'>No se encontraron registros.</td></tr>";
            }
        ?>
    </table>
</div>

</body>
</html>