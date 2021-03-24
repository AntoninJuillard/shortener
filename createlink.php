<?php

include 'addlink.php'

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
        <div class="account-button">mon compte</div>
        <form method="POST" action="createlink.php" class="home_form">
            <label for="lien" class="form_label">Rentrez votre lien</label>
            <input type="text" name="lien" id="lien" placeholder="mettre lien ici">
            <input type="submit" name="submit" value="GO" class="home_form_submit-button home_form_submit-register-button"/>
            <div class="short-url-container">
                <?php echo "http://localhost:8888/shortener/v.php?key=".$urlshort ?>
            </div>
        </form>
        
    </div>
    <div class="account_zone">
        <div class="account_container">
            <div class="account_link-title">Mes liens</div>
            <div class="account_link-container">
                <div class="account_link-element">
                    <div class="account_link-element_title">lien1.com</div>
                    <div class="account_link-element_state"></div>
                    <div class="account_link-element_activate-button">desactiver</div>
                    <div class="account_link-element_views">
                        <div class="icon"></div>
                        <div class="number">0</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="linkszone.js"></script>
</body>
</html>