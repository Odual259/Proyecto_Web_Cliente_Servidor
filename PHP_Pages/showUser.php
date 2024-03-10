<?php
include "../PHP_Methodsconnection.php";

session_start();
$usuario = $_SESSION["users"];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Usuarios Registrados</title>
</head>

<body>
    <h1>Hola: <?php echo $usuario ?></h1>
    <h2>Usuarios Registrados</h2>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
        </tr>
        <?php
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row["First_Name"] ?></td>
                    <td><?php echo $row["Email"] ?></td>
                </tr>
        <?php }
        } else {
            echo "No se encontraron registros.";
        }
        ?>
    </table>
</body>

</html>