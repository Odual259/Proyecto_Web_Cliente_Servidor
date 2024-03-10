<?php
include "../PHP_Methods/connection.php";

session_start();
$usuario = $_SESSION["users"];

// Verificar si se envió el formulario para insertar datos en la base de datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén los datos del formulario
    $clientName = $_POST["client-name"];
    $complexity = $_POST["complexity"];
    $engagement = $_POST["engagement"];
    $clientStatus = $_POST["client-status"];

    // Evita la inyección de SQL utilizando declaraciones preparadas
    $sql = "INSERT INTO clients (Client_Name, Complexity, Engagement, Client_Status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $clientName, $complexity, $engagement, $clientStatus);

    // Ejecuta la consulta
    if ($stmt->execute()) {
        echo "Datos insertados correctamente.";
    } else {
        echo "Error al insertar datos: " . $stmt->error;
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
        echo "Cliente eliminado correctamente.";
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
    <link rel="stylesheet" type="text/css" href="../Styles/styles.css">
    <script src="../JavaScripts_Methods/formManagement.js"></script>
</head>

<body>

<header id="headerMenu">
    <a href="../HTML_Pages/index.html">
        <img id="logoDarkBackgrounds" src="https://1000logos.net/wp-content/uploads/2023/03/KPMG-logo.png"
        alt="KDN Project Management Tool">
    </a>
    <h1>KDN Project Management Tool</h1>
</header>
<nav>
    <a href="../PHP_Pages/clients.php">Clients</a>
    <a href="../PHP_Pages/calendar.php">Calendar</a>
    <a href="../PHP_Pages/processes.php">Processes</a>
    <a href="../PHP_Pages/team.php">Team</a>
    <a href="../PHP_Pages/news.php">News</a>
</nav>
<h2>Registered Clients</h2>

<button id="add-client-btn" class="form-open">Add Client</button>

<div id="overlay"></div>
    <div id="insert-form-container" style="display: none;">
        <h3>Insertar/Editar Cliente</h3>
        <form id="client-form" method="POST" action="">
            <label for="client-id">Client ID:</label>
            <input type="text" id="client-id" name="client-id" readonly>

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
            $sql = "SELECT * FROM clients";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row["ID_Client"] ?></td>
                        <td><?php echo $row["Client_Name"] ?></td>
                        <td><?php echo $row["Complexity"] ?></td>
                        <td><?php echo $row["Engagement"] ?></td>
                        <td><?php echo $row["Client_Status"] ?></td>
                        <td class="buttonAction">
                            <button class="edit-btn" data-id="<?php echo $row["ID_Client"] ?>"><i class="fas fa-edit"></i>Edit</button>
                            <button class="delete-btn" data-id="<?php echo $row["ID_Client"] ?>"><i class="fas fa-trash"></i>Delete</button> 
                        </td>
                    </tr>
                <?php }
            } else {
                echo "No se encontraron registros.";
            }
        ?>
    </table>
</div>

</body>
</html>
