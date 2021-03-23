<?php
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shortener</title>
    <link rel="stylesheet" href="connexion.css">
</head>
<body>
    <div class="home_container">
        <form method="POST" class="home_form" action="inscrire.php">
            <input type="email" name="email" id="email" placeholder="email">
            <input type="password" name="password" id="password" placeholder="password">
            <input type="password" name="password" id="password" placeholder="password">
            <input type="submit" value="S'inscrire" name="submit" class="home_form_submit-button home_form_submit-register-button"/>
        </form>
    </div>
</body>
</html>