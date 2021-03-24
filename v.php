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

// afficher quelque chose en fonction de la key dans l'url
// source aide : https://www.php.net/manual/fr/reserved.variables.get.php 
//$rediriger = $_GET["key"];
// echo $rediriger;

// source pour parse_url : https://www.php.net/manual/fr/function.parse-url.php

$url = 'http://localhost:8888/shortener/v.php?key=uI29_EN';

$key = $_GET["key"];
echo $key;
// recuperer ce qu'il y a après le '?' dans l'url
$urlparsequery = parse_url($url, PHP_URL_QUERY);
settype($urlparsequery, "string");
echo $urlparsequery;


?>