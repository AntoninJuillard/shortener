<?php
// TOUT POUR INSCRIRE UN NOUVEL UTILISATEUR : 
// verifier que le form fonctionne
// source pour le isset : https://www.php.net/manual/fr/function.isset.php
if(isset($_POST['submit']))
{
    // recuperer les données du form
    $email = $_POST['email'];
    $password = $_POST['password'];
    //echo $email;
    //echo $password;
    $servername = 'localhost';
    $username = 'root';
    $userpassword = 'root';

    // source pour gérer la base de donnée : https://www.w3schools.com/php/php_mysql_intro.asp
    
    // acceder au serveur depuis Php
    $connect = new mysqli($servername, $username, $userpassword);
  

    // source pour le "IF NOT EXISTS" : https://forums.mysql.com/read.php?101,213455,213496

    // créer une nouvelle base de données si elle n'est pas déjà créé 
    $sql = "CREATE DATABASE IF NOT EXISTS logindb";
    $connect->query($sql);

    // se connecter à la base de données
    $conn = new mysqli($servername, $username, $userpassword, 'logindb');
    
    // Check la connexion / source : https://www.w3schools.com/php/php_mysql_insert.asp & https://www.w3schools.com/Php/func_mysqli_connect_error.asp
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
  

    // créer une table dans la base de donnée si elle n'est pas déjà créé
    $sql = "CREATE TABLE IF NOT EXISTS  users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    pass VARCHAR(100) NOT NULL
    )";
    // faire la requete ----- si bug c ici 
    $conn->query($sql);

    // selectionner les lignes de la table ou l'email et le password entrer apparaissent
    // source aide : https://www.w3schools.com/sql/sql_select.asp

    $sql = "SELECT * FROM users WHERE email='$email' AND pass='$password'";
    // source aide : https://stackoverflow.com/questions/42050614/mysqli-queryconn-sql-or-conn-querysql
    // faire la requête = 
    $result = $conn->query($sql);

    // check si il y a des résultats à la requête (= si les identifiants sont dans la base de données)
    if ($result->num_rows > 0) {
        //include 'registration.php';
    } else {
        session_start();
        $_SESSION['email'] = $email;
        // insérer les nouveaux identifiants dans la base de données
        // source pour aider insertion : https://forums.commentcamarche.net/forum/affich-1602964-variable-php-dans-requete-mysql
        $sql = "INSERT INTO users (email, pass)
        VALUES ('$email', '$password')";
        
        if ($conn->query($sql) === TRUE) {
            //echo "all good";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        };

        // ouvrir la page de création de lien
        include 'createlink.php';

    }

};

?>