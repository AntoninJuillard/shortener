<?php
    session_unset();
    session_destroy();
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
        <form method="POST" action="connecter.php" class="home_form">
            <p>Connecte toi Raphael!</p>
            <input type="email" name="email" id="email" placeholder="email">
            <input type="password" name="password" id="password" placeholder="mot de passe">
            <div>
                <button class="home_new-account-button"><a href="inscription.php">CRÉER UN COMPTE</a></button>
                <input type="submit" value="CONNEXION" name="submit" class="home_form_submit-button"/>
            </div>
        </form>
    </div>
</body>
</html>