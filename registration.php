<?php
    include 'includes/register.php';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shortener</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&family=Nunito:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="registration.css">
</head>
<body>
    <div class="home_container_registration">
        <h1>Registration</h1>
        <form method="POST" class="home_form" action="registration.php">
            <input type="email" name="email" id="email" class="input" placeholder="email">
            <input type="password" name="password" id="password" class="input" placeholder="password">
            <input type="password" name="password" id="password" class="input" placeholder="confirm password">
            <input type="submit" value="Register" name="submit" class="register_button"/>
        </form>
    </div>
</body>
</html>