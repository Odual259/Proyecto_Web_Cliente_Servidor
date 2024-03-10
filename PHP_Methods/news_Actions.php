<?php
include "../PHP_Methods/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $body = $_POST["body"];

    $sql = "INSERT INTO news (Title, Body) VALUES ('$title', '$body')";

    if ($conn->query($sql) === TRUE) {
        echo "Noticia agregada correctamente.";
    } else {
        echo "Error al agregar la noticia: " . $conn->error;
    }
}

$conn->close();
?>