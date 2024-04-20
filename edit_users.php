<?php
include "connection.php";

// Verificar si se recibió el ID del usuario a editar a través de la URL
if(isset($_GET["id"])) {
    $userId = $_GET["id"];

    // Realizar la consulta para obtener los datos del usuario con el ID proporcionado
    $sql = "SELECT * FROM users WHERE User_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró un usuario con el ID proporcionado
    if($result->num_rows == 1) {
        $user = $result->fetch_assoc(); // Obtener los datos del usuario
        // Los datos del usuario se pueden utilizar para prellenar el formulario de edición
        $firstName = $user["First_Name"];
        $lastName = $user["Last_Name"];
        $email = $user["Email"];
        // Si hay más campos, puedes obtenerlos de manera similar
    } else {
        // Si no se encuentra ningún usuario con el ID proporcionado, redirigir a una página de error o a otra página
        header("Location: error_page.php");
        exit();
    }
} else {
    // Si no se proporciona un ID de usuario, redirigir a una página de error o a otra página
    header("Location: error_page.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- Agregar enlaces a tus estilos CSS -->
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

<h2>Edit User</h2>

<div id="edit-form-container">
    <h3>Edit User Information</h3>
    <form id="edit-user-form" method="POST" action="update_user.php">
        <!-- Aquí puedes colocar campos para editar la información del usuario -->
        <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
        <label for="edit-first-name">First Name:</label>
        <input type="text" id="edit-first-name" name="first_name" value="<?php echo $firstName; ?>" required>

        <label for="edit-last-name">Last Name:</label>
        <input type="text" id="edit-last-name" name="last_name" value="<?php echo $lastName; ?>" required>

        <label for="edit-email">Email:</label>
        <input type="email" id="edit-email" name="email" value="<?php echo $email; ?>" required>

        <button type="submit" id="save-edit-btn">Save Changes</button>
        <button type="button" id="cancel-edit-btn" onclick="goBack()">Cancel</button>
    </form>
</div>

<script>
    function goBack() {
        window.history.back();
    }
</script>

</body>

</html>
