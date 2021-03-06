<?php
    // quitting the session 
    session_unset();
    session_destroy();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shortener</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&family=Nunito:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/connection.css">
    <link rel="shortcut icon" type="image/ico" href="assets/favicon.ico"/>
</head>
<body>
    <div class="home_container_connection">
        <h1>Connection</h1>
        <form method="POST" action="php/connect.php" class="home_form">
            <input type="email" name="email" id="email" class="input" placeholder="email">
            <input type="password" name="password" id="password" class="input" placeholder="password">
            <div class="buttons">
                <a class="new_account_button" href="php/registration.php">Register</a>
                <input type="submit" value="Login" name="submit" class="login_submit_button"/>
            </div>
        </form>
    </div>
</body>
</html>