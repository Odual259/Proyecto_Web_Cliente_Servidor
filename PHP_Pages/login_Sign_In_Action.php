<?php
include "connection.php";
$action = isset($_POST["action"]) ? $_POST["action"] : '';

switch ($action) {
    case "register":
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
        $name = isset($_POST["name"]) ? $_POST["name"] : '';
        $email = isset($_POST["email"]) ? $_POST["email"] : '';

        if (!empty($name) && !empty($email) && !empty($password)) {
            $sql = "INSERT INTO users (First_Name, Email, Password) VALUES ('$name', '$email', '$password')";
            
            if ($conn->query($sql) === TRUE) {
                header("Location: login.html");
            } else {
                echo "No se pudieron agregar registros: " . $conn->error;
            }
        } else {
            echo "Por favor, complete todos los campos del formulario.";
        }
        break;

    case "login":
        $usuario = isset($_POST["name"]) ? $_POST["name"] : '';
        $password = isset($_POST["password"]) ? $_POST["password"] : '';

        if (!empty($usuario) && !empty($password)) {
            $sql = "SELECT * FROM users WHERE First_Name = '$usuario'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if (password_verify($password, $row["Password"])) {
                        session_start();
                        $_SESSION["users"] = $row["First_Name"];
                        $_SESSION["user_id"] = $row["User_ID"];
                        header("Location: index.html");
                    } else {
                        echo "Hay error en el inicio de sesión.";
                    }
                }
            } else {
                echo "No se encontró ningún usuario con ese nombre.";
            }
        } else {
            echo "Por favor, complete todos los campos del formulario.";
        }
        break;

    default:
        echo "Acción no válida.";
}
?>