<?php

// recuperer les données du form
$email = $_POST['email'];
$password = $_POST['password'];


$servername = 'localhost';
$username = 'root';
$userpassword = 'root';

// source aide pour gérer la base de donnée : https://www.w3schools.com/php/php_mysql_intro.asp
// acceder au serveur depuis Php
$connect = new mysqli($servername, $username, $userpassword);

// se connecter à la base de données
$conn = new mysqli($servername, $username, $userpassword, 'logindb');

// Check la connexion / source aide : https://www.w3schools.com/php/php_mysql_insert.asp
// requête
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// selectionner les lignes de la table ou l'email et le password entrer apparaissent
// source aide : https://www.w3schools.com/sql/sql_select.asp

$sql = "SELECT * FROM users WHERE email='$email' AND pass='$password'";
// source aide : https://stackoverflow.com/questions/42050614/mysqli-queryconn-sql-or-conn-querysql
// resultat la requête = 
$result = $conn->query($sql);

// check si il y a des résultats à la requête (= si les identifiants sont dans la base de données)
?>

<?php if ($result->num_rows > 0) { ?>
    <?php session_start(); ?>
    <?php $_SESSION['email'] = $email;?>
    <?php include 'createlink.php'; ?>
<?php } else { ?>
    <?php include 'connexion.php'; ?>
<?php }; ?>
</body>
</html>