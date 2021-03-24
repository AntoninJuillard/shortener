<?php
// source fonction rand = https://www.php.net/manual/fr/function.rand.php
// créer identifiant unique du lien 
$alphabetsmall = 'abcdefghijklmnopqrstuvwxyz';
$alphabetbig = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

if(isset($_POST['submit']))
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
    urlshort VARCHAR(100) NOT NULL
    )";
    // faire la requete 
    $conn->query($sql);

    // enregister les liens da la table

    // source pour aider insertion : https://forums.commentcamarche.net/forum/affich-1602964-variable-php-dans-requete-mysql
    $sql = "INSERT INTO urlsystem (urlbase, urlshort)
    VALUES ('$urlbase', '$urlshort')";

    $conn->query($sql);

};

?>