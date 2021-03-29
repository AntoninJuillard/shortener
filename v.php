<?php
// accès au serveur 
$servername = 'localhost';
$username = 'root';
$userpassword = 'root';

$connect = new mysqli($servername, $username, $userpassword);

// verifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  //echo "Connected successfully";

// se connecter à la base de données
$conn = new mysqli($servername, $username, $userpassword, 'urldb');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    //echo "connecté!";
}

// recuperer la key de l'url

$key = $_GET["key"];

// source aide : https://www.w3schools.com/sql/sql_select.asp
// selectionner les lignes de la table ou la key apparait et ou activated est = true 
$sql = "SELECT * FROM urlsystem WHERE urlshort='$key' AND activated='true'";
// source aide : https://stackoverflow.com/questions/42050614/mysqli-queryconn-sql-or-conn-querysql

// resultat la requête = 
$result = $conn->query($sql);

// mettre le resultat de la requete dans un tableau associatif 
// source fonction fetch_assoc = https://www.w3schools.com/php/php_mysql_select.asp 
$row = $result->fetch_assoc();
// $row[''] <- pour accéder aux données

$urlsentto = $row['urlbase'];
$urlshortened = $row['urlshort'];

if ($result->num_rows > 0) {
    // source fonction header : https://www.php.net/manual/fr/function.header.php
    // envoyer l'utilisateur à l'adresse associé à l'url short entré

    // update les views du lien 
    // source : https://www.w3schools.com/php/php_mysql_update.asp
    $sql = "UPDATE urlsystem SET views=views+1 WHERE urlshort='$key'";

    if ($conn->query($sql) === TRUE) {
        //echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    header("Location: $urlsentto");
} else {
    // rediriger / afficher une erreur 404
    header("Location: HTTP/1.0 404 Not Found");  
};

?>