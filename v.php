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
// selectionner les lignes de la table ou la key apparait
$sql = "SELECT * FROM urlsystem WHERE urlshort='$key'";
// source aide : https://stackoverflow.com/questions/42050614/mysqli-queryconn-sql-or-conn-querysql

// resultat la requête = 
$result = $conn->query($sql);

// mettre le resultat de la requete dans un tableau associatif 
//source fonction fetch_assoc = https://www.w3schools.com/php/php_mysql_select.asp 
$row = $result->fetch_assoc();
// $row[''] <- pour accéder aux données


if ($result->num_rows > 0) {
    echo "l'url est presente dans la table";
    echo " ---> voici le lien de base :  ";
    echo $row['urlbase'];
    // donc rediriger vers l'url rentré par l'utilisateur à la base
} else {
    echo "l'url n'est PAS presente dans la table";
    // donc afficher une erreur 404
    // header("HTTP/1.0 404 Not Found"); MARCHE PAS // source : https://www.php.net/manual/fr/function.header.php
    // apparement si header() n'est pas seul tout en haut du php ca marche pas ? ???
};

?>