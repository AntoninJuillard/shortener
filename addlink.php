<?php
// source fonction rand = https://www.php.net/manual/fr/function.rand.php
// créer identifiant unique du lien 
$alphabetsmall = 'abcdefghijklmnopqrstuvwxyz';
$alphabetbig = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

if(isset($_POST['submitlink']))
{

    $urlbase = $_POST['lien'];
    // http://localhost:8888/shortener/v.php?key=
    $urlshort = $alphabetsmall[rand(0,25)] . $alphabetbig[rand(0,25)] . rand(10,99) . '_' . $alphabetbig[rand(0,25)] . $alphabetbig[rand(0,25)];
    //echo $urlshort;

    //echo $urlbase;
    //echo 'short:';
    //echo $urlshort;


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

    // enregister les liens dans la table
    session_start();
    $sessionemail = $_SESSION['email'];
    // source pour aider insertion : https://forums.commentcamarche.net/forum/affich-1602964-variable-php-dans-requete-mysql
    $sql = "INSERT INTO urlsystem (urlbase, urlshort, activated, email, views)
    VALUES ('$urlbase', '$urlshort', 'true', '$sessionemail', 0)";

    $conn->query($sql);

    $sql = "SELECT * FROM urlsystem WHERE email='$sessionemail' ";
    $sessionresult = $conn->query($sql);
    
    // help to loop on the result of the request https://phppot.com/mysql/mysql-fetch-using-php/ 

    // if(isset($_POST['activation-button']))
    // {
    //     echo 'activation button set';
    // };
    
};


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
        <div class="home_buttons home_form" >
            <div class="copylink-button">
                <?php echo "http://localhost:8888/shortener/v.php?key=".$urlshort ?>
            </div>
            <div class="newlink-button home_form_submit-button">NOUVEAU LIEN</div>
        </div>
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
                        
                        <?php echo '<input type="submit" name="activation-button" class="account_link-element_activate-button" value="desactiver">'; ?>
                        
                        <?php echo '<div class="account_link-element_views">'; ?>
                            <?php echo '<div class="icon"></div>'; ?>
                            <?php echo '<div class="number"> views ='; ?>
                                <?php print_r($rows[5]); ?>
                            <?php echo '</div>;' ?>
                        <?php echo '</div>'; ?>
                    <?php echo '</div>'; ?>
                <?php } ?>
            </div>
        </div>
    </div>
    <script src="linkszone.js"></script>
</body>
</html>