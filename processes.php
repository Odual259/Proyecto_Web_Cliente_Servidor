<?php
include "connection.php"; // Incluye el archivo de conexión a la base de datos

session_start(); // Inicia la sesión
$usuario = $_SESSION["users"]; // Obtiene el usuario de la sesión

setlocale(LC_ALL, 'es_ES');

// Obtener el nombre del mes actual en español
$mes_actual = strftime('%B');

// Verifica si se envió el formulario para insertar o actualizar datos en la base de datos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["process-name"])) {
    // Obtén los datos del formulario
    $processName = $_POST["process-name"];
    $idClient = $_POST["idClient"];
    $idEntity = $_POST["idEntity"];
    $processestatus = $_POST["process-status"];
    $period = $_POST["period"];
    $year = $_POST["year"];
    $due_date = $_POST["due_date"];
    
    if(isset($_POST["process-id"]) && !empty($_POST["process-id"])) {
        // Si se proporciona un ID de proceso, la solicitud es para actualizar un proceso existente
        $processId = $_POST["process-id"];
        $sql = "UPDATE processes SET process_Name=?, idClient=?, idEntity=?, process_Status=?, period=?, year=?, due_date=? WHERE ID_process=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $processName, $idClient, $idEntity, $processestatus, $processId, $period , $year , $due_date);
    } else {
        // Si no se proporciona un ID de proceso, la solicitud es para insertar un nuevo proceso
        $sql = "INSERT INTO processes (process_Name, idClient, idEntity, process_Status, processId, period , year , due_date) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $processName, $idClient, $idEntity, $processestatus);
    }

    // Ejecuta la consulta
    if ($stmt->execute()) {
        // Redirige al usuario a la página de procesos después de completar la acción
        header("Location: processes.php");
        exit(); // Termina el script para evitar ejecución adicional
    } else {
        echo "Error al guardar los datos: " . $stmt->error;
    }

    // Cierra la declaración
    $stmt->close();
}

