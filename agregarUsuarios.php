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
        echo "Usuario agregado correctamente";
    } else {
        echo "Error al agregar usuario: " . $conn->error;
    }

    // Cerrar la consulta preparada
    $stmt->close();
}

// Verifica si se envió el formulario para agregar un nuevo usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si se enviaron los datos necesarios
    if(isset($_POST['first-name']) && isset($_POST['last-name']) && isset($_POST['email']) && isset($_POST['password'])) {
        $firstName = $_POST['first-name'];
        $lastName = $_POST['last-name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        agregarUsuario($firstName, $lastName, $email, $password);
    }
}
?>
