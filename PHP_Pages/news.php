<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KDN Project Management Tool - Noticias</title>
    <style>
        form {
            display: none;
            margin-top: 20px;
        }
        input,
        textarea,
        button {
            margin-bottom: 10px;
        }
    </style>

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
            <img id='logo' src='ruta_de_tu_imagen/logo.png' alt='KDN Project Management Tool'>
        </header>";
    ?>

    <nav>
        <a href="#clients">Clients</a>
        <a href="#calendar">Calendar</a>
        <a href="#processes">Processes</a>
        <a href="#team">Team</a>
        <a href="news.php">News</a>
    </nav>

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
        include "../PHP_Methodsconnection.php";

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