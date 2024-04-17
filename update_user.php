<?php
include "connection.php"; // Incluye el archivo de conexión a la base de datos

// Verificar si se recibió un ID de usuario a actualizar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"])) {
    $user_id = $_POST["user_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];

    // Preparar la consulta SQL para actualizar el usuario
    $stmt = $conn->prepare("UPDATE users SET First_Name=?, Last_Name=?, Email=? WHERE User_ID=?");
    $stmt->bind_param("sssi", $first_name, $last_name, $email, $user_id);

    // Ejecutar la consulta preparada
    if ($stmt->execute()) {
        // Redireccionar a la página de usuarios después de la actualización
        header("Location: usuarios.php");
        exit(); // Terminar el script
    } else {
        echo "Error al actualizar el usuario: " . $stmt->error;
    }

    // Cerrar la consulta preparada
    $stmt->close();
} else {
    // Si no se recibe un ID de usuario, mostrar un mensaje de error
    echo "ID de usuario no proporcionado para actualizar.";
}
?>
