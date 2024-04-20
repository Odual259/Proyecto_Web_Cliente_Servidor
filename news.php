<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KDN Project Management Tool - News</title>
    <title>Registered Clients</title>
    <link rel="stylesheet" type="text/css" href="Styles/styles.css">

    <script>
        function toggleForm() {
            var form = document.getElementById("addNewsForm");
            form.style.display = form.style.display === "none" ? "block" : "none";
        }
    </script>

</head>

<body>

    <?php
    session_start();
    $usuario = isset($_SESSION["users"]) ? $_SESSION["users"] : '';
    $user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : '';

    echo "<header>
            <h1>Welcome, $usuario, to KDN Project Management Tool</h1>
            <img id='logoDarkBackgrounds' src='https://1000logos.net/wp-content/uploads/2023/03/KPMG-logo.png'>
        </header>";
    ?>

    <?php include "menu.php"; ?>

    <section>
        <h2>News</h2>

        <button onclick="toggleForm()">Add news</button>
        <form id="addNewsForm" action="news_Actions.php" method="post">
            <label for="Title">News Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="Detail">Detail:</label>
            <textarea id="body" name="body" rows="4" required></textarea>

            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <button type="submit">Add</button>
        </form>
    </section>

        <?php
        include "connection.php";

        $sql = "SELECT * FROM news";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>News Title</th>
                        <th>Detail</th>
                    </tr>";
            // Muestra las noticias en la tabla
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['Title']}</td>
                        <td>{$row['Body']}</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "No news available";
        }

        $conn->close();
        ?>
    </section>

</body>

</html>