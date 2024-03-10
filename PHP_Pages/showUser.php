<?php
include "connection.php";

session_start();
$usuario = $_SESSION["users"];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Usuarios Registrados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }

        h1 {
            color: rgb(0, 44, 151);
        }

        h2 {
            margin-top: 20px;
            color: rgb(0, 44, 151);
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: rgb(0, 44, 151);
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
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