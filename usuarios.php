<?php
include "connection.php"; // Incluye el archivo de conexión a la base de datos

session_start(); // Inicia la sesión
$usuario = $_SESSION["users"]; // Obtiene el usuario de la sesión

// Función para agregar un nuevo usuario
function agregarUsuario($firstName, $lastName, $email, $password) {
    global $conn;

    // Preparar la consulta SQL para agregar un usuario
    $stmt = $conn->prepare("INSERT INTO users (First_Name, Last_Name, Email, Password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $firstName, $lastName, $email, $password);

   // Ejecutar la consulta preparada
    if ($stmt->execute() === TRUE) {
        // Redirigir al usuario a una página de confirmación
        header("Location: confirmation.php");
        exit(); // Termina el script para evitar ejecución adicional
    } else {
        echo "Error al agregar usuario: " . $conn->error;
    }


    // Cerrar la consulta preparada
    $stmt->close();
}

// Verifica si se envió el formulario para agregar un nuevo usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["first-name"])) {
    // Verifica si se enviaron los datos necesarios
    if(isset($_POST['first-name']) && isset($_POST['last-name']) && isset($_POST['email']) && isset($_POST['password'])) {
        $firstName = $_POST['first-name'];
        $lastName = $_POST['last-name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        agregarUsuario($firstName, $lastName, $email, $password);
    }
}

// Verificar si se envió una solicitud de eliminación de usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $userIdToDelete = $_POST["delete"];

    // Evitar la inyección de SQL utilizando una declaración preparada
    $deleteSql = "DELETE FROM users WHERE User_ID = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("i", $userIdToDelete);

    // Ejecutar la consulta de eliminación
    if ($deleteStmt->execute()) {
        // Redirige al usuario a la página de usuarios después de completar la acción
        header("Location: usuarios.php");
        exit(); // Termina el script para evitar ejecución adicional
    } else {
        echo "Error al eliminar el usuario: " . $deleteStmt->error;
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
    <title>Registered Users</title>
    <!-- Agrega enlaces a tus estilos CSS -->
    <link rel="stylesheet" type="text/css" href="Styles/styles.css">
</head>

<body>

<header id="headerMenu">
    <!-- Aquí colocamos el logotipo y el título -->
    <a href="index.html">
        <img id="logoDarkBackgrounds" src="https://1000logos.net/wp-content/uploads/2023/03/KPMG-logo.png"
        alt="KDN Project Management Tool">
    </a>
    <h1>KDN Project Management Tool</h1>
</header>

<?php include "menu.php"; ?>

<h2>Registered Users</h2>

<!-- Botón para agregar un nuevo usuario -->
<button id="add-user-btn" onclick="showForm()">Add User</button>

<div id="insert-form-container" style="display: none;">
    <h3>Insert/Edit User</h3>
    <form id="user-form" method="POST" action="">
        <!-- Aquí puedes colocar campos para agregar un nuevo usuario -->
        <label for="first-name">First Name:</label>
        <input type="text" id="first-name" name="first-name" required>

        <label for="last-name">Last Name:</label>
        <input type="text" id="last-name" name="last-name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" id="save-btn">Save</button>
        <button type="button" id="cancel-btn" onclick="hideForm()">Cancel</button>
    </form>
</div>

<div id="container">    
    <table>
        <tr>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <!-- No necesitas mostrar la contraseña en la tabla -->
            <th>Actions</th>
        </tr>
        <?php
            // Consulta SQL para obtener todos los usuarios
            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);

            // Verifica si hay resultados
            if ($result->num_rows > 0) {
                // Itera sobre los resultados y muestra cada usuario en una fila de la tabla
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row["User_ID"] ?></td>
                        <td><?php echo $row["First_Name"] ?></td>
                        <td><?php echo $row["Last_Name"] ?></td>
                        <td><?php echo $row["Email"] ?></td>
                        <td class="buttonAction">
                            <!-- Agrega un formulario para eliminar usuarios -->
                            <form method="POST" action="">
                                <input type="hidden" name="delete" value="<?php echo $row["User_ID"] ?>">
                                <button type="submit" class="delete-btn"><i class="fas fa-trash"></i>Delete</button>
                            </form>
                            <!-- Agrega un formulario para editar usuarios -->
                            <form method="POST" action="" onsubmit="return showEditForm(<?php echo $row["User_ID"] ?>);">
                                <input type="hidden" name="edit" value="<?php echo $row["User_ID"] ?>">
                                <button type="submit" class="edit-btn"><i class="fas fa-edit"></i>Edit</button>
                            </form>
                        </td>
                    </tr>
                <?php }
            } else {
                echo "<tr><td colspan='5'>No records found.</td></tr>";
            }
        ?>
    </table>
</div>

<script>
    function showForm() {
        var formContainer = document.getElementById("insert-form-container");
        formContainer.style.display = "block";
    }

    function hideForm() {
        var formContainer = document.getElementById("insert-form-container");
        formContainer.style.display = "none";
    }

    function showEditForm(userId) {
        // Aquí puedes implementar la lógica para mostrar el formulario de edición
        // Puedes usar AJAX para cargar los datos del usuario y mostrarlos en el formulario de edición
        // o simplemente redireccionar a una página de edición donde puedas procesar los cambios.
        // Por ahora, simplemente redirigimos a una página de edición con el ID del usuario en la URL.
        window.location.href = "edit_user.php?id=" + userId;
        return false; // Para evitar que el formulario se envíe directamente
    }
</script>

</body>
</html>
