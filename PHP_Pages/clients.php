<?php
include "connection.php";

session_start();
$usuario = $_SESSION["users"];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registered Clients</title>
    <link rel="stylesheet" type="text/css" href="../Styles/styles.css">
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
    <div id="container">    
        <table>
            <tr>
                <th>Client ID</th>
                <th>Client Name</th>
                <th>Complexity</th>
                <th>Engagement</th>
                <th>Client Status</th>
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