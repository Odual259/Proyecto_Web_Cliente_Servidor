<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" type="text/css" href="Styles/styles.css">
</head>

<body id="bodyLoginRegister">
    <div id="container-register-login">
        <header id="headerLoginRegister">
            <img id="logoDarkBackgrounds" src="https://1000logos.net/wp-content/uploads/2023/03/KPMG-logo.png" alt="">
            <h1>Please complete the information to create your user:</h1>
        </header>
        
        <form action="login_Sign_In_Action.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <input type="hidden" name="action" value="register">
            <button type="submit">Sign In</button>
        </form>
    </div>
</body>

</html>
