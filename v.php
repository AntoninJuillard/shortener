<?php
// accès au serveur 
$servername = 'localhost';
$username = 'root';
$userpassword = 'root';

$connect = new mysqli($servername, $username, $userpassword);

$connect->query($sql);

// se connecter à la base de données
$conn = new mysqli($servername, $username, $userpassword, 'urldb');

$sql = "SELECT * FROM urlsystem ";

// source aide : https://www.php.net/manual/fr/reserved.variables.get.php 
$rediriger = $_GET["oui"];
echo $rediriger;
?>