// Verificar si se envió una solicitud de eliminación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $processIdToDelete = $_POST["delete"];

    // Evitar la inyección de SQL utilizando una declaración preparada
    $deleteSql = "DELETE FROM processes WHERE ID_process = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("i", $processIdToDelete);

    // Ejecutar la consulta de eliminación
    if ($deleteStmt->execute()) {
        // Redirige al usuario a la página de procesos después de completar la acción
        header("Location: processes.php");
        exit(); // Termina el script para evitar ejecución adicional
    } else {
        echo "Error al eliminar el proceso: " . $deleteStmt->error;
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
    <title>Processes List</title>
    <link rel="stylesheet" type="text/css" href="Styles/styles.css">
    <script src="formManagement.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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

<h2>Processes List</h2>

<button id="add-client-btn" class="form-open">Add Process</button>

<div id="overlay"></div>
<div id="insert-form-container" style="display: none;">
    <form id="process-form" method="POST" action="">
        <div class="row">
            <div class="col-md-4">
                <input type="hidden" id="process-id" name="process-id">
                <label for="processName" class="form-label">Process Name</label>
                <input type="text" class="form-control" id="processName" placeholder="">
            </div>
            <div class="col-md-4">
                <label for="clientName" class="form-label">Client</label>
                <select class="form-select" aria-label="" name="cliente">
                <option selected value="Select Client"></option>
                <?php
                $sql = "SELECT * FROM clients";
                $result = $conn->query($sql);
                // Verifica si hay resultados
                if ($result->num_rows > 0) {
                    // Itera sobre los resultados y muestra cada cliente como una opción en el select
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row["ID_Client"] . "\">" . $row["Client_Name"] . "</option>";
                    }
                } else {
                    echo "<option value=\"\">No se encontraron clientes</option>";
                }
                ?>
            </select>
            </div>
            <div class="col-md-4">
                <label for="entityName" class="form-label">Entity</label>
                <select class="form-select" aria-label="" name="entity">
                <option selected value="Select Entity"></option>
                <?php
                $sql = "SELECT * FROM entities";
                $result = $conn->query($sql);
                // Verifica si hay resultados
                if ($result->num_rows > 0) {
                    // Itera sobre los resultados y muestra cada entidad como una opción en el select
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row["ID_Entity"] . "\">" . $row["Entity_Name"] . "</option>";
                    }
                } else {
                    echo "<option value=\"\">No se encontraron entidades</option>";
                }
                ?>
            </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label for="cluster" class="form-label">Cluster</label>
                <select class="form-select" aria-label="" name="cluster">
                <option selected value="Select Entity"></option>
                <?php
                $sql = "SELECT * FROM clusters";
                $result = $conn->query($sql);
                // Verifica si hay resultados
                if ($result->num_rows > 0) {
                    // Itera sobre los resultados y muestra cada entidad como una opción en el select
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row["ID_Cluster"] . "\">" . $row["Cluster"] . "</option>";
                    }
                } else {
                    echo "<option value=\"\">No se encontraron clusters</option>";
                }
                ?>
            </select>
            </div>
            <div class="col-md-4">
                <label for="country" class="form-label">Country</label>
                <select class="form-select" aria-label="" name="country">
                <option selected value="Select Entity"></option>
                <?php
                $sql = "SELECT * FROM countries";
                $result = $conn->query($sql);
                // Verifica si hay resultados
                if ($result->num_rows > 0) {
                    // Itera sobre los resultados y muestra cada entidad como una opción en el select
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row["ID_Country"] . "\">" . $row["Country"] . "</option>";
                    }
                } else {
                    echo "<option value=\"\">No se encontraron countries</option>";
                }
                ?>
            </select>
            </div>
            <div class="col-md-4">
                <label for="area" class="form-label">Area</label>
                <select class="form-select" aria-label="" name="area">
                <option selected value="Select Entity"></option>
                <?php
                $sql = "SELECT * FROM areas";
                $result = $conn->query($sql);
                // Verifica si hay resultados
                if ($result->num_rows > 0) {
                    // Itera sobre los resultados y muestra cada entidad como una opción en el select
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row["ID_Area"] . "\">" . $row["Area"] . "</option>";
                    }
                } else {
                    echo "<option value=\"\">No se encontraron countries</option>";
                }
                ?>
            </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" aria-label="" name="category">
                <option selected value="Select Category"></option>
                <?php
                $sql = "SELECT * FROM categories";
                $result = $conn->query($sql);
                // Verifica si hay resultados
                if ($result->num_rows > 0) {
                    // Itera sobre los resultados y muestra cada entidad como una opción en el select
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row["ID_Category"] . "\">" . $row["Category"] . "</option>";
                    }
                } else {
                    echo "<option value=\"\">No se encontraron categorías</option>";
                }
                ?>
            </select>
            </div>
            <div class="col-md-4">
                <label for="periodicity" class="form-label">Periodicity</label>
                <select class="form-select" aria-label="" name="periodicity">
                <option selected value="Select Periodicity"></option>
                <?php
                $sql = "SELECT * FROM periodicity";
                $result = $conn->query($sql);
                // Verifica si hay resultados
                if ($result->num_rows > 0) {
                    // Itera sobre los resultados y muestra cada entidad como una opción en el select
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row["ID_Periodicity"] . "\">" . $row["Periodicity"] . "</option>";
                    }
                } else {
                    echo "<option value=\"\">No se encontraron periodicidades</option>";
                }
                ?>
            </select>
            </div>
            <div class="col-md-4">
                <label for="approver" class="form-label">Approver</label>
                <select class="form-select" aria-label="" name="approver">
                <option selected value="Select Approver"></option>
                <?php
                $sql = "SELECT * FROM users";
                $result = $conn->query($sql);
                // Verifica si hay resultados
                if ($result->num_rows > 0) {
                    // Itera sobre los resultados y muestra cada entidad como una opción en el select
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row["User_ID"] . "\">" . $row["First_Name"] . "</option>";
                    }
                } else {
                    echo "<option value=\"\">No se encontraron usuarios</option>";
                }
                ?>
            </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label for="analyst" class="form-label">Analyst</label>
                <select class="form-select" aria-label="" name="analyst">
                <option selected value="Select Analyst"></option>
                <?php
                $sql = "SELECT * FROM users";
                $result = $conn->query($sql);
                // Verifica si hay resultados
                if ($result->num_rows > 0) {
                    // Itera sobre los resultados y muestra cada entidad como una opción en el select
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row["User_ID"] . "\">" . $row["First_Name"] . "</option>";
                    }
                } else {
                    echo "<option value=\"\">No se encontraron usuarios</option>";
                }
                ?>
            </select>
            </div>
            <div class="col-md-4">
                <label for="period" class="form-label">Period</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected></option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="year" class="form-label">Year</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected></option>
                    <option value="1">2020</option>
                    <option value="2">2021</option>
                    <option value="3">2022</option>
                    <option value="4">2023</option>
                    <option value="5">2024</option>
                    <option value="6">2025</option>
                    <option value="7">2026</option>
                    <option value="8">2027</option>
                    <option value="9">2028</option>
                    <option value="10">2029</option>
                    <option value="11">2030</option>
                    <option value="12">2031</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label for="processStatus" class="form-label">Process Status</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected></option>
                    <option value="1">Pending Approval</option>
                    <option value="2">Approved</option>
                    <option value="3">Rejected</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <button type="submit" id="save-btn">Guardar</button>
                <button type="button" id="cancel-btn">Cancelar</button>
            </div>
        </div>
    </form>
</div>

<div id="container">    
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID Process</th>
      <th scope="col">Process</th>
      <th scope="col">ID Client</th>
      <th scope="col">ID Entity</th>
      <th scope="col">Period</th>
      <th scope="col">Year</th>
      <th scope="col">Due Date</th>
      <th scope="col">Status</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
        <?php
             // Consulta SQL para obtener todos los procesos
            $sql = "SELECT p.ID_Process, p.Process, c.Client_Name, e.Entity_Name, p.Period, p.Year, p.Due_date, p.Final_Status
            FROM processes p
            INNER JOIN clients c ON p.ID_Client = c.ID_Client
            INNER JOIN entities e ON p.ID_Entity = e.ID_Entity";
            $result = $conn->query($sql);

            // Verifica si hay resultados
            if ($result->num_rows > 0) {
                // Itera sobre los resultados y muestra cada proceso en una fila de la tabla
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row["ID_Process"] ?></td>
                        <td><?php echo $row["Process"] ?></td>
                        <td><?php echo $row["Client_Name"] ?></td>
                        <td><?php echo $row["Entity_Name"] ?></td>
                        <td><?php echo $row["Period"] ?></td>
                        <td><?php echo $row["Year"] ?></td>
                        <td><?php echo $row["Due_date"] ?></td>
                        <td><?php echo $row["Final_Status"] ?></td>
                        <td class="buttonAction">
                        <button class="edit-btn" type="button" data-id="<?php echo $row["ID_Process"] ?>"><i class="fas fa-edit"></i>Edit</button>
                        <button class="delete-btn" data-id="<?php echo $row["ID_Process"] ?>" data-type="process"><i class="fas fa-trash"></i>Delete</button>
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