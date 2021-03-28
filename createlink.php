<?php


$servername = 'localhost';
$username = 'root';
$userpassword = 'root';



// source aide pour gérer la base de donnée : https://www.w3schools.com/php/php_mysql_intro.asp
// acceder au serveur depuis Php
$connect = new mysqli($servername, $username, $userpassword);

// source pour le "IF NOT EXISTS" : https://forums.mysql.com/read.php?101,213455,213496

// créer une nouvelle base de données si elle n'est pas déjà créé 
$sql = "CREATE DATABASE IF NOT EXISTS urldb";

// check si il n'y a pas d'erreur & envoyer la requete
if ($connect->query($sql) === TRUE) {
    //echo "Database created successfully";
} else {
    echo "Error: " . $connect->error;
};

// se connecter à la base de données
$conn = new mysqli($servername, $username, $userpassword, 'urldb');

// Check la connexion / source : https://www.w3schools.com/php/php_mysql_insert.asp & https://www.w3schools.com/Php/func_mysqli_connect_error.asp
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    //echo 'connected';
};

// créer une table dans la base de donnée si elle n'est pas déjà créé
$sql = "CREATE TABLE IF NOT EXISTS urlsystem (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
urlbase VARCHAR(100) NOT NULL,
urlshort VARCHAR(100) NOT NULL,
activated VARCHAR(100) NOT NULL,
email VARCHAR(100) NOT NULL,
views INT
)";
// faire la requete 
$conn->query($sql);

session_start();
$sessionemail = $_SESSION['email'];

$sql = "SELECT * FROM urlsystem WHERE email='$sessionemail' ";
$sessionresult = $conn->query($sql);
    
// help to loop on the result of the request https://phppot.com/mysql/mysql-fetch-using-php/ 

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
        <form method="POST" action="addlink.php" class="home_form">
            <label for="lien" class="form_label">Rentrez votre lien</label>
            <input type="text" name="lien" id="lien" placeholder="mettre lien ici">
            <input type="submit" name="submitlink" value="GO" class="home_form_submit-button home_form_submit-register-button"/>
        </form>
    </div>
    <div class="account_zone">
        <div class="account_container">
            <div class="account_link-title">Mes liens</div>
            <div class="account_link-container">
                <?php while($rows = mysqli_fetch_row($sessionresult)) { ?>
                    <?php echo '<div class="account_link-element">'; ?>
                        <?php echo '<div class="account_link-element_title">'; ?>
                            <?php print_r($rows[1]); ?>
                        <?php echo '</div>'; ?>
                        <?php echo '<div class="account_link-element_state"></div>'; ?>
                        <?php echo '<div class="account_link-element_activate-button">desactiver</div>'; ?>
                        <?php echo '<div class="account_link-element_views">'; ?>
                            <?php echo '<div class="icon"></div>'; ?>
                            <?php echo '<div class="number"> views ='; ?>
                                <?php print_r($rows[5]); ?>
                            <?php echo '</div>'; ?>
                        <?php echo '</div>'; ?>
                    <?php echo '</div>'; ?>
                <?php } ?>
            </div>
        </div>
    </div>
    <script src="linkszone.js"></script>
</body>
</html>